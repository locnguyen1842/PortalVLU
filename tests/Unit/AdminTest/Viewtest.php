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
    
    // public function data()
    // {
    //     $actual = [
    //         'employee_code' => 'T153772',
    //         'full_name' => 'Le Thanh Son',
    //         'nation' => 'Kinh',
    //         'gender' => 1,
    //         'date_of_birth' => '1997-04-10',
    //         'place_of_birth' => 'TPHCM',
    //         'permanent_address' => 'An Giang',
    //         'contact_address' => 'An Giang',
    //         'phone_number' => '0123456789',
    //         'email_address' => 'lethanhson2910@gmail.com',
    //         'position' => 'Quan ly',
    //         'date_of_recruitment' => '2018-04-10',
    //         'professional_title' => 'Lao cong',
    //         'identity_card' => '321368999',
    //         'date_of_issue' => '2015-04-10',
    //         'place_of_issue' => 'TPHCM',
    //
    //     ];
    //     return $actual;
    // }
    // public function data_Degree_Details()
    // {
    //     $data = [
    //     'date_of_issue' => '2018-04-10',
    //     'place_of_issue' => 'TPHCM',
    //     'degree' => 1,
    //     'industry'=> 1,
    //     'specialized'=> 1 ,
    //
    //   ];
    //     return $data;
    // }
}
