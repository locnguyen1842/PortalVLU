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

class ScientificBackgroundController extends Controller
{
    public function getdetailAdmin($pi_id)
    {
        $sb = ScientificBackground::where('personalinformation_id', $pi_id)->firstOrFail();
        return view('admin.sb.sb-detail', compact('pi_id', 'sb'));
    }

    public function getupdateAdmin($pi_id)
    {
        $sb = ScientificBackground::where('personalinformation_id', $pi_id)->firstOrFail();
        $nations = Nation::all();
        $units = Unit::all();
        $topic_levels = SBTopicLevel::all();
        return view('admin.sb.sb-update', compact('pi_id', 'sb', 'nations', 'units', 'topic_levels'));
    }

    public function postupdateAdmin($pi_id,Request $request)
    {
        $pi = PI::find($pi_id);
        $request->validate(
            [
                'full_name' => 'required',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
                'home_town' => 'required',
                'nation' => 'required',
                'highest_degree' => 'required',
                'highest_scientific_title' => 'required',
                'year_of_appointment' => 'required|digits:4|integer|nullable',
                'position' => 'required',
                'unit' => 'required',
                'address' => 'required',
                'email_address'=> 'required|email|unique:personalinformations,email_address,'.$pi->id,
                "type_of_training" => 'required',
                'place_of_training' => 'required',
                'field_of_study' => 'required',
                'nation_of_training' => 'required',
                'industry.*' => 'required',
                'year_of_graduation.*' => 'required|digits:4|integer',
                'master_field_of_study.*' => 'required',
                'master_year_of_issue.*' => 'required|digits:4|integer',
                'master_place_of_training.*'=>'required',
                'doctor_field_of_study.*' => 'required',
                'doctor_year_of_issue.*' => 'required|digits:4|integer',
                'doctor_place_of_training.*'=>'required',
                'thesis_title.*' => 'required',
                'language.*' => 'required',
                'usage_level.*' => 'required',
                'period_time.*' => 'required',
                'place_of_work.*' => 'required',
                'work_of_undertake.*' => 'required',
                'name_of_topic.*' => 'required',
                'start_year.*' => 'required|digits:4|integer',
                'end_year.*' => 'required|digits:4|integer',
                'topic_level.*' => 'required',
                'responsibility.*' => 'required',
                'name_of_works.*' => 'required',
                'year_of_publication.*' =>'required|digits:4|integer',
                'name_of_journal.*' => 'required'
            ],
            [
              'full_name.required' => 'Họ và tên không được bỏ trống',
              'date_of_birth.required' => 'Ngày sinh không được bỏ trống',
              'place_of_birth.required' => 'Nơi sinh không được bỏ trống',
              'home_town.required' => 'Quê quán không được bỏ trống',
              'nation.required' => 'Dân tộc không được bỏ trống',
              'highest_degree.required' => 'Học vị cao nhất không được bỏ trống',
              'highest_scientific_title.required' => 'Chức danh khoa học cao nhất không được bỏ trống',
              'year_of_appointment.required' => 'Năm bổ nhiệm không được bỏ trống',
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
              'industry.*.required' => 'Hệ đào tạo không được bỏ trống',
              'year_of_graduation.*.required' => 'Năm tốt nghiệp không được bỏ trống',
              'year_of_graduation.digits' => 'Năm tốt nghiệp không đúng định dạng',
              'year_of_graduation.integer' => 'Năm tốt nghiệp không đúng định dạng',
              'master_field_of_study.*.required' => 'Thạc sĩ chuyên ngành không được bỏ trống',
              'master_year_of_issue.*.required' => 'Năm cấp bằng thạc sĩ không được bỏ trống',
              'master_year_of_issue.*.digits' => 'Năm cấp bằng thạc sĩ không đúng định dạng',
              'master_year_of_issue.*.integer' => 'Năm cấp bằng thạc sĩ không đúng định dạng',
              'master_place_of_training.*.required' => 'Nơi đào tạo thạc sĩ không được bỏ trống',
              'doctor_field_of_study.*.required' => 'Tiến sĩ chuyên ngành không được bỏ trống',
              'doctor_place_of_training.*.required' => 'Nơi cấp bằng tiến sĩ không được bỏ trống',
              'doctor_year_of_issue.*.required' => 'Năm cấp bằng tiến sĩ không được bỏ trống',
              'doctor_year_of_issue.*.digits' => 'Năm cấp bằng tiến sĩ không đúng định dạng',
              'doctor_year_of_issue.*.integer' => 'Năm cấp bằng tiến sĩ không đúng định dạng',
              'thesis_title.*.required' => 'Tên luận án không được bỏ trống',
              'language.*.required' => 'Ngoại ngữ không được bỏ trống',
              'usage_level.*.required' => 'Mức độ sử dụng ngoại ngữ không được bỏ trống',
              'period_time.*.required' => 'Thời gian công tác chuyên môn không được bỏ trống',
              'place_of_work.*.required' => 'Nơi công tác chuyên môn không được bỏ trống',
              'work_of_undertake.*.required' => 'Công việc đảm nhiệm không được bỏ trống',
              'name_of_topic.*.required' => 'Tên đề tài nghiên cứu không được bỏ trống',
              'start_year.*.required' => 'Năm bắt đầu đề tài nghiên cứu không được bỏ trống',
              'start_year.*.digits' => 'Năm bắt đầu đề tài nghiên cứu không đúng định dạng',
              'start_year.*.integer' => 'Năm bắt đầu đề tài nghiên cứu không đúng định dạng',
              'end_year.*.required' => 'Năm kết thúc đề tài nghiên cứu không được bỏ trống',
              'end_year.*.digits' => 'Năm kết thúc đề tài nghiên cứu không đúng định dạng',
              'end_year.*.integer' => 'Năm kết thúc đề tài nghiên cứu không đúng định dạng',
              'topic_level.*.required' => 'đề tài cấp không được bỏ trống',
              'responsibility.*.required' => 'Trách nhiệm tham gia trong đề tài nghiên cứu không được bỏ trống',
              'name_of_works.*.required' => 'Tên công trình khoa học không được bỏ trống',
              'year_of_publication.*.required' => 'Năm công bố công trình khoa học không được bỏ trống',
              'year_of_publication.*.digits' => 'Năm công bố công trình khoa học không đúng định dạng',
              'year_of_publication.*.integer' => 'Năm công bố công trình khoa học không đúng định dạng',
              'name_of_journal.*.required' => 'Tên tạp chí không được bỏ trống',

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
        $sb->highest_degree = $request->highest_degree;
        $sb->highest_scientific_title = $request->highest_scientific_title;
        $sb->year_of_appointment = $request->year_of_appointment;
        $sb->address = $request->address;
        $sb->orga_phone_number = $request->orga_phone_number;
        $sb->home_phone_number = $request->home_phone_number;
        $sb->mobile_phone_number = $request->mobile_phone_number;
        $sb->save();

        TPGraduate::where('scientific_background_id', $sb->id)->delete();
        for ($i = 0 ; $i < count($request->industry) ; $i++) {
            $tp_graduate = new TPGraduate;
            $tp_graduate->scientific_background_id = $sb->id;
            $tp_graduate->industry = $request->industry[$i];
            $tp_graduate->type_of_training = $request->type_of_training;
            $tp_graduate->place_of_training = $request->place_of_training;
            $tp_graduate->field_of_study = $request->field_of_study;
            $tp_graduate->nation_of_training = $request->nation_of_training;
            $tp_graduate->year_of_graduation = $request->year_of_graduation[$i];
            $tp_graduate ->save();
        }


        TPPostgraduateMaster::where('scientific_background_id', $sb->id)->delete();
        for ($i = 0 ; $i < count($request->master_field_of_study) ; $i++) {
            $tp_postgraduate_master = new TPPostgraduateMaster;
            $tp_postgraduate_master->scientific_background_id = $sb->id;
            $tp_postgraduate_master->field_of_study = $request->master_field_of_study[$i];
            $tp_postgraduate_master->year_of_issue = $request->master_year_of_issue[$i];
            $tp_postgraduate_master->place_of_training = $request->master_place_of_training[$i];
            $tp_postgraduate_master ->save();
        }
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

        TPForeignLanguage::where('scientific_background_id', $sb->id)->delete();
        for ($i = 0 ; $i < count($request->language) ; $i++) {
            $tp_foreign_language = new TPForeignLanguage;
            $tp_foreign_language->scientific_background_id = $sb->id;

            $tp_foreign_language->language = $request->language[$i];
            $tp_foreign_language->usage_level = $request->usage_level[$i];
            $tp_foreign_language ->save();
        }

        WPProfessional::where('scientific_background_id', $sb->id)->delete();
        for ($i = 0 ; $i < count($request->period_time) ; $i++) {
            $wp_professional = new WPProfessional;
            $wp_professional->scientific_background_id = $sb->id;

            $wp_professional->period_time = $request->period_time[$i];
            $wp_professional->place_of_work = $request->place_of_work[$i];
            $wp_professional->work_of_undertake = $request->work_of_undertake[$i];
            $wp_professional ->save();
        }

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

        SBResearchProcessWork::where('scientific_background_id', $sb->id)->delete();
        for ($i = 0 ; $i < count($request->name_of_works) ; $i++) {
            $sb_research_process_works = new SBResearchProcessWork;
            $sb_research_process_works->scientific_background_id = $sb->id;

            $sb_research_process_works->name_of_works = $request->name_of_works[$i];
            $sb_research_process_works->year_of_publication = $request->year_of_publication[$i];
            $sb_research_process_works->name_of_journal = $request->name_of_journal[$i];
            $sb_research_process_works ->save();
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
        $request->validate(
            [
                'full_name' => 'required',
                'date_of_birth' => 'required',
                'place_of_birth' => 'required',
                'home_town' => 'required',
                'nation' => 'required',
                'highest_degree' => 'required',
                'highest_scientific_title' => 'required',
                'year_of_appointment' => 'required|digits:4|integer|nullable',
                'position' => 'required',
                'unit' => 'required',
                'address' => 'required',
                'email_address'=> 'required|email|unique:personalinformations,email_address,'.$pi->id,
                "type_of_training" => 'required',
                'place_of_training' => 'required',
                'field_of_study' => 'required',
                'nation_of_training' => 'required',
                'industry.*' => 'required',
                'year_of_graduation.*' => 'required|digits:4|integer',
                'master_field_of_study.*' => 'required',
                'master_year_of_issue.*' => 'required|digits:4|integer',
                'master_place_of_training.*'=>'required',
                'doctor_field_of_study.*' => 'required',
                'doctor_year_of_issue.*' => 'required|digits:4|integer',
                'doctor_place_of_training.*'=>'required',
                'thesis_title.*' => 'required',
                'language.*' => 'required',
                'usage_level.*' => 'required',
                'period_time.*' => 'required',
                'place_of_work.*' => 'required',
                'work_of_undertake.*' => 'required',
                'name_of_topic.*' => 'required',
                'start_year.*' => 'required|digits:4|integer',
                'end_year.*' => 'required|digits:4|integer',
                'topic_level.*' => 'required',
                'responsibility.*' => 'required',
                'name_of_works.*' => 'required',
                'year_of_publication.*' =>'required|digits:4|integer',
                'name_of_journal.*' => 'required'
            ],
            [
              'full_name.required' => 'Họ và tên không được bỏ trống',
              'date_of_birth.required' => 'Ngày sinh không được bỏ trống',
              'place_of_birth.required' => 'Nơi sinh không được bỏ trống',
              'home_town.required' => 'Quê quán không được bỏ trống',
              'nation.required' => 'Dân tộc không được bỏ trống',
              'highest_degree.required' => 'Học vị cao nhất không được bỏ trống',
              'highest_scientific_title.required' => 'Chức danh khoa học cao nhất không được bỏ trống',
              'year_of_appointment.required' => 'Năm bổ nhiệm không được bỏ trống',
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
              'industry.*.required' => 'Hệ đào tạo không được bỏ trống',
              'year_of_graduation.*.required' => 'Năm tốt nghiệp không được bỏ trống',
              'year_of_graduation.digits' => 'Năm tốt nghiệp không đúng định dạng',
              'year_of_graduation.integer' => 'Năm tốt nghiệp không đúng định dạng',
              'master_field_of_study.*.required' => 'Thạc sĩ chuyên ngành không được bỏ trống',
              'master_year_of_issue.*.required' => 'Năm cấp bằng thạc sĩ không được bỏ trống',
              'master_year_of_issue.*.digits' => 'Năm cấp bằng thạc sĩ không đúng định dạng',
              'master_year_of_issue.*.integer' => 'Năm cấp bằng thạc sĩ không đúng định dạng',
              'master_place_of_training.*.required' => 'Nơi đào tạo thạc sĩ không được bỏ trống',
              'doctor_field_of_study.*.required' => 'Tiến sĩ chuyên ngành không được bỏ trống',
              'doctor_place_of_training.*.required' => 'Nơi cấp bằng tiến sĩ không được bỏ trống',
              'doctor_year_of_issue.*.required' => 'Năm cấp bằng tiến sĩ không được bỏ trống',
              'doctor_year_of_issue.*.digits' => 'Năm cấp bằng tiến sĩ không đúng định dạng',
              'doctor_year_of_issue.*.integer' => 'Năm cấp bằng tiến sĩ không đúng định dạng',
              'thesis_title.*.required' => 'Tên luận án không được bỏ trống',
              'language.*.required' => 'Ngoại ngữ không được bỏ trống',
              'usage_level.*.required' => 'Mức độ sử dụng ngoại ngữ không được bỏ trống',
              'period_time.*.required' => 'Thời gian công tác chuyên môn không được bỏ trống',
              'place_of_work.*.required' => 'Nơi công tác chuyên môn không được bỏ trống',
              'work_of_undertake.*.required' => 'Công việc đảm nhiệm không được bỏ trống',
              'name_of_topic.*.required' => 'Tên đề tài nghiên cứu không được bỏ trống',
              'start_year.*.required' => 'Năm bắt đầu đề tài nghiên cứu không được bỏ trống',
              'start_year.*.digits' => 'Năm bắt đầu đề tài nghiên cứu không đúng định dạng',
              'start_year.*.integer' => 'Năm bắt đầu đề tài nghiên cứu không đúng định dạng',
              'end_year.*.required' => 'Năm kết thúc đề tài nghiên cứu không được bỏ trống',
              'end_year.*.digits' => 'Năm kết thúc đề tài nghiên cứu không đúng định dạng',
              'end_year.*.integer' => 'Năm kết thúc đề tài nghiên cứu không đúng định dạng',
              'topic_level.*.required' => 'đề tài cấp không được bỏ trống',
              'responsibility.*.required' => 'Trách nhiệm tham gia trong đề tài nghiên cứu không được bỏ trống',
              'name_of_works.*.required' => 'Tên công trình khoa học không được bỏ trống',
              'year_of_publication.*.required' => 'Năm công bố công trình khoa học không được bỏ trống',
              'year_of_publication.*.digits' => 'Năm công bố công trình khoa học không đúng định dạng',
              'year_of_publication.*.integer' => 'Năm công bố công trình khoa học không đúng định dạng',
              'name_of_journal.*.required' => 'Tên tạp chí không được bỏ trống',

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
        $sb->highest_degree = $request->highest_degree;
        $sb->highest_scientific_title = $request->highest_scientific_title;
        $sb->year_of_appointment = $request->year_of_appointment;
        $sb->address = $request->address;
        $sb->orga_phone_number = $request->orga_phone_number;
        $sb->home_phone_number = $request->home_phone_number;
        $sb->mobile_phone_number = $request->mobile_phone_number;
        $sb->save();

        TPGraduate::where('scientific_background_id', $sb->id)->delete();
        for ($i = 0 ; $i < count($request->industry) ; $i++) {
            $tp_graduate = new TPGraduate;
            $tp_graduate->scientific_background_id = $sb->id;
            $tp_graduate->industry = $request->industry[$i];
            $tp_graduate->type_of_training = $request->type_of_training;
            $tp_graduate->place_of_training = $request->place_of_training;
            $tp_graduate->field_of_study = $request->field_of_study;
            $tp_graduate->nation_of_training = $request->nation_of_training;
            $tp_graduate->year_of_graduation = $request->year_of_graduation[$i];
            $tp_graduate ->save();
        }


        TPPostgraduateMaster::where('scientific_background_id', $sb->id)->delete();
        for ($i = 0 ; $i < count($request->master_field_of_study) ; $i++) {
            $tp_postgraduate_master = new TPPostgraduateMaster;
            $tp_postgraduate_master->scientific_background_id = $sb->id;
            $tp_postgraduate_master->field_of_study = $request->master_field_of_study[$i];
            $tp_postgraduate_master->year_of_issue = $request->master_year_of_issue[$i];
            $tp_postgraduate_master->place_of_training = $request->master_place_of_training[$i];
            $tp_postgraduate_master ->save();
        }
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

        TPForeignLanguage::where('scientific_background_id', $sb->id)->delete();
        for ($i = 0 ; $i < count($request->language) ; $i++) {
            $tp_foreign_language = new TPForeignLanguage;
            $tp_foreign_language->scientific_background_id = $sb->id;

            $tp_foreign_language->language = $request->language[$i];
            $tp_foreign_language->usage_level = $request->usage_level[$i];
            $tp_foreign_language ->save();
        }

        WPProfessional::where('scientific_background_id', $sb->id)->delete();
        for ($i = 0 ; $i < count($request->period_time) ; $i++) {
            $wp_professional = new WPProfessional;
            $wp_professional->scientific_background_id = $sb->id;

            $wp_professional->period_time = $request->period_time[$i];
            $wp_professional->place_of_work = $request->place_of_work[$i];
            $wp_professional->work_of_undertake = $request->work_of_undertake[$i];
            $wp_professional ->save();
        }

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

        SBResearchProcessWork::where('scientific_background_id', $sb->id)->delete();
        for ($i = 0 ; $i < count($request->name_of_works) ; $i++) {
            $sb_research_process_works = new SBResearchProcessWork;
            $sb_research_process_works->scientific_background_id = $sb->id;

            $sb_research_process_works->name_of_works = $request->name_of_works[$i];
            $sb_research_process_works->year_of_publication = $request->year_of_publication[$i];
            $sb_research_process_works->name_of_journal = $request->name_of_journal[$i];
            $sb_research_process_works ->save();
        }
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }

    public function getdetailEmployeeSB()
    {
        $pi_id = PI::find(Auth::guard('employee')->user()->personalinformation_id)->id;
        $sb = ScientificBackground::where('personalinformation_id', $pi_id)->firstOrFail();
        return view('employee.sb.employee-sb-detail', compact('pi_id', 'sb'));
    }

}
