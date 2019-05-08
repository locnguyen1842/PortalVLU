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
use App\DegreeDetail;
use App\Admin;
use Hash;
use App\Employee;

class DegreeEmployeeTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Degree_Create_Admin()
    {
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');

        $degree = [
          "degree" => "1",
          "specialized" => "Công Nghệ Thông Tin",
          "date_of_issue" => "2018-12-14",
          "nation_of_issue_id" => "8",
          "place_of_issue" => "TPHCM",
          "degree_type" => "dai hoc"
        ];
        //
        $pi_id = 1;
        $addde = $this->post('/pi-degree-create', $degree);

        $addde->assertSessionHas('message', 'Thêm thành công');
    }
    public function test_Degree_Update_Admin()
    {
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');
        $degree = [
          "degree" => "1",
          "specialized" => "Công Nghệ Thông Tin",
          "date_of_issue" => "2018-12-14",
          "nation_of_issue_id" => "7",
          "place_of_issue" => "TPHCM",
          "degree_type" => "dai hoc"
        ];
        //
        $addde = $this->post('/pi-update-degree-detail/'.$employee->pi->degreedetails->first()->id, $degree);
        $addde->assertSessionHas('message', 'Cập nhật thành công');
    }

    public function test_delete_degreedetail()
    {
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');
        $pi = $employee->pi;
        $degreedetail_id = $pi->degreedetails->first()->id;
        $response = $this->get('/pi-degree-delete/'.$degreedetail_id);
        $response->assertSessionHas('message', 'Xóa thành công');

    }

    public function test_delete_academic_rank(){
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');
        $pi = $employee->pi;

        $response = $this->get('/academic-rank/delete/');
        $response->assertSessionHas('message','Xóa học hàm thành công');
    }

    public function test_Academic_Update()
    {
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');
        $pi = $employee->pi;

        $academic_rank = [
            "academic_rank_type" => "1",
            "specialized" => "Công Nghệ Thông Tin",
            "date_of_recognition" => "2018-12-14",

        ];
        //
        $pi = PI::find(1);
        $addde = $this->post('/academic-rank/update/',$academic_rank);
        $addde->assertSessionHas('message','Cập nhật thành công');

    }
    public function test_Academic_Create()
    {
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');
        $pi = $employee->pi;
        $pi->academic_rank->delete();
        $academic_rank = [
          "academic_rank_type" => "1",
          "specialized" => "Công Nghệ Thông Tin",
          "date_of_recognition" => "2018-12-14",

        ];
        //
        $pi = PI::where('employee_code','T155444')->first();
        $addde = $this->post('/academic-rank/create/',$academic_rank);
        $addde->assertSessionHas('message','Thêm mới thành công');

    }
}
