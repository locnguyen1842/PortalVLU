<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Admin;
use App\ScientificResearchWorkload;


class ScientificResearchWorkloadTest extends TestCase
{
  use DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */


     public function test_Add_Scientific_Research_Workload()
     {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $data = $this->data();
        $response = $this->post('/admin/scientific-research-workload-add', $data);
        // dd($response);
        $response->assertSessionHas('message', 'Thêm thành công');

     }

     public function test_search_Scientific_Research_Workload(){
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $response = $this->post('/admin/scientific-research-workload-list?search=T154725&year_workload=39');
        $response->assertSee('Lê Thanh Sơn 10');
     }

     public function test_Update_Scientific_Research_Workload()
     {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $data = $this->data();
        $sr = ScientificResearchWorkload::first()->id;
        $response = $this->post('/admin/scientific-research-workload-update/'.$sr, $data);
        $response->assertSessionHas('message', 'Cập nhật thành công');
     }

     public function test_Delete_Scientific_Research_Workload()
     {
        $admin = Admin::first();
        $this->actingAs($admin, 'admin');
        $sr = ScientificResearchWorkload::first()->id;
        $response = $this->get('/admin/scientific-research-workload-delete/'.$sr);
        $response->assertSessionHas('message', 'Xóa khối lượng nghiên cứu khoa học thành công');
     }



     public function data()
     {
         $actual = [
          'employee_code' =>'T154725',
          'name_of_work' => 'ABCD',
          'session_id' =>33,
          'session_new' => 0,
          'start_year' => 1999,
          'end_year' => 2000,
          'detail_of_work' => 'Khong co gi',
          'explain_of_work' => 'Khong co gi',
          'unit_of_work' => 'Khong co gi',
          'quantity_of_work' => 20,
          'converted_standard_time' => 20,
          'converted_time' => 20,
          'note' => 'a'
        ];
        return $actual;
     }
}
