<?php

namespace Tests\Unit;
use App\Admin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Hash;

use Password;
use Auth;

class ForgotPasswordTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
     public function setUp()
      {
          parent::setUp();
          Notification::fake();
      }

     public function test_View_Forgot_Password_Admin()
     {
         $response = $this->get('/admin/password/reset');
         $this->assertEquals(200, $response->status());
     }
     public function test_Forgot_Password_Admin()
     {
       $data = [
         'employee_code' => 'T154725'
       ];
       $admin = Admin::where('username',$data['employee_code'])->first();
       $forgot_password = $this->post('/admin/password/email',$data);
       $forgot_password->assertSessionHas([
         'status'=> 'Yêu cầu khôi phục mật khẩu thành công. Vui lòng kiểm tra email!',
       ]);
     }

     public function test_get_reset_password_form_admin(){
       $admin  = Admin::where('username','T154725')->first();
       $data = [
         'email' => $admin->email,
         'password' => 'T154725',
         'password_confirmation' => 'T154725',

       ];

       $token = Password::broker('admins')->createToken($admin);
       $reset_password_form = $this->get('/admin/password/reset/'.$token);
       $this->assertEquals(200, $reset_password_form->status());


     }

     public function test_reset_password_admin(){
       $admin  = Admin::where('username','T154725')->first();
       $token = Password::broker('admins')->createToken($admin);
       $data = [
         'email' => $admin->email,
         'password' => 'T154727',
         'password_confirmation' => 'T154727',
         'token' => $token

       ];

       $reset_password = $this->post('/admin/password/reset/',$data);
       $admin  = Admin::where('username','T154725')->first();
       // dd($admin->password);
       $this->assertTrue(Hash::check( $data['password'],$admin->password));
     }




}
