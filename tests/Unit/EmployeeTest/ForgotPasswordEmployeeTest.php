<?php

namespace Tests\Unit;

use App\Employee;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Hash;
use Password;
use Auth;

class ForgotPasswordEmployeeTest extends TestCase
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

    public function test_get_Forgot_Password_Form_Employee()
    {
        $response = $this->get('/password/reset');
        $this->assertEquals(200, $response->status());
    }
    public function test_Forgot_Password_Employee()
    {
        $data = [
          'employee_code' => 'T155444'
        ];
        $employee = Employee::where('username', $data['employee_code'])->first();
        $forgot_password = $this->post('/password/email', $data);
        $forgot_password->assertSessionHas([
          'status'=> 'Yêu cầu khôi phục mật khẩu thành công. Vui lòng kiểm tra email!',
        ]);
    }
    public function test_get_Reset_Password_Form_Employee()
    {
        $employee  = Employee::where('username', 'T155444')->first();
        $data = [
          'email' => $employee->email,
          'password' => 'T155444',
          'password_confirmation' => 'T155444',
        ];
        $token = Password::broker('employees')->createToken($employee);
        $reset_password_form = $this->get('password/reset/'.$token);
        $this->assertEquals(200, $reset_password_form->status());
    }
    public function test_Reset_Password_Employee()
    {
        $employee  = Employee::where('username', 'T155444')->first();
        $token = Password::broker('employees')->createToken($employee);
        $data = [
          'email' => $employee->email,
          'password' => 'T155444',
          'password_confirmation' => 'T155444',
          'token' => $token
        ];
        $reset_password = $this->post('password/reset/', $data);
        $employee  = Employee::where('username', 'T155444')->first();
        $this->assertTrue(Hash::check($data['password'], $employee->password));
    }
    public function test_Incorrect_Forgot_Password_Employee()
    {
        $data = [
          'employee_code' => 'T15555'
        ];
        $admin = Employee::where('username', $data['employee_code'])->first();
        $forgot_password = $this->post('/password/email', $data);
        $forgot_password->assertSessionHas([
          'error' => 'Tài khoản không tồn tại.'
        ]);
    }
}
