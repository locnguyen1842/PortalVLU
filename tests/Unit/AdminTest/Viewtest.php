<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Auth;
use App\ConfirmationRequest;
use App\DegreeDetail;
use Illuminate\Support\Facades\Session;
use App\PI;
use App\Employee;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\Workload;
use App\WorkloadSession;
use App\ScientificResearchWorkload;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function login_admin()
    {
        $admin = Admin::where('username', 'T154725')->first();
        $this->actingAs($admin, 'admin');
        return $admin;
    }
    public function login_employee()
    {
        $employee = Employee::where('username', 'T154725')->first();
        $this->actingAs($employee, 'employee');
        return $employee;
    }
    //

    public function test_view_list_PI()
    {
        $this->login_admin();
        $response = $this->get('/admin/pi-list');
        $this->assertEquals(200, $response->status()); // kiem tra co truy cap duoc web k
        $response->assertViewHas('pis'); //kiem tra xem view co' bien' $pis k . doi voi view create khoi can assertViewHas
    }
    public function test_view_Detail_Admin_PI()
    {
        $this->login_admin();
        $pi = Pi::first()->id;
        $response = $this->get('/admin/pi-detail/'.$pi);
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('pi');
    }
    public function test_view_Update_PI()
    {
        $this->login_admin();
        $pi =Pi::first()->id;
        $response = $this->get('/admin/pi-update/'.$pi);
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('pi');
        $response->assertViewHas('nations');
    }
    public function test_view_Degree_Create()
    {
        $this->login_admin();
        $pi_id = PI::first()->id;
        $response = $this->get('/admin/pi-degree-create/'.$pi_id);
        // dd($degreedetail_id);
        $this->assertEquals(200, $response->status());
    }
    public function test_view_Degree_List()
    {
        $this->login_admin();
        $pi_id = PI::first()->id;
        $response = $this->get('/admin/pi-degree-list/'.$pi_id);
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('degrees');
        $response->assertViewHas('pi');
    }
    public function test_view_Update_Degree()
    {
        $this->login_admin();
        $degreedetail_id = DegreeDetail::first()->id;
        $response = $this->get('/admin/pi-degree-update/'.$degreedetail_id);
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('degrees');
        $response->assertViewHas('industries');
        $response->assertViewHas('pi');
    }
    public function test_view_Change_Password()
    {
        $this->login_admin();
        $response = $this->get('/admin/pi-changepass');
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('admin');
    }
    public function test_view_Add_PI()
    {
        $this->login_admin();
        $response = $this->get('/admin/pi-add');
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('nations');
    }
    public function test_view_Login()
    {
        $response = $this->get('/admin/login');
        $this->assertEquals(200, $response->status());
    }
    public function test_view_Logout()
    {
        $response = $this->get('/admin/login');
        $this->assertEquals(200, $response->status());
    }
    public function test_view_Workload_List()
    {
        $this->login_admin();
        $response = $this->get('/admin/job-workload-list');
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('workload_session');
        $response->assertViewHas('workload_session_current');
        $response->assertViewHas('workloads');
        $response->assertViewHas('search');
        $response->assertViewHas('year_workload');
    }
    public function test_view_Workload_Add()
    {
        $this->login_admin();
        $response = $this->get('/admin/workload-add');
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('workload');
        $response->assertViewHas('pi');
        $response->assertViewHas('ws');
        $response->assertViewHas('se');
        $response->assertViewHas('unit');
    }
    public function test_view_Workload_Add_by_pi_id()
    {
        $pi = PI::first();
        $this->login_admin();
        $response = $this->get('/admin/workload-add?pi_id='.$pi->id);
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('workload');
        $response->assertViewHas('pi');
        $response->assertViewHas('ws');
        $response->assertViewHas('se');
        $response->assertViewHas('unit');
    }
    public function test_view_Workload_Update()
    {
        $this->login_admin();
        $workload_id = Workload::first()->id;
        $response = $this->get('/admin/workload-update/'.$workload_id);
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('workload');
        $response->assertViewHas('pi');
        $response->assertViewHas('ws');
        $response->assertViewHas('se');
        $response->assertViewHas('unit');
    }
    public function test_view_Workload_Detail_Admin()
    {
        $this->login_admin();
        $workload_id = Workload::first()->id;
        $response = $this->get('/admin/workload-details/'.$workload_id);
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('workload');
        $response->assertViewHas('pi');
    }
    public function test_view_Workload_Detail_Employee()
    {
        $employee = $this->login_employee();
        $workload_id = $employee->pi->workloads->first()->id;
        $response = $this->get('/workload-details/'.$workload_id);
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('workload');
        $response->assertViewHas('pi');
    }

    public function test_view_a_employee_cant_access_other_employees_workload_detail()
    {
        $employee = $this->login_employee();
        $pi_id = PI::where('employee_code','T155444')->first()->id;
        $workload_id = Workload::where('personalinformation_id',$pi_id)->first()->id;
        // dd($workload_id);
        $response = $this->get('/workload-details/'.$workload_id);
        $this->assertEquals(403, $response->status());
    }
    public function test_view_PI_Workload_List()
    {
        $this->login_admin();
        $pi = PI::first()->id;
        $response = $this->get('/admin/pi-detail/'.$pi.'/job-workload');
        $this->assertEquals(200, $response->status());
        $response->assertViewHas('semester_filter');
        $response->assertViewHas('semester');
        $response->assertViewHas('pi_id');
        $response->assertViewHas('workload_session');
        $response->assertViewHas('workload_session_current');
        $response->assertViewHas('workloads');
        $response->assertViewHas('search');
        $response->assertViewHas('year_workload');
    }
    public function test_view_Scientific_Background_Update()
    {
      $this->login_admin();
      $pi = PI::first()->id;
      $response = $this->get('admin/scientific-background/update/'.$pi);
      $this->assertEquals(200, $response->status());
      $response->assertViewHas('pi_id');
      $response->assertViewHas('sb');
      $response->assertViewHas('nations');
      $response->assertViewHas('units');
      $response->assertViewHas('topic_levels');
    }

    public function test_view_Scientific_Background_Detail()
    {
      $this->login_admin();
      $pi = PI::first()->id;
      $response = $this->get('admin/scientific-background/detail/'.$pi);
      $response->assertViewHas('pi_id');
      $response->assertViewHas('sb');
    }

    public function test_view_list_school_year(){
        $this->login_admin();
        $response = $this->get('admin/year-list');
        $response->assertSuccessful();
        $response->assertViewHas('yearlist');

    }

    public function test_view_add_school_year(){
        $this->login_admin();
        $response = $this->get('admin/schoolyear-add');
        $response->assertSuccessful();
    }

    public function test_view_update_school_year(){
        $this->login_admin();
        $workloadsession = WorkloadSession::first();
        $response = $this->get('admin/schoolyear-update/'.$workloadsession->id);
        $response->assertSuccessful();
        $response->assertViewHas('yearlist');
    }

    public function test_view_statistical(){
        $this->login_admin();
        $response = $this->get('admin/statistical');
        $response->assertSuccessful();
        $response->assertViewHas('pis');
        $response->assertViewHas('officers');
        $response->assertViewHas('teachers');
    }

    public function test_view_create_academic_rank(){
        $this->login_admin();
        $pi = PI::find(29);
        $response = $this->get('admin/academic-rank/create/'.$pi->id);
        $response->assertSuccessful();
    }

    public function test_view_update_academic_rank(){
        $this->login_admin();
        $pi = PI::find(16);
        $response = $this->get('admin/academic-rank/update/'.$pi->id);
        $response->assertSuccessful();
    }

    public function test_View_Update_Confirmation_Request(){
      $this->login_admin();
      $cr = ConfirmationRequest::first();
      $response = $this->get('/admin/confirmation-request/update/'.$cr->id);
      $response->assertViewHas('pi');
      $response->assertViewHas('cr');
    }

    public function test_View_List_Confirmation_Request(){
      $this->login_admin();
      $response = $this->get('/admin/confirmation-request/index');
      $response->assertViewHas('search');
      $response->assertViewHas('crs');
      $response->assertViewHas('status');
    }

    public function test_View_Detail_Confirmation_Request(){
      $this->login_admin();
      $cr = ConfirmationRequest::first();
      $response = $this->get('/admin/confirmation-request/preview/'.$cr->id);
      $response->assertViewHas('cr');
    }

    public function test_Add_Scientific_Research_Workload(){
      $this->login_admin();
      $response = $this->get('/admin/scientific-research-workload-add');
      $response->assertViewHas('pi');
      $response->assertViewHas('ws');
    }

    public function test_Update_Scientific_Research_Workload(){
      $this->login_admin();
      $sr = ScientificResearchWorkload::first();
      $response = $this->get('/admin/scientific-research-workload-update/'.$sr->id);
      $response->assertViewHas('pi');
      $response->assertViewHas('ws');
      $response->assertViewHas('srworkload');
    }

    public function test_View_List_Scientific_Research_Workload(){
      $this->login_admin();
      $response = $this->get('/admin/scientific-research-workload-list');
      $response->assertViewHas('workload_session');
      $response->assertViewHas('workload_session_current');
      $response->assertViewHas('workloads');
      $response->assertViewHas('year_workload');
    }

    public function test_View_Detail_Scientific_Research_Workload(){
      $this->login_admin();
      $sr = ScientificResearchWorkload::first();
      $response = $this->get('/admin/scientific-research-workload-details/'.$sr->id);
      $response->assertViewHas('srworkload');
      $response->assertViewHas('pi');
    }

}
