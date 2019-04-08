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
class DegreeTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Degree_Create_Admin()
    {
        $admin = Admin::first();
        $this->actingAs($admin,'admin');

        $degree = [
          "degree" => "1",
          "specialized" => "Công Nghệ Thông Tin",
          "date_of_issue" => "2018-12-14",
          "industry" => "1",
          "nation_of_issue_id" => "8",
          "place_of_issue" => "TPHCM",
          "degree_type" => "dai hoc"

        ];
        //
        $pi_id = 1;
        $addde = $this->post('/admin/pi-degree-create/'.$pi_id,$degree);

        $addde->assertSessionHas('message','Thêm thành công');

    }
    public function test_Degree_Update_Admin()
    {
        $admin = Admin::first();
        $this->actingAs($admin,'admin');

        $degree = [
          "degree" => "1",
          "specialized" => "Công Nghệ Thông Tin",
          "date_of_issue" => "2018-12-14",
          "industry" => "1",
          "nation_of_issue_id" => "7",
          "place_of_issue" => "TPHCM",
          "degree_type" => "dai hoc"

        ];
        //
        $pi = PI::find(1);
        $addde = $this->post('/admin/pi-degree-update/'.$pi->degreedetails->first()->id,$degree);
        $addde->assertSessionHas('message','Cập nhật thành công');

    }

    public function test_delete_degreedetail(){
        $admin = Admin::first();
        $this->actingAs($admin,'admin');
        $pi = PI::find(1);

        $response = $this->get('/admin/pi-degree-delete/'.$pi->degreedetails->first()->id);
        $response->assertSessionHas('message','Xóa thông tin nhân viên thành công');
    }

}
