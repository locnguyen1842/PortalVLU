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
        $response->assertSessionHas('message', 'Thêm thành công');

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
        $response->assertSessionHas('message', 'Xóa thành công');
     }



     public function data()
     {
         $actual = [
          'employee_code' =>'T154725',
          'name_of_work' => 'ABCD',
          'session' =>33,
          'detail_of_work' => 'Khong co gi',
          'quantity_of_work' => 20,
          'converted_standard_time' => 20,
          'converted_time' => 20,
          'note' => ''
        ];
        return $actual;
     }
}
