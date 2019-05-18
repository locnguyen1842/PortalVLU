<?php

namespace App\Imports;

use App\PI;
use App\Religion;
use App\Address;
use App\Province;
use App\District;
use App\Ward;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AddressImport implements ToCollection,WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {


        $province= Province::all();
        $province_name = [];
        foreach ($province as $item) {
            array_push($province_name, strtolower($item->name));
        }
        $data = $rows->toArray();
        $change_index_data = array();
        $changed_index_data = array();
        foreach ($data as $key => $value) {
            $change_index_data = array_combine(range(1, count($data[$key])), $data[$key]);
            array_push($changed_index_data, $change_index_data);
        }

        $data_to_validate=array_combine(range(2, count($changed_index_data)+1), $changed_index_data);
        foreach ($data_to_validate as &$item) {
            $item = array_map('trim', $item);
            $item = array_map('strtolower', $item);

            //validate rule


        }
        // dd($data_to_validate);



        Validator::make(
            $data_to_validate,
            [
                '*.1' => 'required|exists:personalinformations,employee_code',
                '*.2'=>[
                            'required',
                        ],
                '*.3'=>[
                            'nullable',
                        ],
                '*.4' => 'required',
                '*.5'=> [
                            'required',
                        ],
                '*.6'=> [
                            'required',
                            Rule::in($province_name),
                        ],
                '*.7'=>[
                    'nullable',
                ],
                '*.8'=>'required',
                '*.9'=>'required',
                '*.10' => [
                    'required',
                    Rule::in($province_name),
                ],
            ],
            [

                '*.1.required' => 'Mã nhân viên không được bỏ trống ( vị trí: :attribute|sheet :4 )',
                '*.1.exists' => 'Mã nhân viên không tồn tại ( vị trí: :attribute|sheet :4 )',
                '*.2.required'=>'Tôn giáo không được bỏ trống ( vị trí: :attribute|sheet :4 )',
                '*.4.required' => 'Phường xã ( địa chỉ thường trú ) không được bỏ trống ( vị trí::attribute|sheet :4 )',
                '*.5.required'=>'Quận huyện ( địa chỉ thường trú ) không được bỏ trống ( vị trí: :attribute|sheet :4 )',
                '*.6.required' => 'Tỉnh thành ( địa chỉ thường trú ) không được bỏ trống ( vị trí: :attribute|sheet :4 )',
                '*.6.in' => 'Tỉnh thành ( địa chỉ thường trú ) không hợp lệ ( vị trí: :attribute|sheet :4 )',
                '*.8.required' => 'Phường xã ( địa chỉ tạm trú ) không được bỏ trống ( vị trí: :attribute|sheet :4 )',
                '*.9.required' => 'Quận huyện ( địa chỉ tạm trú ) không được bỏ trống ( vị trí: :attribute|sheet :4 )',
                '*.10.required' => 'Tỉnh thành ( địa chỉ tạm trú ) không được bỏ trống ( vị trí: :attribute|sheet :4 )',
                '*.10.in' => 'Tỉnh thành ( địa chỉ tạm trú ) không hợp lệ ( vị trí: :attribute|sheet :4 )',

            ]
        )->validate();
        foreach($rows as $row){
            $row = array_map('trim',$row->toArray());
            $pi = PI::where('employee_code',$row[0])->firstOrFail();
            $province_permanent = Province::where('name_with_type','like','%'.$row[5].'%')->first();
            if($province_permanent == null){
                $province_permanent = Province::firstOrFail();

            }

            $district_permanent = District::where('parent_code',$province_permanent->code)->where('name_with_type','like','%'.$row[4].'%')->first();
            if($district_permanent == null){
                $district_permanent = District::where('parent_code',$province_permanent->code)->first();
            }
            $ward_permanent = Ward::where('parent_code',$district_permanent->code)->where('name_with_type','like','%'.$row[3].'%')->first();
            if($ward_permanent == null){
                $ward_permanent = Ward::where('parent_code',$district_permanent->code)->first();
            }
            $province_contact = Province::where('name_with_type','like','%'.$row[9].'%')->first();
            if($province_contact == null){
                $province_contact = Province::firstOrFail();

            }
            $district_contact = District::where('parent_code',$province_contact->code)->where('name_with_type','like','%'.$row[8].'%')->first();
            if($district_contact == null){
                $district_contact = District::where('parent_code',$province_contact->code)->first();
            }
            $ward_contact = Ward::where('parent_code',$district_contact->code)->where('name_with_type','like','%'.$row[7].'%')->first();
            if($ward_contact == null){
                $ward_contact = Ward::where('parent_code',$district_contact->code)->first();
            }

            if($pi->permanent_address()->exists() && $pi->contact_address()->exists()){
                // permanent
                $address_permanent = Address::find($pi->permanent_address_id);
                // contact
                $address_contact = Address::find($pi->contact_address_id);

            }else if(!($pi->permanent_address()->exists())&&!($pi->contact_address()->exists())){
                // permanent
                $address_permanent = new Address;
                // contact
                $address_contact = new Address;
            }
            // permanent
            $address_permanent->address_content = $row[2];
            $address_permanent->province_code = $province_permanent->code;
            $address_permanent->district_code = $district_permanent->code;
            $address_permanent->ward_code = $ward_permanent->code;
            $address_permanent->personalinformation_id = $pi->id;
            // contact
            $address_contact->address_content = $row[6];
            $address_contact->province_code = $province_contact->code;
            $address_contact->district_code = $district_contact->code;
            $address_contact->ward_code = $ward_contact->code;
            $address_contact->personalinformation_id = $pi->id;
            $address_permanent->save();
            $address_contact->save();

            $religion = Religion::where('name','like','%'.$row[1].'%')->firstOrFail();

            $pi->religion_id = $religion->id;
            $pi->permanent_address_id = $address_permanent->id;
            $pi->contact_address_id = $address_contact->id;
            $pi->save();
        }


    }
    public function startRow():int
    {
        return 3;
    }
}
