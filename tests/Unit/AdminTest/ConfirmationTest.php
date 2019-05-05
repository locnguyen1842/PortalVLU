<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Admin;
use App\Employee;
use App\PI;
use App\ConfirmationRequest;

class ConfirmtaionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
     use DatabaseTransactions;

     public function test_Update_Confirmation_Request(){
       $admin = Admin::where('is_supervisor',0)->first();
       $this->actingAs($admin, 'admin');
       $data = $this->data();
       $cr = ConfirmationRequest::first()->id;
       $update_confirmation_request = $this->post('/admin/confirmation-request/update/'.$cr, $data);
       $update_confirmation_request->assertSessionHas('message', 'Cập nhật đơn thành công');
     }
     public function test_Update_Confirmation_Request_with_incomes(){
        $admin = Admin::where('is_supervisor',0)->first();
        $this->actingAs($admin, 'admin');
        $data = $this->data();
        $cr = ConfirmationRequest::first();

        $cr->is_confirm_income = 1;
        $cr->number_of_month_income = 1;
        $cr->save();
        $data['month_of_income'] = [1];
        $data['year_of_income'] = [2016];
        $data['amount_of_income'] = [3000000];

        $update_confirmation_request = $this->post('/admin/confirmation-request/update/'.$cr->id, $data);
        // dd($update_confirmation_request);
        $update_confirmation_request->assertSessionHas('message', 'Cập nhật đơn thành công');
      }
     public function test_Print_Confirmation_Request(){
        $admin = Admin::where('is_supervisor',0)->first();
        $this->actingAs($admin, 'admin');
        $data = $this->data();
        $cr = ConfirmationRequest::first()->id;
        $response = $this->get('/admin/confirmation-request/print/'.$cr);
        $response->assertSeeText('Data has already been sent to output');
      }

     public function test_Search_Confirmation_Request()
     {
         $admin = Admin::where('is_supervisor',0)->first();
         $this->actingAs($admin, 'admin');
         $response = $this->get('/admin/confirmation-request/index?search=T154725');
         $response->assertSuccessful();
         $response->assertSee('T154725');
         $response->assertSee('Lê Thanh Sơn 10');
     }

     public function data()
     {
         $actual = [
          'employee_code' => 'T154725',
          'confirmation' =>'ABC',
          'address_id' =>27,
          'date_of_request'=> '2019-5-4',
          'status' =>0,
          'is_confirm_income' => 0,
          'name_of_signer' => 'Le Son',
          'first_signer' => 'Le Son',
          'second_signer' => 'Le Son',

        ];
         return $actual;
     }
}
