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

class WorkloadEmployeeTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_search_workload(){
        $employee = Employee::where('username','T154725')->first();
        $this->actingAs($employee,'employee');
        $response = $this->get('/job-workload-list?year_workload=35&semester=4');
        $response->assertSuccessful();
        $response->assertSee('K19T1,2');
      }
}
