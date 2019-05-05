<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Auth;
use App\DegreeDetail;
use Illuminate\Support\Facades\Session;
use App\PI;
use App\Employee;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\Workload;
use App\WorkloadSession;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewFacultyLeaderTest extends TestCase
{
      use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function login_faculty_leader()
    {
        $faculty_leader = Employee::where('username', 'T154725')->first();
        $this->actingAs($faculty_leader, 'employee');
        $pi = $faculty_leader->pi;
        return $pi;
    }
    public function test_view_Detail_Scientific_Background_Employee()
    {
        $this->login_faculty_leader();
        $pi = PI::where('unit_id', '2')->first()->id;
        $response = $this->get('faculty-sb-detail/'.$pi);
        $response->assertViewHas('id');
        $response->assertViewHas('sb');
        $response->assertViewHas('pi');
    }
    public function test_view_Detail_Job_Workload_Employee()
      {
          $this->login_faculty_leader();
          $pi = PI::where('unit_id', '2')->first()->id;
          $response = $this->get('faculty-job-workload/'.$pi);
          $response->assertViewHas('semester_filter');
          $response->assertViewHas('pi');
          $response->assertViewHas('semester');
          $response->assertViewHas('workload_session');
          $response->assertViewHas('workload_session_current');
          $response->assertViewHas('workloads');
          $response->assertViewHas('search');
          $response->assertViewHas('year_workload');
      }
      public function test_view_Detail_Imformation_Employee()
      {
          $this->login_faculty_leader();
          $pi = PI::where('unit_id', '2')->first()->id;
          $response = $this->get('faculty-degree-list/'.$pi);
          $response->assertViewHas('dh_count');
          $response->assertViewHas('ths_count');
          $response->assertViewHas('pi');
          $response->assertViewHas('ts_count');
      }
      public function test_view_List_Employees_By_Faculty()
      {
          $this->login_faculty_leader();
          $response = $this->get('faculty-index/');
          $response->assertViewHas('pis');
          $response->assertViewHas('search');
      }

}
