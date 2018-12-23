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
            'date_of_issue' => '1999-02-02',
            'place_of_issue' =>'Mot noi rat xa',
            'degree' =>1,
            'specialized'=> 1,
            'industry'=> 1,

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
            'date_of_issue' => '1999-02-03',
            'place_of_issue' =>'Mot noi rat xa xoi',
            'degree' =>1,
            'specialized'=> 1,
            'industry'=> 1,

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
