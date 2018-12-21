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
            'password' => 'Chưa xác nhận mật khẩu cũ'
          ]);
     }
     public function test_Length_NewPassword_Change_My_Password_Employee()
     {
       $user = Employee::where('username', 'T155444')->first();
       $user->password = Hash::make('T155444');
       $user->save();
       $this->actingAs($user, 'employee');
         $changepassword= $this->post('/pi-changepass', [
              'password' => 'T154725',
              'newpassword' =>'t12',
              'comfirmpassword' =>'t12',
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
            'comfirmpassword' => 'Xác nhận mật khẩu mới không chính xác'
          ]);
     }
}
