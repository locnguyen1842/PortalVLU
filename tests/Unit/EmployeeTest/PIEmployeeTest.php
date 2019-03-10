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
use App\Employee;

class PIEmployeeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseTransactions;

    public function test_update_PI_correct_data()
    {
        $this->login_employee();
        $data = $this->data();
        $data['full_name']= 'Le Le Le';
        $updatePI = $this->post('/pi-update', $data);
        $pi = PI::where('employee_code', Auth::guard('employee')->user()->username)->first();
        $this->assertEquals($pi->full_name, $data['full_name']);
        $this->assertEquals($pi->identity_card, $data['identity_card']);
        $this->assertEquals($pi->email_address, $data['email_address']);
    }

    public function test_update_PI_with_incorrect_format_email()
    {
        $this->login_employee();
        $data = $this->data();
        $data['email_address']= 'lethanhson2910';
        $updatePI = $this->post('/pi-update', $data);
        $pi = PI::where('employee_code', Auth::guard('employee')->user()->username)->first();
        $updatePI->assertSessionHasErrors([
             'email_address'=> 'Email sai định dạng'
         ]);
    }
    public function test_update_PI_with_duplicate_email()
    {
        $this->login_employee();
        $data = $this->data();
        $data['email_address']= 'taolao024@gmail.com';
        $updatePI = $this->post('/pi-update', $data);

        $pi = PI::where('employee_code', Auth::guard('employee')->user()->username)->first();
        $updatePI->assertSessionHasErrors([
             'email_address'=> 'Email đã được sử dụng'
         ]);
    }

    public function test_update_PI_with_incorrect_format_date()
    {
        $this->login_employee();
        $data = $this->data();
        $data['date_of_birth']= 'lethanhson2910';
        $updatePI = $this->post('/pi-update', $data);
        $pi = PI::where('employee_code', Auth::guard('employee')->user()->username)->first();
        $updatePI->assertSessionHasErrors([
             'date_of_birth'=> 'Ngày sinh sai định dạng'
         ]);
    }
    public function data()
    {
        $actual = [
         'full_name' =>'Le Thanh Son',
         'nation' =>1,
         'gender'=> 1,
         'date_of_birth' =>'1997-04-10',
         'place_of_birth' =>'TPHCM',
         'permanent_address' =>'An Giang',
         'contact_address' =>'An Giang',
         'phone_number' =>'0123456789',
         'email_address' =>'lethanhson2910@gmail.com',
         'identity_card' =>'321368999',
         'date_of_issue' =>'2015-04-10',
         'place_of_issue' =>'TPHCM',
       ];
        return $actual;
    }
    public function login_employee()
    {
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');
    }
}
