<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Workload;
use App\PI;
use App\Admin;
class WorkloadTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     public function test_Workload_Update()
     {
         $admin = Admin::first();
         $this->actingAs($admin,'admin');
         $workload = $this->data();
         $pi = PI::find(1);
         $updateworkload = $this->post('/admin/workload-update/'.$pi->workloads->first()->id,$workload);
         $updateworkload->assertSessionHas('message','Cập nhật thành công');
     }

     public function test_Workload_Update_With_Empty_Data()
     {
       $admin = Admin::first();
       $this->actingAs($admin,'admin');
       $workload = [
         'semester' =>1,
         'session_id' =>1,
         'number_of_lessons' => 60,
         'class_code' =>'AP12',
         'total_workload' =>50,
         'number_of_students' => 40,
         'number_of_lessons' => 40,
         'theoretical_hours' =>40,
         'practice_hours' =>20,
         'unit_id' =>1,
         'note' =>'',
       ];
       $pi = PI::find(1);
       $updateworkload = $this->post('/admin/workload-update/'.$pi->workloads->first()->id,$workload);
       $updateworkload->assertSessionHasErrors([
         'subject_code'=> 'Mã môn học không được bỏ trống',
         'subject_name'=> 'Tên môn học không được bỏ trống',
         ]);
     }
     public function data()
     {
         $actual = [
         'semester' =>1,
         'session_id' =>1,
         'subject_code'=> 'NL31A',
         'subject_name' =>'Anh Phap',
         'number_of_lessons' => 60,
         'class_code' =>'AP12',
         'total_workload' =>50,
         'number_of_students' => 40,
         'number_of_lessons' => 40,
         'theoretical_hours' =>40,
         'practice_hours' =>20,
         'unit_id' =>1,
         'note' =>'',
       ];
         return $actual;
     }


}
