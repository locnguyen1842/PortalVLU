<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use App\PI;
use App\Admin;
use Hash;

class AccountTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Change_My_Password()
    {
        $user = Admin::where('username', 'T154725')->first();
        $user->password = Hash::make('T154725');
        $user->save();
        $this->actingAs($user, 'admin');
        $changepassword= $this->post('/admin/pi-changepass', [
           'password' => 'T154725',
           'newpassword' =>'t123456',
           'comfirmpassword' =>'t123456',
       ]);
        $user = Admin::where('username', 'T154725')->first();
        $this->assertTrue(Hash::check('t123456', $user->password));//
    }
    public function test_Incorrect_Change_My_Password()
    {
        $user = Admin::where('username', 'T154725')->first();
        $user->password = Hash::make('T154725');
        $user->save();
        $this->actingAs($user, 'admin');
        $changepassword= $this->post('/admin/pi-changepass', [
           'password' => 'T1547123',
           'newpassword' =>'t123456',
           'comfirmpassword' =>'t123456',
       ]);
        $user = Admin::where('username', 'T154725')->first();
        $this->assertFalse(Hash::check('t123456', $user->password));//
    }
    public function test_Empty_Password_Change_My_Password()
    {
        $user = Admin::where('username', 'T154725')->first();
        $user->password = Hash::make('T154725');
        $user->save();
        $this->actingAs($user, 'admin');
        $changepassword= $this->post('/admin/pi-changepass', [
             'password' => '',
             'newpassword' =>'t123456',
             'comfirmpassword' =>'t123457',
         ]);
        $changepassword->assertSessionHasErrors([
           'password' => 'Chưa xác nhận mật khẩu cũ'
         ]);
    }
    public function test_Empty_NewPassword_Change_My_Password()
    {
        $user = Admin::where('username', 'T154725')->first();
        $user->password = Hash::make('T154725');
        $user->save();
        $this->actingAs($user, 'admin');
        $changepassword= $this->post('/admin/pi-changepass', [
             'password' => 'T154725',
             'newpassword' =>'',
             'comfirmpassword' =>'t123457',
         ]);
        $changepassword->assertSessionHasErrors([
           'newpassword' => 'Mật khẩu mới không được bỏ trống'
         ]);
    }
    public function test_Empty_ConfirmPassword_Change_My_Password()
    {
        $user = Admin::where('username', 'T154725')->first();
        $user->password = Hash::make('T154725');
        $user->save();
        $this->actingAs($user, 'admin');
        $changepassword= $this->post('/admin/pi-changepass', [
             'password' => 'T154725',
             'newpassword' =>'T154725',
             'comfirmpassword' =>'',
         ]);
        $changepassword->assertSessionHasErrors([
           'comfirmpassword' => 'Xác nhận mật khẩu mới không được bỏ trống'
         ]);
    }
    public function test_Min_Length_NewPassword_Change_My_Password()
    {
        $user = Admin::where('username', 'T154725')->first();
        $user->password = Hash::make('T154725');
        $user->save();
        $this->actingAs($user, 'admin');
        $changepassword= $this->post('/admin/pi-changepass', [
             'password' => 'T154725',
             'newpassword' =>'t12',
             'comfirmpassword' =>'t12',
         ]);
        $changepassword->assertSessionHasErrors([
           'newpassword' => 'Mật khẩu mới phải có độ dài từ 5-50 kí tự'
         ]);
    }
    public function test_Max_Length_NewPassword_Change_My_Password()
    {
        $user = Admin::where('username', 'T154725')->first();
        $user->password = Hash::make('T154725');
        $user->save();
        $this->actingAs($user, 'admin');
        $changepassword= $this->post('/admin/pi-changepass', [
           'password' => 'T154725',
           'newpassword' =>'t1212313213213213211231311111111111111111121231321321321321123131111111111111111112123132132132132112313111111111111111111',
           'comfirmpassword' =>'t1212313213213213211231311111111111111111121231321321321321123131111111111111111112123132132132132112313111111111111111111',
       ]);
        $changepassword->assertSessionHasErrors([
         'newpassword' => 'Mật khẩu mới phải có độ dài từ 5-50 kí tự'
       ]);
    }
    public function test_Incorrect_ConfirmPassword_Change_My_Password()
    {
        $user = Admin::where('username', 'T154725')->first();
        $user->password = Hash::make('T154725');
        $user->save();
        $this->actingAs($user, 'admin');
        $changepassword= $this->post('/admin/pi-changepass', [
             'password' => 'T154725',
             'newpassword' =>'T154725',
             'comfirmpassword' =>'t12123645465456',
         ]);
        $changepassword->assertSessionHasErrors([
           'comfirmpassword' => 'Xác nhận mật khẩu mới không chính xác'
         ]);
    }
}
