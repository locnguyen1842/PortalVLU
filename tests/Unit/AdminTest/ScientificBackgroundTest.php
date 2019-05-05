<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\TPForeignLanguage;
use App\TPPostgraduateDoctor;
use App\TPPostgraduateMaster;
use App\TPGraduate;
use App\PI;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Admin;
use App\Employee;

class ScientificBackgroundTest extends TestCase
{
  use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
     public function test_Scientific_Background_Update()
     {
       $admin = Admin::where('is_supervisor',0)->first();
       $this->actingAs($admin, 'admin');
       $scientific_background = $this->data();
       $pi = PI::find(1);
       $update_scientific_background = $this->post('admin/scientific-background/update/'.$pi->id, $scientific_background);
    //    dd($update_scientific_background);
       $update_scientific_background->assertSessionHas('message', 'Cập nhật thành công');
     }



     public function test_download_SB(){
        $admin = Admin::where('is_supervisor',0)->first();
        $this->actingAs($admin, 'admin');
        $pi_id = PI::whereHas('scientificbackgrounds')->first()->id;
        $response = $this->get('admin/scientific-background/print/'.$pi_id);
        // dd($response);
        $response->assertSee('Data has already been sent to output');
     }

     public function data()
     {
           $actual = [
             "full_name" => "Lâm Tuệ Khương",
             "gender" => "1",
             "date_of_birth" => "1962-12-19",
             "place_of_birth" => "Gia Lai",
             "home_town" => "Kiên Giang",
             "nation" => "1",
             "highest_scientific_title" => "Phó Giáo sư - Tiến Sĩ Công Nghệ Thông Tin",
             "year_of_appointment" => "2018",
             "position" => "1",
             "unit" => "3",
             "address" => "793 Trần Xuân Soạn",
             "email_address" => "taolao024@gmail.com",
             "orga_phone_number" => "123123",
             "home_phone_number" => "123123",
             "mobile_phone_number" => "03325306526",
             "fax" => "12312321",
             "type_of_training" => "Chính quy",
             "place_of_training" => "Văn Lang",
             "field_of_study" => "Công Nghệ Thông Tin",
             "nation_of_training" => "Việt Nam",
             "year_of_graduation_first" => "2018",
             "industry" =>  [
               0 => "Công Nghệ Thông Tin"
             ],
             "year_of_graduation" =>  [
               0 => "2019"
             ],
             "master_field_of_study" =>  [
               0 => "Công Nghệ Thông Tin",
               1 => "Công Nghệ Thông Tin 2",
               2 => "Công Nghệ Thông Tin 3"
             ],
             "master_year_of_issue" =>  [
               0 => "2018",
               1 => "2018",
               2 => "2013"
             ],
             "master_place_of_training" =>  [
               0 => "Văn Lang",
               1 => "Văn Lang",
               2 => "Văn Lang 34"
             ],
             "doctor_field_of_study" =>  [
               0 => "Công Nghệ Thông Tin",
               1 => "Công Nghệ Thông Tin 2",
               2 => "cnntt"
             ],
             "doctor_year_of_issue" =>  [
               0 => "2018",
               1 => "2012",
               2 => "2002"
             ],
             "thesis_title" =>  [
               0 => "Công Nghệ Thông Tin và Đời sống",
               1 => "Công Nghệ Thông Tin và Đời sống 2",
               2 => "ádsdada"
             ],
             "doctor_place_of_training" =>  [
               0 => "Văn Lang",
               1 => "Văn Lang 2",
               2 => "abnnn"
             ],
             "language" =>  [
               0 => "Tiếng Việt 1",
               1 => "Tiếng Anh 1"
             ],
             "usage_level" =>  [
               0 => "Thành thạo",
               1 => "Như người bản xứ"
             ],
             "period_time" =>  [
               0 => "2018 - 2019",
               1 => "2018 - 2019"
             ],
             "place_of_work" =>  [
               0 => "Văn Lang",
               1 => "Văn Lang"
             ],
             "work_of_undertake" =>  [
               0 => "Giảng viên",
               1 => "Cán Bộ Quản Lý"
             ],
             "name_of_topic" =>  [
               0 => "đề tài nghiên cứu 1",
               1 => "đề tài nghiên cứu 2"
             ],
             "start_year" =>  [
               0 => "2016",
               1 => "2017"
             ],
             "end_year" =>  [
               0 => "2017",
               1 => "2018"
             ],
             "topic_level" =>  [
               0 => "1",
               1 => "3"
             ],
             "responsibility" =>  [
               0 => "Quản lý",
               1 => "Quản lý"
             ],
             "name_of_works" =>  [
               0 => "công trình 1",
               1 => "công trình 2",
               2 => "công trinh 8",
               3 => "cong trinh 9"
             ],
             "year_of_publication" =>  [
               0 => "2018",
               1 => "2018",
               2 => "2019",
               3 => "2019"
             ],
             "name_of_journal" =>  [
               0 => "BCD",
               1 => "ABC",
               2 => "đồ đáng ghét",
               3 => "abc"
             ],
           ];
           return $actual;
       }
}
