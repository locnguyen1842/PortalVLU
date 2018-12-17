<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Auth;
use Illuminate\Support\Facades\Session;
use App\PI;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class Viewtest extends TestCase
{

    use RefreshDatabase;
    use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function login_admin(){
        $admin = $this->create_user_for_login();
        $this->actingAs($admin,'admin');
    }
    public function create_user_for_login()
    {
        $actual = $this->data();
        $addPI = $this->post('/admin/pi-add', $actual);
        $pi = PI::where('employee_code', $actual['employee_code'])->first();//
         return Admin::create([
            'username' => $pi->employee_code,
            'password' => Hash::make($pi->employee_code),
            'personalinformation_id' => $pi->id,
            'email' => $pi->email_address,

        ]);
    }


    public function data()
    {
        $actual = [
            'employee_code' => 'T153772',
            'full_name' => 'Le Thanh Son',
            'nation' => 'Kinh',
            'gender' => 1,
            'date_of_birth' => '1997-04-10',
            'place_of_birth' => 'TPHCM',
            'permanent_address' => 'An Giang',
            'contact_address' => 'An Giang',
            'phone_number' => '0123456789',
            'email_address' => 'lethanhson2910@gmail.com',
            'position' => 'Quan ly',
            'date_of_recruitment' => '2018-04-10',
            'professional_title' => 'Lao cong',
            'identity_card' => '321368999',
            'date_of_issue' => '2015-04-10',
            'place_of_issue' => 'TPHCM',

        ];
        return $actual;
    }
    public function test_view_list_PI()
    {
        $this->login_admin();
        $response = $this->get('/admin/pi-list');
        $this->assertEquals(200, $response->status()); // kiem tra co truy cap duoc web k
        $response->assertViewHas('pis'); //kiem tra xem view co' bien' $pis k . doi voi view create khoi can assertViewHas

    }
}
