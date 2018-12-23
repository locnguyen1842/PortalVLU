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
use App\DegreeDetail;
use App\Admin;
use Hash;
class PITest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_add_PI_correct_data()
    {
        $actual = $this->data();
        $addPI = $this->post('/admin/pi-add', $actual);
        $pi = PI::where('employee_code', $actual['employee_code'])->first();//
        $this->assertEquals($pi->employee_code, $actual['employee_code']);
        $this->assertEquals($pi->identity_card, $actual['identity_card']);
        $this->assertEquals($pi->email_address, $actual['email_address']);
    }
    public function test_add_PI_with_admin_role()
    {
        $actual = $this->data();
        $actual['role'] = 1;
        $addPI = $this->post('/admin/pi-add', $actual);
        $pi = PI::where('employee_code', $actual['employee_code'])->first();//
        $this->assertEquals($pi->employee_code, $actual['employee_code']);
        $this->assertEquals($pi->identity_card, $actual['identity_card']);
        $this->assertEquals($pi->email_address, $actual['email_address']);
        $this->assertTrue($pi->admin != '');
    }
    public function test_add_PI_with_empty_employee_code()
    {
        $actual = $this->data();
        $actual['employee_code']= '';
        $addPI = $this->post('/admin/pi-add', $actual);

        $addPI->assertSessionHasErrors([
            'employee_code'=> 'Mã giảng viên không được bỏ trống',
          ]);
        // $pi = PI::where('employee_code',$actual['employee_code'])->first();
          // $this->assertEquals($pi->employee_code, $actual['employee_code']);
    }

    public function test_add_PI_with_duplicate_employee_code()
    {
        $actual = $this->data();
        $actual['employee_code']= 'T153772';
        $addPI = $this->post('/admin/pi-add', $actual);
        $duplicate_pi = $this->post('/admin/pi-add', $actual);
        $duplicate_pi->assertSessionHasErrors([
             'employee_code'=> 'Mã giảng viên đã tồn tại'
           ]);
    }
    public function test_add_PI_with_incorrect_format_email()
    {
        $actual = $this->data();
        $actual['email_address']= 'lethanhson2910@';
        $format_email = $this->post('/admin/pi-add', $actual);
        $format_email->assertSessionHasErrors([
            'email_address'=> 'Email sai định dạng'
          ]);
    }
    public function test_add_PI_with_incorrect_format_date()
    {
        $actual = $this->data();
        $actual['date_of_birth']= '123';
        $format_date = $this->post('/admin/pi-add', $actual);
        $format_date->assertSessionHasErrors([
            'date_of_birth'=> 'Ngày sinh sai định dạng'
          ]);
    }
    public function test_add_PI_with_incorrect_identity_card()
    {
        $actual = $this->data();
        $actual['identity_card']= '321368999';
        $addPI = $this->post('/admin/pi-add', $actual);
        $duplicate_indentitycard = $this->post('/admin/pi-add', $actual);
        $duplicate_indentitycard->assertSessionHasErrors([
          'identity_card'=> 'Chứng minh nhân dân đã được sử dụng'
        ]);
    }
    public function test_add_PI_with_duplicate_email_address()
    {
        $actual = $this->data();
        $addPI = $this->post('/admin/pi-add', $actual);
        $actual1 = $this->data();
        $actual1['email_address']= 'lethanhson2910@gmail.com';
        $actual1['employee_code']= 'T155477';
        $duplicate_emailaddress = $this->post('/admin/pi-add', $actual1);
        $duplicate_emailaddress->assertSessionHasErrors([
          'email_address'=> 'Email đã được sử dụng'
        ]);
    }

    //test update
    public function test_update_PI_correct_data()
    {
        $data = $this->data();
        $addPI = $this->post('/admin/pi-add', $data);

        $pi = PI::where('employee_code', $data['employee_code'])->first();//

        $updatePI = $this->post('/admin/pi-update/'.$pi->id, $data);
        $this->assertEquals($pi->employee_code, $data['employee_code']);
        $this->assertEquals($pi->identity_card, $data['identity_card']);
        $this->assertEquals($pi->email_address, $data['email_address']);
    }

    public function test_update_PI_with_incorrect_format_email()
    {
        $actual = $this->data();
        $format_email = $this->post('/admin/pi-add', $actual);
        $email_update_form = [

            'email_address' =>'lethanhson2910',


        ];
        $pi = PI::where('employee_code', $actual['employee_code'])->first();
        $format_email1 = $this->post('/admin/pi-update/'.$pi->id, $email_update_form);
        $format_email1->assertSessionHasErrors([
            'email_address'=> 'Email sai định dạng'
        ]);
    }
    public function test_update_PI_with_incorrect_format_date()
    {
        $actual = $this->data();
        $format_email = $this->post('/admin/pi-add', $actual);

        $date_update_form = [

            'date_of_birth' =>123,


        ];
        $pi = PI::where('employee_code', $actual['employee_code'])->first();
        $format_date = $this->post('/admin/pi-update/'.$pi->id, $date_update_form);
        $format_date->assertSessionHasErrors([
            'date_of_birth'=> 'Ngày sinh sai định dạng'
        ]);

    }

    public function test_search_PI(){
      $admin = Admin::first();
      $this->actingAs($admin,'admin');
      $response = $this->get('/admin/pi-list?search=T154725');
      $response->assertSuccessful();
      $response->assertSee('Loc Nguyen'); // see name of T154725 code when search successful

    }
    public function test_delete_a_PI(){

      $admin = Admin::first();
      $this->actingAs($admin,'admin');
      $pi = PI::where('employee_code','T155444')->first();
      $response = $this->get('/admin/pi-delete/'.$pi->id);
      $list = $this->get('/admin/pi-list');
      $response->assertSessionHas('message','Xóa thông tin nhân viên thành công');
      $list->assertDontSee('T155444');
    }

    public function test_pi_recovery_password_for_only_employee_role(){
      $pi = PI::where('employee_code','T155444')->first(); //role employee only
      $pi->employee->password = Hash::make('T123456'); //set new password before recovery password
      $pi->save();
      $response = $this->get('/admin/pi-recovery/'.$pi->id);
      $pi =PI::where('employee_code','T155444')->first();//get pi after recovery Password
      $this->assertTrue(Hash::check('T155444',$pi->employee->password));  //check if password recoveried match with in db?
      $response->assertSessionHas('message','Khôi phục mật khẩu thành công');


    }

    public function test_pi_recovery_password_for_admin_role(){
      $pi = PI::where('employee_code','T154725')->first(); //role admin
      $pi->employee->password = Hash::make('T123456'); //set new password before recovery password
      $pi->admin->password = Hash::make('T123456');
      $pi->save();
      $response = $this->get('/admin/pi-recovery/'.$pi->id);
      $pi =PI::where('employee_code','T154725')->first();//get pi after recovery Password
      $this->assertTrue(Hash::check('T154725',$pi->employee->password));  //check if password recoveried match with in db?
      $this->assertTrue(Hash::check('T154725',$pi->admin->password));  //check if password recoveried match with in db?
      $response->assertSessionHas('message','Khôi phục mật khẩu thành công');
    }

    public function test_change_role_from_employee_to_admin(){
      $pi = PI::where('employee_code','T155444')->first(); //role employee
      //role = 1 is admin
      $response = $this->post('/admin/pi-role/'.$pi->id,[
        'role' => 1
      ]);
      $pi = PI::where('employee_code','T155444')->first();//get pi after change roles
      $response->assertSessionHas('message','Thay đổi vai trò tài khoản thành công');
      $this->assertTrue($pi->admin !=''); //check in admin table on db as added record

    }

    public function test_change_role_from_admin_to_employee(){
      $pi = PI::where('employee_code','T155555')->first(); //role admin
      //role = 0 is employee
      $response = $this->post('/admin/pi-role/'.$pi->id,[
        'role' => 0
      ]);
      $pi = PI::where('employee_code','T155555')->first();//get pi after change roles
      $response->assertSessionHas('message','Thay đổi vai trò tài khoản thành công');
      $this->assertTrue($pi->admin ==''); //check in admin table on db hasnt any record of this pi

    }

    public function data()
    {
        $actual = [
        'employee_code' => 'T153772',
        'full_name' =>'Le Thanh Son',
        'nation' =>1,
        'gender'=> 1,
        'date_of_birth' =>'1997-04-10',
        'place_of_birth' =>'TPHCM',
        'permanent_address' =>'An Giang',
        'contact_address' =>'An Giang',
        'phone_number' =>'0123456789',
        'email_address' =>'lethanhson2910@gmail.com',
        'position' =>'Quan ly',
        'date_of_recruitment' =>'2018-04-10',
        'professional_title' =>'Lao cong',
        'identity_card' =>'321368999',
        'date_of_issue' =>'2015-04-10',
        'place_of_issue' =>'TPHCM',
        'unit'=>1,
        'role'=>0,
      ];
        return $actual;
    }
    //


}
