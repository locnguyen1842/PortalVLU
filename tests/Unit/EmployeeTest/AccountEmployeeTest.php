<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use App\PI;
use App\Employee;
use Hash;

class AccountEmployeeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Change_My_Password_Employee()
    {
        $user = Employee::where('username', 'T155444')->first();
        $user->password = Hash::make('T155444');
        $user->save();
        $this->actingAs($user, 'employee');
        $changepassword= $this->post('/pi-changepass', [
            'password' => 'T155444',
            'newpassword' =>'t123456',
            'comfirmpassword' =>'t123456',
        ]);
        $user = Employee::where('username', 'T155444')->first();
        $this->assertTrue(Hash::check('t123456', $user->password));//
    }
    public function test_Incorrect_Change_My_Password_Employee()
    {
        $user = Employee::where('username', 'T155444')->first();
        $user->password = Hash::make('T155444');
        $user->save();
        $this->actingAs($user, 'employee');
        $changepassword= $this->post('/pi-changepass', [
            'password' => 'T1547123',
            'newpassword' =>'t123456',
            'comfirmpassword' =>'t123456',
        ]);
        $user = Employee::where('username', 'T155444')->first();
        $this->assertFalse(Hash::check('t123456', $user->password));//
    }
    public function test_Empty_Password_Change_My_Password_Employee()
    {
        $user = Employee::where('username', 'T155444')->first();
        $user->password = Hash::make('T155444');
        $user->save();
        $this->actingAs($user, 'employee');
        $changepassword= $this->post('/pi-changepass', [
              'password' => '',
              'newpassword' =>'t123456',
              'comfirmpassword' =>'t123457',
          ]);
        $changepassword->assertSessionHasErrors([
            'password' => 'Mật khẩu cũ không được bỏ trống'
          ]);
    }
    public function test_Min_Length_NewPassword_Change_My_Password_Employee()
    {
        $user = Employee::where('username', 'T155444')->first();
        $user->password = Hash::make('T155444');
        $user->save();
        $this->actingAs($user, 'employee');
        $changepassword= $this->post('/pi-changepass', [
              'password' => 'T155444',
              'newpassword' =>'t12',
              'comfirmpassword' =>'t12',
          ]);
        $changepassword->assertSessionHasErrors([
            'newpassword' => 'Mật khẩu mới phải có độ dài từ 5-50 kí tự'
          ]);
    }
    public function test_Empty_Password_Change_My_Password()
    {
        $user = Employee::where('username', 'T155444')->first();
        $user->password = Hash::make('T155444');
        $user->save();
        $this->actingAs($user, 'employee');
        $changepassword= $this->post('/pi-changepass', [
             'password' => '',
             'newpassword' =>'t123456',
             'comfirmpassword' =>'t123457',
         ]);
        $changepassword->assertSessionHasErrors([
           'password' => 'Mật khẩu cũ không được bỏ trống'
         ]);
    }
    public function test_Empty_NewPassword_Change_My_Password()
    {
        $user = Employee::where('username', 'T155444')->first();
        $user->password = Hash::make('T155444');
        $user->save();
        $this->actingAs($user, 'employee');
        $changepassword= $this->post('/pi-changepass', [
             'password' => 'T155444',
             'newpassword' =>'',
             'comfirmpassword' =>'t123457',
         ]);
        $changepassword->assertSessionHasErrors([
           'newpassword' => 'Mật khẩu mới không được bỏ trống'
         ]);
    }
    public function test_Empty_ConfirmPassword_Change_My_Password()
    {
        $user = Employee::where('username', 'T155444')->first();
        $user->password = Hash::make('T155444');
        $user->save();
        $this->actingAs($user, 'employee');
        $changepassword= $this->post('/pi-changepass', [
             'password' => 'T155444',
             'newpassword' =>'T155444',
             'comfirmpassword' =>'',
         ]);
        $changepassword->assertSessionHasErrors([
           'comfirmpassword' => 'Xác nhận mật khẩu mới không được bỏ trống'
         ]);
    }
    public function test_Max_Length_NewPassword_Change_My_Password_Employee()
    {
        $user = Employee::where('username', 'T155444')->first();
        $user->password = Hash::make('T155444');
        $user->save();
        $this->actingAs($user, 'employee');
        $changepassword= $this->post('/pi-changepass', [
           'password' => 'T155444',
           'newpassword' =>'t1212313213213213211231311111111111111111121231321321321321123131111111111111111112123132132132132112313111111111111111111',
           'comfirmpassword' =>'t1212313213213213211231311111111111111111121231321321321321123131111111111111111112123132132132132112313111111111111111111',
       ]);
        $changepassword->assertSessionHasErrors([
         'newpassword' => 'Mật khẩu mới phải có độ dài từ 5-50 kí tự'
       ]);
    }
    public function test_Incorrect_ConfirmPassword_Change_My_Password_Employee()
    {
        $user = Employee::where('username', 'T155444')->first();
        $user->password = Hash::make('T155444');
        $user->save();
        $this->actingAs($user, 'employee');
        $changepassword= $this->post('/pi-changepass', [
              'password' => 'T155444',
              'newpassword' =>'T155444',
              'comfirmpassword' =>'t12123645465456',
          ]);
        $changepassword->assertSessionHasErrors([
            'comfirmpassword' => 'Xác nhận mật khẩu mới không trùng khớp với mật khẩu mới'
          ]);
    }


        public function test_successful_login_employee(){
          $user = Employee::where('username', 'T154725')->first();
          $user->password = Hash::make('T154725'); //make sure password to test is correct
          $user->save();
          $credential = [
            'username' => 'T154725',
            'password' => 'T154725'
          ];
          $response = $this->post('/login',$credential);
          $response->assertRedirect('/pi-detail'); // see pi detail when login successful

        }

        public function test_logout_admin(){
          $user = Employee::where('username', 'T154725')->first();
          $this->actingAs($user,'employee');//login before logout
          $response = $this->get('/logout');
          $this->assertFalse(Auth::guard('employee')->check());
          $response->assertRedirect('/login');
        }
}
