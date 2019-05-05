<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use App\PI;
use App\Admin;
use App\Employee;
use App\ConfirmationRequest;

class ConfirmtaionEmoloyeeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */
     public function test_Add_Confirmation_Request(){
       $employee = Employee::where('username', 'T154725')->first();
       $this->actingAs($employee, 'employee');
       $data = $this->data();
       $add_cr = $this->post('/confirmation-request/create', $data);
       $add_cr->assertSessionHas('message', 'Gửi đơn thành công');
     }

     public function test_Update_Confirmation_Request(){
       $employee = Employee::where('username', 'T154725')->first();
       $this->actingAs($employee, 'employee');
       $cr = $this->data();
       $cr['confirmation']= 'Vay vốn ngân hàng';
       $add_cr = $this->post('/confirmation-request/update/'.$employee->pi->confirmation_requests->first()->id, $cr);
       $add_cr->assertSessionHas('message', 'Cập nhật đơn thành công');
     }

     public function test_Delete_Confirmation_Request(){
        $employee = Employee::where('username', 'T154725')->first();
        $this->actingAs($employee, 'employee');
        $cr = $employee->pi->confirmation_requests->first();
        $cr->status=0;
        $cr->save();

        $delete = $this->get('/confirmation-request/delete/'.$cr->id);
        $delete->assertSessionHas('message', 'Xóa đơn thành công');
      }

     public function data()
     {
         $actual = [
          'confirmation' =>'Xin bổ túc hồ sơ',
          'address' =>27,
          'is_confirm_income' => 1,
          'number_of_month_income' => 12
        ];
         return $actual;
     }

}
