<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Auth;
use App\DegreeDetail;
use Illuminate\Support\Facades\Session;
use App\PI;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\Workload;
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
        $degreedetail_id = DegreeDetail::first()->id;
        $response = $this->get('/admin/pi-degree-create/'.$degreedetail_id);
        $this->assertEquals(200, $response->status());
    }
    public function test_view_Degree_List()
    {
        $this->login_admin();
        $degreedetail_id = DegreeDetail::first()->id;
        $response = $this->get('/admin/pi-degree-list/'.$degreedetail_id);
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
      $response = $this->get('/admin/workload-list');
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
    public function test_view_Workload_Detail()
    {
      $this->login_admin();
      $workload_id = Workload::first()->id;
      $response = $this->get('/admin/workload-details/'.$workload_id);
      $this->assertEquals(200, $response->status());
      $response->assertViewHas('workload');
      $response->assertViewHas('pi');
    }
    public function test_view_PI_Workload_List()
    {
      $this->login_admin();
      $pi = PI::first()->id;
      $response = $this->get('/admin/pi-detail/'.$pi.'/workload');
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


}
