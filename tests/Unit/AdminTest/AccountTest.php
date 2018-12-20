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
     $user = Admin::where('username','T154725')->first();
     $user->password = Hash::make('T154725');
     $user->save();
     $this->actingAs($user,'admin');
     $changepassword= $this->post('/admin/pi-changepass', [
           'password' => 'T154725',
           'newpassword' =>'t123456',
           'comfirmpassword' =>'t123456',
       ]);
       $user = Admin::where('username','T154725')->first();
       $this->assertTrue(Hash::check('t123456', $user->password));//
     }
     // public function test_Change_Password_Employee()
     // {
     //
     // }
}
