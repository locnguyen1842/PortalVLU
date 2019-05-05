<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Workload;
use App\PI;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Admin;
use App\Employee;

class WorkloadTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_Workload_Update()
    {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $workload = $this->data();
        $pi = PI::first();
        $updateworkload = $this->post('/admin/workload-update/'.$pi->workloads->first()->id, $workload);

        $updateworkload->assertSessionHas('message', 'Cập nhật thành công');
    }

    public function test_Workload_Update_With_Empty_Data()
    {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $workload = [
         'semester' =>1,
         'session_id' =>28,
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
        $updateworkload = $this->post('/admin/workload-update/'.$pi->workloads->first()->id, $workload);
        $updateworkload->assertSessionHasErrors([
         'subject_code'=> 'Mã môn học không được bỏ trống',
         'subject_name'=> 'Tên môn học không được bỏ trống',
         ]);
    }
    public function data()
    {
        $actual = [
         'semester' =>1,
         'session_id' =>32,
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

    public function data1()
    {
        $actual = [
            'employee_code' => 'T154725',
            'session_new' =>0,
            'session_id' =>32,
            'start_year' =>2099,
            'end_year' => 2100,
            'subject_code' =>['AV07'],
            'subject_name' =>['Anh Văn 7'],
            'number_of_lessons'=> [45],
            'class_code' =>['K21T02'],
            'number_of_students' =>[45],
            'total_workload' =>[50],
            'theoretical_hours' =>[45],
            'practice_hours' =>[5],
            'semester' =>[1],
            'note' =>[''],
            'unit_id' => [2]

        ];
        return $actual;
    }
    public function test_add_workload_correct_data()
    {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $actual = $this->data1();
        $response = $this->post('/admin/workload-add', $actual);
        $response->assertSessionHas('message', 'Thêm thành công');
    }

    public function test_add_workload_with_not_exists_employee_code()
    {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $actual = $this->data1();
        $actual['employee_code'] = 'T999999';
        $response = $this->post('/admin/workload-add', $actual);
        $response->assertSessionHasErrors([
            'employee_code'=> 'Mã giảng viên không tồn tại'
        ]);
    }
    public function test_delete_a_workload()
    {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $workload_id = Workload::first()->id;
        $response = $this->get('/admin/workload-delete/'.$workload_id);
        $response->assertSessionHas('message', 'Xóa thông tin nhân viên thành công');
    }
    public function test_search_workload_admin()
    {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $response = $this->get('/admin/job-workload-list?search=T154725&year_workload=32');
        $response->assertSuccessful();
        $response->assertSee('T154725'); // see name of T154725 code when search successful
        $response->assertSee('T');
    }
    public function test_search_workload_on_list_of_a_specific_pi()
    {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $response = $this->get('/admin/pi-detail/1/job-workload?search=Điều&year_workload=35&semester=4');
        $response->assertSuccessful();
        $response->assertSee('1'); // see name of T154725 code when search successful
        $response->assertSee('T');
    }
    public function test_search_srworkload_on_list_of_a_specific_pi()
    {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $response = $this->get('/admin/pi-detail/1/scientific-research-workload?year_workload=39');
        $response->assertSuccessful();
        $response->assertSee('1'); // see name of T154725 code when search successful
        $response->assertSee('T154725');
    }
}
