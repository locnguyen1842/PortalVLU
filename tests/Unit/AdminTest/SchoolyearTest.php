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
use App\WorkloadSession;
class SchoolyearTest extends TestCase
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
    public function test_delete_a_Schoolyear(){

        $this->login_admin();
        $workloadsession = WorkloadSession::first();
        $response = $this->get('/admin/year-delete/'.$workloadsession->id);

        $response->assertSessionHas('message','Xóa năm học thành công');
      }
      public function test_Schooolyear_Update()
      {
        $this->login_admin();
          $data = $this->data();
          $workloadsession = WorkloadSession::first();
        //   dd($workloadsession);
          $updateyear = $this->post('/admin/schoolyear-update/'.$workloadsession->id, $data);
        //   dd($updateyear);
          $updateyear->assertSessionHas('message', 'Cập nhật thành công');
      }
      public function test_Schooolyear_Add()
      {
        $this->login_admin();
          $data = $this->data();
          $updateyear = $this->post('/admin/schoolyear-add', $data);
          $updateyear->assertSessionHas('message', 'Thêm thành công');
      }
    public function data()
    {
        $actual = [
        'start_year' => 2030,
        'end_year' =>2031,
        ];
        return $actual;
    }
    //
}
