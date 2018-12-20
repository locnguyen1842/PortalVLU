<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use App\PI;
use App\Admin;
use Hash;
class PITest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_add_PI_correct_data()
    {
        $actual = $this->data();
        $addPI = $this->post('/admin/pi-add', $actual);
        $pi = PI::where('employee_code', $actual['employee_code'])->first();//
        $this->assertEquals($pi->employee_code, $actual['employee_code']);
        $this->assertEquals($pi->identity_card, $actual['identity_card']);
        $this->assertEquals($pi->email_address, $actual['email_address']);
    }
    public function test_add_PI_with_empty_employee_code()
    {
        $actual = $this->data();
        $actual['employee_code']= '';
        $addPI = $this->post('/admin/pi-add', $actual);

        $addPI->assertSessionHasErrors([
            'employee_code'=> 'Mã giảng viên không được bỏ trống',
          ]);
        // $pi = PI::where('employee_code',$actual['employee_code'])->first();
          // $this->assertEquals($pi->employee_code, $actual['employee_code']);
    }

    public function test_add_PI_with_duplicate_employee_code()
    {
        $actual = $this->data();
        $actual['employee_code']= 'T153772';
        $addPI = $this->post('/admin/pi-add', $actual);
        $duplicate_pi = $this->post('/admin/pi-add', $actual);
        $duplicate_pi->assertSessionHasErrors([
             'employee_code'=> 'Mã giảng viên đã tồn tại'
           ]);
    }
    public function test_add_PI_with_incorrect_format_email()
    {
        $actual = $this->data();
        $actual['email_address']= 'lethanhson2910@';
        $format_email = $this->post('/admin/pi-add', $actual);
        $format_email->assertSessionHasErrors([
            'email_address'=> 'Email sai định dạng'
          ]);
    }
    public function test_add_PI_with_incorrect_format_date()
    {
        $actual = $this->data();
        $actual['date_of_birth']= '123';
        $format_date = $this->post('/admin/pi-add', $actual);
        $format_date->assertSessionHasErrors([
            'date_of_birth'=> 'Ngày sinh sai định dạng'
          ]);
    }
    public function test_add_PI_with_incorrect_identity_card()
    {
        $actual = $this->data();
        $actual['identity_card']= '321368999';
        $addPI = $this->post('/admin/pi-add', $actual);
        $duplicate_indentitycard = $this->post('/admin/pi-add', $actual);
        $duplicate_indentitycard->assertSessionHasErrors([
          'identity_card'=> 'Chứng minh nhân dân đã được sử dụng'
        ]);
    }
    public function test_add_PI_with_duplicate_email_address()
    {
        $actual = $this->data();
        $addPI = $this->post('/admin/pi-add', $actual);
        $actual1 = $this->data();
        $actual1['email_address']= 'lethanhson2910@gmail.com';
        $actual1['employee_code']= 'T155477';
        $duplicate_emailaddress = $this->post('/admin/pi-add', $actual1);
        $duplicate_emailaddress->assertSessionHasErrors([
          'email_address'=> 'Email đã được sử dụng'
        ]);
    }

    //test update
    public function test_update_PI_correct_data()
    {
        $data = $this->data();
        $addPI = $this->post('/admin/pi-add', $data);

        $pi = PI::where('employee_code', $data['employee_code'])->first();//

        $updatePI = $this->post('/admin/pi-update/'.$pi->id, $data);
        $this->assertEquals($pi->employee_code, $data['employee_code']);
        $this->assertEquals($pi->identity_card, $data['identity_card']);
        $this->assertEquals($pi->email_address, $data['email_address']);
    }

    public function test_update_PI_with_incorrect_format_email()
    {
        $actual = $this->data();
        $format_email = $this->post('/admin/pi-add', $actual);
        $email_update_form = [

            'email_address' =>'lethanhson2910',


        ];
        $pi = PI::where('employee_code', $actual['employee_code'])->first();
        $format_email1 = $this->post('/admin/pi-update/'.$pi->id, $email_update_form);
        $format_email1->assertSessionHasErrors([
            'email_address'=> 'Email sai định dạng'
        ]);
    }
    public function test_update_PI_with_incorrect_format_date()
    {
        $actual = $this->data();
        $format_email = $this->post('/admin/pi-add', $actual);

        $date_update_form = [

            'date_of_birth' =>123,


        ];
        $pi = PI::where('employee_code', $actual['employee_code'])->first();
        $format_date = $this->post('/admin/pi-update/'.$pi->id, $date_update_form);
        $format_date->assertSessionHasErrors([
            'date_of_birth'=> 'Ngày sinh sai định dạng'
        ]);
    }


    public function data()
    {
        $actual = [
        'employee_code' => 'T153772',
        'full_name' =>'Le Thanh Son',
        'nation' =>1,
        'gender'=> 1,
        'date_of_birth' =>'1997-04-10',
        'place_of_birth' =>'TPHCM',
        'permanent_address' =>'An Giang',
        'contact_address' =>'An Giang',
        'phone_number' =>'0123456789',
        'email_address' =>'lethanhson2910@gmail.com',
        'position' =>'Quan ly',
        'date_of_recruitment' =>'2018-04-10',
        'professional_title' =>'Lao cong',
        'identity_card' =>'321368999',
        'date_of_issue' =>'2015-04-10',
        'place_of_issue' =>'TPHCM',
        'unit'=>1,
      ];
        return $actual;
    }
}
