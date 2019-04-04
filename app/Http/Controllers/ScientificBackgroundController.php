<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nation;
use App\Unit;
use App\SBTopicLevel;
use App\PI;
use App\TPForeignLanguage;
use App\TPGraduate;
use App\WPProfessional;
use App\TPPostgraduateDoctor;
use App\TPPostgraduateMaster;
use App\SBResearchTopic;
use App\SBResearchProcessWork;
use App\ScientificBackground;
use Auth;
use App;
use PDF;

class ScientificBackgroundController extends Controller
{
    public function getdetailAdmin($pi_id)
    {
        $sb = ScientificBackground::where('personalinformation_id', $pi_id)->firstOrFail();
        return view('admin.sb.sb-detail', compact('pi_id', 'sb'));
    }

    public function getupdateAdmin($pi_id)
    {
        $this->authorize('cud', PI::first());

        $sb = ScientificBackground::where('personalinformation_id', $pi_id)->firstOrFail();
        $nations = Nation::all();
        $units = Unit::all();
        $topic_levels = SBTopicLevel::all();
        return view('admin.sb.sb-update', compact('pi_id', 'sb', 'nations', 'units', 'topic_levels'));
    }

    public function postupdateAdmin($pi_id, Request $request)
    {
        $this->authorize('cud', PI::first());

        $pi = PI::find($pi_id);
        $request->validate(
            [
                'full_name' => 'required',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
                'home_town' => 'required',
                'nation' => 'required',
                'highest_degree' => 'nullable',
                'highest_scientific_title' => 'nullable',
                'year_of_appointment' => 'digits:4|integer|nullable',
                'position' => 'required',
                'unit' => 'required',
                'address' => 'required',
                'email_address'=> 'required|email|unique:personalinformations,email_address,'.$pi->id,
                "type_of_training" => 'required',
                'place_of_training' => 'required',
                'field_of_study' => 'required',
                'nation_of_training' => 'required',
                'year_of_graduation_first' => 'required',
                'industry.*' => 'required_with:year_of_graduation.*',
                'year_of_graduation.*' => 'required_with:industry.*',
                'master_field_of_study.*' => 'required_with:master_year_of_issue.*,master_place_of_training.*|nullable',
                'master_year_of_issue.*' => 'required_with:master_field_of_study.*,master_place_of_training.*|digits:4|integer|nullable',
                'master_place_of_training.*'=>'required_with:master_year_of_issue.*,master_field_of_study.*|nullable',
                'doctor_field_of_study.*' => 'required_with:doctor_year_of_issue.*,doctor_place_of_training.*,thesis_title.*|nullable',
                'doctor_year_of_issue.*' => 'required_with:doctor_field_of_study.*,doctor_place_of_training.*,thesis_title.*|digits:4|integer|nullable',
                'doctor_place_of_training.*'=>'required_with:doctor_year_of_issue.*,doctor_field_of_study.*,thesis_title.*|nullable',
                'thesis_title.*' => 'required_with:doctor_year_of_issue.*,doctor_place_of_training.*,doctor_field_of_study.*|nullable',
                'language.*' => 'required_with:usage_level.*|nullable',
                'usage_level.*' => 'required_with:language.*|nullable',
                'period_time.*' => 'required_with:place_of_work.*,work_of_undertake.*|nullable',
                'place_of_work.*' => 'required_with:period_time.*,work_of_undertake.*|nullable',
                'work_of_undertake.*' => 'required_with:place_of_work.*,period_time.*|nullable',
                'name_of_topic.*' => 'required_with:start_year.*,end_year.*,topic_level.*,responsibility.*',
                'start_year.*' => 'required_with:name_of_topic.*,end_year.*,topic_level.*,responsibility.*|digits:4|integer|nullable',
                'end_year.*' => 'required_with:name_of_topic.*,start_year.*,topic_level.*,responsibility.*|digits:4|integer|nullable',
                'topic_level.*' => 'required_with:start_year.*,end_year.*,name_of_topic.*,responsibility.*|nullable',
                'responsibility.*' => 'required_with:start_year.*,end_year.*,topic_level.*,name_of_topic.*|nullable',
                'name_of_works.*' => 'required_with:year_of_publication.*,name_of_journal.*|nullable',
                'year_of_publication.*' =>'required_with:name_of_works.*,name_of_journal.*|digits:4|integer|nullable',
                'name_of_journal.*' => 'required_with:year_of_publication.*,name_of_works.*|nullable'
            ],
            [
              'full_name.required' => 'Họ và tên không được bỏ trống',
              'date_of_birth.required' => 'Ngày sinh không được bỏ trống',
              'place_of_birth.required' => 'Nơi sinh không được bỏ trống',
              'home_town.required' => 'Quê quán không được bỏ trống',
              'nation.required' => 'Dân tộc không được bỏ trống',
              'highest_degree.required' => 'Học vị cao nhất không được bỏ trống',
              'highest_scientific_title.required' => 'Chức danh khoa học cao nhất không được bỏ trống',
              'year_of_appointment.digits' => 'Năm bổ nhiệm không đúng định dạng',
              'year_of_appointment.integer' => 'Năm bổ nhiệm không đúng định dạng',
              'position.required' => 'Chức vụ không được bỏ trống',
              'unit.required' => 'Đơn vị   không được bỏ trống',
              'address.required' => 'Chỗ ở riêng không được bỏ trống',
              'email_address.required' => 'Email không được bỏ trống',
              'email_address.email' =>'Email sai định dạng',
              'email_address.unique' =>'Email đã tồn tại',
              'type_of_training.required' => 'Hệ đào tạo không được bỏ trống',
              'place_of_training.required' => 'Nơi đào tạo không được bỏ trống',
              'field_of_study.required' => 'Ngành học không được bỏ trống',
              'nation_of_training.required' => 'Nước đào tạo không được bỏ trống',
              'year_of_graduation_first.required' => 'Năm tốt nghiệp không được bỏ trống',
              'industry.*.required_with' => 'Hệ đào tạo không được bỏ trống',
              'year_of_graduation.0.required' => 'Năm tốt nghiệp không được bỏ trống',
              'year_of_graduation.*.required_with' => 'Năm tốt nghiệp không được bỏ trống',
              'year_of_graduation.digits' => 'Năm tốt nghiệp không đúng định dạng',
              'year_of_graduation.integer' => 'Năm tốt nghiệp không đúng định dạng',
              'master_field_of_study.*.required_with' => 'Thạc sĩ chuyên ngành không được bỏ trống',
              'master_year_of_issue.*.required_with' => 'Năm cấp bằng thạc sĩ không được bỏ trống',
              'master_year_of_issue.*.digits' => 'Năm cấp bằng thạc sĩ không đúng định dạng',
              'master_year_of_issue.*.integer' => 'Năm cấp bằng thạc sĩ không đúng định dạng',
              'master_place_of_training.*.required_with' => 'Nơi đào tạo thạc sĩ không được bỏ trống',
              'doctor_field_of_study.*.required_with' => 'Tiến sĩ chuyên ngành không được bỏ trống',
              'doctor_place_of_training.*.required_with' => 'Nơi cấp bằng tiến sĩ không được bỏ trống',
              'doctor_year_of_issue.*.required_with' => 'Năm cấp bằng tiến sĩ không được bỏ trống',
              'doctor_year_of_issue.*.digits' => 'Năm cấp bằng tiến sĩ không đúng định dạng',
              'doctor_year_of_issue.*.integer' => 'Năm cấp bằng tiến sĩ không đúng định dạng',
              'thesis_title.*.required_with' => 'Tên luận án không được bỏ trống',
              'language.*.required_with' => 'Ngoại ngữ không được bỏ trống',
              'usage_level.*.required_with' => 'Mức độ sử dụng ngoại ngữ không được bỏ trống',
              'period_time.*.required_with' => 'Thời gian công tác chuyên môn không được bỏ trống',
              'place_of_work.*.required_with' => 'Nơi công tác chuyên môn không được bỏ trống',
              'work_of_undertake.*.required_with' => 'Công việc đảm nhiệm không được bỏ trống',
              'name_of_topic.*.required_with' => 'Tên đề tài nghiên cứu không được bỏ trống',
              'start_year.*.required_with' => 'Năm bắt đầu đề tài nghiên cứu không được bỏ trống',
              'start_year.*.digits' => 'Năm bắt đầu đề tài nghiên cứu không đúng định dạng',
              'start_year.*.integer' => 'Năm bắt đầu đề tài nghiên cứu không đúng định dạng',
              'end_year.*.required_with' => 'Năm kết thúc đề tài nghiên cứu không được bỏ trống',
              'end_year.*.digits' => 'Năm kết thúc đề tài nghiên cứu không đúng định dạng',
              'end_year.*.integer' => 'Năm kết thúc đề tài nghiên cứu không đúng định dạng',
              'topic_level.*.required_with' => 'đề tài cấp không được bỏ trống',
              'responsibility.*.required_with' => 'Trách nhiệm tham gia trong đề tài nghiên cứu không được bỏ trống',
              'name_of_works.*.required_with' => 'Tên công trình khoa học không được bỏ trống',
              'year_of_publication.*.required_with' => 'Năm công bố công trình khoa học không được bỏ trống',
              'year_of_publication.*.digits' => 'Năm công bố công trình khoa học không đúng định dạng',
              'year_of_publication.*.integer' => 'Năm công bố công trình khoa học không đúng định dạng',
              'name_of_journal.*.required_with' => 'Tên tạp chí không được bỏ trống',

            ]
        );

        $pi->full_name = $request->full_name;
        $pi->gender = $request->gender;
        $pi->date_of_birth = $request->date_of_birth;
        $pi->place_of_birth = $request->place_of_birth;
        $pi->home_town = $request->home_town;
        $pi->nation_id = $request->nation;
        $pi->position = $request->position;
        $pi->unit_id = $request->unit;
        $pi->email_address = $request->email_address;
        $pi->fax = $request->fax;
        $pi->save();
        $sb = ScientificBackground::where('personalinformation_id', $pi->id)->firstOrFail();
        $sb->highest_scientific_title = $request->highest_scientific_title;
        $sb->year_of_appointment = $request->year_of_appointment;
        $sb->address = $request->address;
        $sb->orga_phone_number = $request->orga_phone_number;
        $sb->home_phone_number = $request->home_phone_number;
        $sb->mobile_phone_number = $request->mobile_phone_number;
        $sb->save();

        if(($request->industry) !=null){
            $request->industry = ($request->industry);
            TPGraduate::where('scientific_background_id', $sb->id)->delete();
            $tp_graduate = new TPGraduate;
            $tp_graduate->scientific_background_id = $sb->id;
            $tp_graduate->type_of_training = $request->type_of_training;
            $tp_graduate->place_of_training = $request->place_of_training;
            $tp_graduate->field_of_study = $request->field_of_study;
            $tp_graduate->nation_of_training = $request->nation_of_training;
            $tp_graduate->year_of_graduation = $request->year_of_graduation_first;
            $tp_graduate ->save();
            for ($i = 0 ; $i < count($request->industry) ; $i++) {

                    $tp_graduate = new TPGraduate;
                    $tp_graduate->scientific_background_id = $sb->id;
                    $tp_graduate->type_of_training = $request->type_of_training;
                    $tp_graduate->place_of_training = $request->place_of_training;
                    $tp_graduate->field_of_study = $request->industry[$i];
                    $tp_graduate->nation_of_training = $request->nation_of_training;
                    $tp_graduate->year_of_graduation = $request->year_of_graduation[$i];
                    $tp_graduate ->save();
            }
        }


        if(($request->master_field_of_study) != null){
            $request->master_field_of_study = ($request->master_field_of_study);
            TPPostgraduateMaster::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->master_field_of_study) ; $i++) {
                $tp_postgraduate_master = new TPPostgraduateMaster;
                $tp_postgraduate_master->scientific_background_id = $sb->id;
                $tp_postgraduate_master->field_of_study = $request->master_field_of_study[$i];
                $tp_postgraduate_master->year_of_issue = $request->master_year_of_issue[$i];
                $tp_postgraduate_master->place_of_training = $request->master_place_of_training[$i];
                $tp_postgraduate_master ->save();
            }
        }
        if(($request->doctor_field_of_study) != null){
            $request->doctor_field_of_study = ($request->doctor_field_of_study);
            TPPostgraduateDoctor::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->doctor_field_of_study) ; $i++) {
                $tp_postgraduate_doctor = new TPPostgraduateDoctor;
                $tp_postgraduate_doctor->scientific_background_id = $sb->id;

                $tp_postgraduate_doctor->field_of_study = $request->doctor_field_of_study[$i];
                $tp_postgraduate_doctor->year_of_issue =  $request->doctor_year_of_issue[$i];
                $tp_postgraduate_doctor->thesis_title =  $request->thesis_title[$i];
                $tp_postgraduate_doctor->place_of_training =  $request->doctor_place_of_training[$i];
                $tp_postgraduate_doctor ->save();
            }
        }

        if(($request->language) !=null){
            $request->language = ($request->language);
            TPForeignLanguage::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->language) ; $i++) {
                $tp_foreign_language = new TPForeignLanguage;
                $tp_foreign_language->scientific_background_id = $sb->id;

                $tp_foreign_language->language = $request->language[$i];
                $tp_foreign_language->usage_level = $request->usage_level[$i];
                $tp_foreign_language ->save();
            }
        }

        if(($request->period_time) != null){
            $request->period_time = ($request->period_time);
            WPProfessional::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->period_time) ; $i++) {
                $wp_professional = new WPProfessional;
                $wp_professional->scientific_background_id = $sb->id;

                $wp_professional->period_time = $request->period_time[$i];
                $wp_professional->place_of_work = $request->place_of_work[$i];
                $wp_professional->work_of_undertake = $request->work_of_undertake[$i];
                $wp_professional ->save();
            }
        }

        if(($request->name_of_topic) != null){
            $request->name_of_topic = ($request->name_of_topic);
            SBResearchTopic::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->name_of_topic) ; $i++) {
                $sb_research_topic = new SBResearchTopic;
                $sb_research_topic->scientific_background_id = $sb->id;

                $sb_research_topic->name_of_topic = $request->name_of_topic[$i];
                $sb_research_topic->start_year = $request->start_year[$i];
                $sb_research_topic->end_year = $request->end_year[$i];
                $sb_research_topic->topic_level_id = $request->topic_level[$i];
                $sb_research_topic->responsibility = $request->responsibility[$i];
                $sb_research_topic ->save();
            }
        }

        if(($request->name_of_works) != null){
            $request->name_of_works = ($request->name_of_works);
            SBResearchProcessWork::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->name_of_works) ; $i++) {
                $sb_research_process_works = new SBResearchProcessWork;
                $sb_research_process_works->scientific_background_id = $sb->id;

                $sb_research_process_works->name_of_works = $request->name_of_works[$i];
                $sb_research_process_works->year_of_publication = $request->year_of_publication[$i];
                $sb_research_process_works->name_of_journal = $request->name_of_journal[$i];
                $sb_research_process_works ->save();
            }
        }
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }

    public function getupdateEmployeeSB()
    {
        $pi_id = PI::find(Auth::guard('employee')->user()->personalinformation_id)->id;
        $sb = ScientificBackground::where('personalinformation_id', $pi_id)->firstOrFail();
        $nations = Nation::all();
        $units = Unit::all();
        $topic_levels = SBTopicLevel::all();
        return view('employee.sb.employee-sb-update', compact('pi_id', 'sb', 'nations', 'units', 'topic_levels'));
    }



    public function postupdateEmployeeSB(Request $request)
    {
        $pi = PI::find(Auth::guard('employee')->user()->personalinformation_id);
        // dd(array_filter($request->industry) != null ? 'true':'false');
        // dd($request);
        $request->validate(
            [
                'full_name' => 'required',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
                'home_town' => 'required',
                'nation' => 'required',
                'highest_degree' => 'nullable',
                'highest_scientific_title' => 'nullable',
                'year_of_appointment' => 'digits:4|integer|nullable',
                'position' => 'required',
                'unit' => 'required',
                'address' => 'required',
                'email_address'=> 'required|email|unique:personalinformations,email_address,'.$pi->id,
                "type_of_training" => 'required',
                'place_of_training' => 'required',
                'field_of_study' => 'required',
                'nation_of_training' => 'required',
                'year_of_graduation_first' => 'required',
                'industry.*' => 'required_with:year_of_graduation.*',
                'year_of_graduation.*' => 'required_with:industry.*',
                'master_field_of_study.*' => 'required_with:master_year_of_issue.*,master_place_of_training.*|nullable',
                'master_year_of_issue.*' => 'required_with:master_field_of_study.*,master_place_of_training.*|digits:4|integer|nullable',
                'master_place_of_training.*'=>'required_with:master_year_of_issue.*,master_field_of_study.*|nullable',
                'doctor_field_of_study.*' => 'required_with:doctor_year_of_issue.*,doctor_place_of_training.*,thesis_title.*|nullable',
                'doctor_year_of_issue.*' => 'required_with:doctor_field_of_study.*,doctor_place_of_training.*,thesis_title.*|digits:4|integer|nullable',
                'doctor_place_of_training.*'=>'required_with:doctor_year_of_issue.*,doctor_field_of_study.*,thesis_title.*|nullable',
                'thesis_title.*' => 'required_with:doctor_year_of_issue.*,doctor_place_of_training.*,doctor_field_of_study.*|nullable',
                'language.*' => 'required_with:usage_level.*|nullable',
                'usage_level.*' => 'required_with:language.*|nullable',
                'period_time.*' => 'required_with:place_of_work.*,work_of_undertake.*|nullable',
                'place_of_work.*' => 'required_with:period_time.*,work_of_undertake.*|nullable',
                'work_of_undertake.*' => 'required_with:place_of_work.*,period_time.*|nullable',
                'name_of_topic.*' => 'required_with:start_year.*,end_year.*,topic_level.*,responsibility.*',
                'start_year.*' => 'required_with:name_of_topic.*,end_year.*,topic_level.*,responsibility.*|digits:4|integer|nullable',
                'end_year.*' => 'required_with:name_of_topic.*,start_year.*,topic_level.*,responsibility.*|digits:4|integer|nullable',
                'topic_level.*' => 'required_with:start_year.*,end_year.*,name_of_topic.*,responsibility.*|nullable',
                'responsibility.*' => 'required_with:start_year.*,end_year.*,topic_level.*,name_of_topic.*|nullable',
                'name_of_works.*' => 'required_with:year_of_publication.*,name_of_journal.*|nullable',
                'year_of_publication.*' =>'required_with:name_of_works.*,name_of_journal.*|digits:4|integer|nullable',
                'name_of_journal.*' => 'required_with:year_of_publication.*,name_of_works.*|nullable'
            ],
            [
              'full_name.required' => 'Họ và tên không được bỏ trống',
              'date_of_birth.required' => 'Ngày sinh không được bỏ trống',
              'place_of_birth.required' => 'Nơi sinh không được bỏ trống',
              'home_town.required' => 'Quê quán không được bỏ trống',
              'nation.required' => 'Dân tộc không được bỏ trống',
              'highest_degree.required' => 'Học vị cao nhất không được bỏ trống',
              'highest_scientific_title.required' => 'Chức danh khoa học cao nhất không được bỏ trống',
              'year_of_appointment.digits' => 'Năm bổ nhiệm không đúng định dạng',
              'year_of_appointment.integer' => 'Năm bổ nhiệm không đúng định dạng',
              'position.required' => 'Chức vụ không được bỏ trống',
              'unit.required' => 'Đơn vị   không được bỏ trống',
              'address.required' => 'Chỗ ở riêng không được bỏ trống',
              'email_address.required' => 'Email không được bỏ trống',
              'email_address.email' =>'Email sai định dạng',
              'email_address.unique' =>'Email đã tồn tại',
              'type_of_training.required' => 'Hệ đào tạo không được bỏ trống',
              'place_of_training.required' => 'Nơi đào tạo không được bỏ trống',
              'field_of_study.required' => 'Ngành học không được bỏ trống',
              'nation_of_training.required' => 'Nước đào tạo không được bỏ trống',
              'year_of_graduation_first.required' => 'Năm tốt nghiệp không được bỏ trống',

              'industry.*.required_with' => 'Hệ đào tạo không được bỏ trống',
              'year_of_graduation.*.required_with' => 'Năm tốt nghiệp không được bỏ trống',
              'year_of_graduation.digits' => 'Năm tốt nghiệp không đúng định dạng',
              'year_of_graduation.integer' => 'Năm tốt nghiệp không đúng định dạng',
              'master_field_of_study.*.required_with' => 'Thạc sĩ chuyên ngành không được bỏ trống',
              'master_year_of_issue.*.required_with' => 'Năm cấp bằng thạc sĩ không được bỏ trống',
              'master_year_of_issue.*.digits' => 'Năm cấp bằng thạc sĩ không đúng định dạng',
              'master_year_of_issue.*.integer' => 'Năm cấp bằng thạc sĩ không đúng định dạng',
              'master_place_of_training.*.required_with' => 'Nơi đào tạo thạc sĩ không được bỏ trống',
              'doctor_field_of_study.*.required_with' => 'Tiến sĩ chuyên ngành không được bỏ trống',
              'doctor_place_of_training.*.required_with' => 'Nơi cấp bằng tiến sĩ không được bỏ trống',
              'doctor_year_of_issue.*.required_with' => 'Năm cấp bằng tiến sĩ không được bỏ trống',
              'doctor_year_of_issue.*.digits' => 'Năm cấp bằng tiến sĩ không đúng định dạng',
              'doctor_year_of_issue.*.integer' => 'Năm cấp bằng tiến sĩ không đúng định dạng',
              'thesis_title.*.required_with' => 'Tên luận án không được bỏ trống',
              'language.*.required_with' => 'Ngoại ngữ không được bỏ trống',
              'usage_level.*.required_with' => 'Mức độ sử dụng ngoại ngữ không được bỏ trống',
              'period_time.*.required_with' => 'Thời gian công tác chuyên môn không được bỏ trống',
              'place_of_work.*.required_with' => 'Nơi công tác chuyên môn không được bỏ trống',
              'work_of_undertake.*.required_with' => 'Công việc đảm nhiệm không được bỏ trống',
              'name_of_topic.*.required_with' => 'Tên đề tài nghiên cứu không được bỏ trống',
              'start_year.*.required_with' => 'Năm bắt đầu đề tài nghiên cứu không được bỏ trống',
              'start_year.*.digits' => 'Năm bắt đầu đề tài nghiên cứu không đúng định dạng',
              'start_year.*.integer' => 'Năm bắt đầu đề tài nghiên cứu không đúng định dạng',
              'end_year.*.required_with' => 'Năm kết thúc đề tài nghiên cứu không được bỏ trống',
              'end_year.*.digits' => 'Năm kết thúc đề tài nghiên cứu không đúng định dạng',
              'end_year.*.integer' => 'Năm kết thúc đề tài nghiên cứu không đúng định dạng',
              'topic_level.*.required_with' => 'đề tài cấp không được bỏ trống',
              'responsibility.*.required_with' => 'Trách nhiệm tham gia trong đề tài nghiên cứu không được bỏ trống',
              'name_of_works.*.required_with' => 'Tên công trình khoa học không được bỏ trống',
              'year_of_publication.*.required_with' => 'Năm công bố công trình khoa học không được bỏ trống',
              'year_of_publication.*.digits' => 'Năm công bố công trình khoa học không đúng định dạng',
              'year_of_publication.*.integer' => 'Năm công bố công trình khoa học không đúng định dạng',
              'name_of_journal.*.required_with' => 'Tên tạp chí không được bỏ trống',

            ]
        );

        $pi->full_name = $request->full_name;
        $pi->gender = $request->gender;
        $pi->date_of_birth = $request->date_of_birth;
        $pi->place_of_birth = $request->place_of_birth;
        $pi->home_town = $request->home_town;
        $pi->nation_id = $request->nation;
        $pi->position = $request->position;
        $pi->unit_id = $request->unit;
        $pi->email_address = $request->email_address;
        $pi->fax = $request->fax;
        $pi->save();
        $sb = ScientificBackground::where('personalinformation_id', $pi->id)->firstOrFail();
        $sb->highest_scientific_title = $request->highest_scientific_title;
        $sb->year_of_appointment = $request->year_of_appointment;
        $sb->address = $request->address;
        $sb->orga_phone_number = $request->orga_phone_number;
        $sb->home_phone_number = $request->home_phone_number;
        $sb->mobile_phone_number = $request->mobile_phone_number;
        $sb->save();

        if(($request->industry) !=null){
            $request->industry = ($request->industry);
            TPGraduate::where('scientific_background_id', $sb->id)->delete();
            $tp_graduate = new TPGraduate;
            $tp_graduate->scientific_background_id = $sb->id;
            $tp_graduate->type_of_training = $request->type_of_training;
            $tp_graduate->place_of_training = $request->place_of_training;
            $tp_graduate->field_of_study = $request->field_of_study;
            $tp_graduate->nation_of_training = $request->nation_of_training;
            $tp_graduate->year_of_graduation = $request->year_of_graduation_first;
            $tp_graduate ->save();
            for ($i = 0 ; $i < count($request->industry) ; $i++) {
                $tp_graduate = new TPGraduate;
                $tp_graduate->scientific_background_id = $sb->id;
                $tp_graduate->type_of_training = $request->type_of_training;
                $tp_graduate->place_of_training = $request->place_of_training;
                $tp_graduate->field_of_study = $request->industry[$i];
                $tp_graduate->nation_of_training = $request->nation_of_training;
                $tp_graduate->year_of_graduation = $request->year_of_graduation[$i];
                $tp_graduate ->save();
            }
        }


        if(($request->master_field_of_study) != null){
            $request->master_field_of_study = ($request->master_field_of_study);
            TPPostgraduateMaster::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->master_field_of_study) ; $i++) {
                $tp_postgraduate_master = new TPPostgraduateMaster;
                $tp_postgraduate_master->scientific_background_id = $sb->id;
                $tp_postgraduate_master->field_of_study = $request->master_field_of_study[$i];
                $tp_postgraduate_master->year_of_issue = $request->master_year_of_issue[$i];
                $tp_postgraduate_master->place_of_training = $request->master_place_of_training[$i];
                $tp_postgraduate_master ->save();
            }
        }
        if(($request->doctor_field_of_study) != null){
            $request->doctor_field_of_study = ($request->doctor_field_of_study);
            TPPostgraduateDoctor::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->doctor_field_of_study) ; $i++) {
                $tp_postgraduate_doctor = new TPPostgraduateDoctor;
                $tp_postgraduate_doctor->scientific_background_id = $sb->id;

                $tp_postgraduate_doctor->field_of_study = $request->doctor_field_of_study[$i];
                $tp_postgraduate_doctor->year_of_issue =  $request->doctor_year_of_issue[$i];
                $tp_postgraduate_doctor->thesis_title =  $request->thesis_title[$i];
                $tp_postgraduate_doctor->place_of_training =  $request->doctor_place_of_training[$i];
                $tp_postgraduate_doctor ->save();
            }
        }

        if(($request->language) !=null){
            $request->language = ($request->language);
            TPForeignLanguage::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->language) ; $i++) {
                $tp_foreign_language = new TPForeignLanguage;
                $tp_foreign_language->scientific_background_id = $sb->id;

                $tp_foreign_language->language = $request->language[$i];
                $tp_foreign_language->usage_level = $request->usage_level[$i];
                $tp_foreign_language ->save();
            }
        }

        if(($request->period_time) != null){
            $request->period_time = ($request->period_time);
            WPProfessional::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->period_time) ; $i++) {
                $wp_professional = new WPProfessional;
                $wp_professional->scientific_background_id = $sb->id;

                $wp_professional->period_time = $request->period_time[$i];
                $wp_professional->place_of_work = $request->place_of_work[$i];
                $wp_professional->work_of_undertake = $request->work_of_undertake[$i];
                $wp_professional ->save();
            }
        }

        if(($request->name_of_topic) != null){
            $request->name_of_topic = ($request->name_of_topic);
            SBResearchTopic::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->name_of_topic) ; $i++) {
                $sb_research_topic = new SBResearchTopic;
                $sb_research_topic->scientific_background_id = $sb->id;

                $sb_research_topic->name_of_topic = $request->name_of_topic[$i];
                $sb_research_topic->start_year = $request->start_year[$i];
                $sb_research_topic->end_year = $request->end_year[$i];
                $sb_research_topic->topic_level_id = $request->topic_level[$i];
                $sb_research_topic->responsibility = $request->responsibility[$i];
                $sb_research_topic ->save();
            }
        }

        if(($request->name_of_works) != null){
            $request->name_of_works = ($request->name_of_works);
            SBResearchProcessWork::where('scientific_background_id', $sb->id)->delete();
            for ($i = 0 ; $i < count($request->name_of_works) ; $i++) {
                $sb_research_process_works = new SBResearchProcessWork;
                $sb_research_process_works->scientific_background_id = $sb->id;

                $sb_research_process_works->name_of_works = $request->name_of_works[$i];
                $sb_research_process_works->year_of_publication = $request->year_of_publication[$i];
                $sb_research_process_works->name_of_journal = $request->name_of_journal[$i];
                $sb_research_process_works ->save();
            }
        }

        return redirect()->back()->with('message', 'Cập nhật thành công');
    }

    public function getdetailEmployeeSB()
    {
        $pi_id = PI::find(Auth::guard('employee')->user()->personalinformation_id)->id;
        $sb = ScientificBackground::where('personalinformation_id', $pi_id)->firstOrFail();
        return view('employee.sb.employee-sb-detail', compact('pi_id', 'sb'));
    }
    public function indexPrintAdmin($pi_id)
    {
        $sb = ScientificBackground::where('personalinformation_id', $pi_id)->firstOrFail();
        $nations = Nation::all();
        $units = Unit::all();
        $topic_levels = SBTopicLevel::all();

    //   return view('admin.sb.sb-print', compact('pi_id', 'sb', 'nations', 'units', 'topic_levels'));
        $pdf = PDF::loadView('admin.sb.sb-print', compact('pi_id', 'sb', 'nations', 'units', 'topic_levels'));
        return $pdf->stream('ly-lich-khoa-hoc.pdf');
    }
    public function indexPrint()
    {
        $pi_id = PI::find(Auth::guard('employee')->user()->personalinformation_id)->id;
        $sb = ScientificBackground::where('personalinformation_id', $pi_id)->firstOrFail();
        $nations = Nation::all();
        $units = Unit::all();
        $topic_levels = SBTopicLevel::all();
        $pdf = PDF::loadView('employee.sb.print', compact('pi_id', 'sb', 'nations', 'units', 'topic_levels'));
        return $pdf->download('ly-lich-khoa-hoc.pdf');
    }
}
