<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Auth;
use Illuminate\Support\Facades\Session;
use App\PI;
use Illuminate\Support\Facades\Hash;
use App\Employee;
use App\DegreeDetail;

class ViewEmployeeTest extends TestCase
{
    use DatabaseTransactions;

    public function login_employee()
    {
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');
        $pi = $employee->pi;
        return $pi;
    }
    public function test_view_Detail_Employee()
    {
      $this->login_employee();
      $response = $this->get('/pi-detail');
      $this->assertEquals(200, $response->status());
      $response->assertViewHas('pi');
    }
    public function test_view_Update_PI_Employee()
    {
        $this->login_employee();
        $response = $this->get('/pi-update');
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('pi');
        $response->assertViewHas('nations');
    }
    public function test_view_Degree_Create_Employee()
    {
        $this->login_employee();
        $response = $this->get('/pi-degree-create');
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('degrees');
        $response->assertViewHas('industries');
        $response->assertViewHas('pi');
        $response->assertViewHas('specializes');
    }
    public function test_view_Degree_List_Employee()
    {
        $this->login_employee();
        $response = $this->get('/pi-degree-list');
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('degrees');
        $response->assertViewHas('industries');
        $response->assertViewHas('pi');
    }
    public function test_view_Update_Degree_Employee()
    {
        $pi = $this->login_employee();
        $degreedetail_id = $pi->degreedetails->first()->id;
        $response = $this->get('/pi-update-degree-detail/'.$degreedetail_id);
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('degrees');
        $response->assertViewHas('industries');
        $response->assertViewHas('pi');
    }
    public function test_view_Change_Password_Employee()
    {
        $this->login_employee();
        $response = $this->get('/pi-changepass');
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('employee');
    }
    public function test_view_Login_Employee()
    {
        $response = $this->get('/login');
        $this->assertEquals(200, $response->status());
    }
    public function test_view_Logout_Employee()
    {
        $response = $this->get('/login');
        $this->assertEquals(200, $response->status());
    }
    public function test_view_Workload_List_Employee()
    {
      $this->login_employee();
      $response = $this->get('/workload-list');
      $this->assertEquals(200, $response->status());
      $response->assertViewHas('semester_filter');
      $response->assertViewHas('semester');
      $response->assertViewHas('workload_session');
      $response->assertViewHas('workload_session_current');
      $response->assertViewHas('workloads');
      $response->assertViewHas('year_workload');
      // $response->assertViewHas('workload');
      $response->assertViewHas('pi');
    }

    public function test_view_Workload_Details_Employee()
    {
      $pi= $this->login_employee();

      $id_workload = $pi->workloads->first()->id;
      $response = $this->get('/workload-details/'.$id_workload);
      $response->assertViewHas('workload');
      // $response->assertViewHas('pi');
    }
    // public function data()
    // {
    //     $data = [
    //           'employee_code' => 'T153772',
    //           'full_name' => 'Le Thanh Son',
    //           'nation' => 'Kinh',
    //           'gender' => 1,
    //           'date_of_birth' => '1997-04-10',
    //           'place_of_birth' => 'TPHCM',
    //           'permanent_address' => 'An Giang',
    //           'contact_address' => 'An Giang',
    //           'phone_number' => '0123456789',
    //           'email_address' => 'lethanhson2910@gmail.com',
    //           'position' => 'Quan ly',
    //           'date_of_recruitment' => '2018-04-10',
    //           'professional_title' => 'Lao cong',
    //           'identity_card' => '321368999',
    //           'date_of_issue' => '2015-04-10',
    //           'place_of_issue' => 'TPHCM',
    //
    //       ];
    //     return $data;
    // }
}
