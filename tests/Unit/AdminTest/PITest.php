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
    // use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $admin = Admin::where('is_supervisor',0)->first();
        $this->actingAs($admin, 'admin');

    }
    public function test_add_PI_correct_data()
    {
        $actual = $this->data();
        $actual['identity_card'] = '569485214';
        $actual['email_address'] = 'caisodiosa@gmail.com';
        $actual['employee_code'] = 'P152436';
        $addPI = $this->post('/admin/pi-add', $actual);

        $pi = PI::where('employee_code', $actual['employee_code'])->first();//
        // dd($actual);
        $this->assertEquals($pi->employee_code, $actual['employee_code']);
        $this->assertEquals($pi->identity_card, $actual['identity_card']);
        $this->assertEquals($pi->email_address, $actual['email_address']);
    }


    public function test_add_PI_with_empty_employee_code()
    {
        $actual = $this->data();
        $actual['employee_code']= '';
        $addPI = $this->post('/admin/pi-add', $actual);
        // dd($addPI);
        $addPI->assertSessionHasErrors([
            'employee_code'=> 'Mã giảng viên không được bỏ trống',
          ]);

        // $pi = PI::where('employee_code',$actual['employee_code'])->first();
          // $this->assertEquals($pi->employee_code, $actual['employee_code']);
    }

    public function test_add_PI_with_duplicate_employee_code()
    {
        $actual = $this->data();
        $actual['employee_code']= 'T154725';
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
        $actual['identity_card']= '352390125';
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
        $actual1['email_address']= 'haimuoibon026@gmail.com';
        $actual1['employee_code']= 'T321999';
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

    public function test_update_PI_correct_data_new_address()
    {
        $data = $this->data();
        $data['employee_code'] = 'T155450';
        $data['email_address'] = 'haimuoibon026@gmail.com';
        $data['identity_card'] = '352363655';
        $pi = PI::where('employee_code', $data['employee_code'])->first();//


        $updatePI = $this->post('/admin/pi-update/'.$pi->id, $data);
        $pi = PI::where('employee_code', $data['employee_code'])->first();//
        $this->assertEquals($pi->identity_card, $data['identity_card']);
        $this->assertEquals($pi->email_address, $data['email_address']);
    }
    public function test_update_PI_correct_data_old_address()
    {
        $data = $this->data();
        $data['employee_code'] = 'T154725';
        $data['email_address'] = 'huynhnguyenmylinh@gmail.com';
        $data['identity_card'] = '352390125';

        $pi = PI::where('employee_code', $data['employee_code'])->first();//
        $pi->teacher->delete();
        $updatePI = $this->post('/admin/pi-update/'.$pi->id, $data);

        $pi = PI::where('employee_code', $data['employee_code'])->first();//
        $this->assertEquals($pi->employee_code, $data['employee_code']);
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
      $response->assertSee('T154725'); // see name of T154725 code when search successful

    }
    public function test_delete_a_PI(){


      $pi = PI::where('employee_code','T155444')->first();
      $response = $this->get('/admin/pi-delete/'.$pi->id);
      $response->assertSessionHas('message','Xóa thông tin nhân viên thành công');

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
      $pi = PI::where('employee_code','T123333')->first(); //role employee

      //role = 1 is admin
      $response = $this->post('/admin/pi-role/'.$pi->id,[
        'role' => 1,
        'role_admin' =>1
      ]);
      $pi = PI::where('employee_code','T123333')->first();//get pi after change roles
      $response->assertSessionHas('message','Thay đổi vai trò tài khoản thành công');
      $this->assertTrue($pi->admin !=''); //check in admin table on db as added record

    }
    public function test_change_role_from_employee_to_admin_2(){
        $pi = PI::where('employee_code','T123333')->first(); //role employee

        //role = 1 is admin
        $response = $this->post('/admin/pi-role/'.$pi->id,[
          'role' => 1,
          'role_admin' =>0
        ]);
        $pi = PI::where('employee_code','T123333')->first();//get pi after change roles
        $response->assertSessionHas('message','Thay đổi vai trò tài khoản thành công');
        $this->assertTrue($pi->admin !=''); //check in admin table on db as added record

      }

    public function test_change_role_from_admin_to_employee(){
      $pi = PI::where('employee_code','T155444')->first(); //role admin
      //role = 0 is employee

      $response = $this->post('/admin/pi-role/'.$pi->id,[
        'role' => 0,
        'role_employee'=> 0
      ]);
      $pi = PI::where('employee_code','T155444')->first();//get pi after change roles

      $response->assertSessionHas('message','Thay đổi vai trò tài khoản thành công');

      $this->assertTrue($pi->admin ==''); //check in admin table on db hasnt any record of this pi

    }
    public function test_change_role_from_admin_to_employee_2(){
        $pi = PI::where('employee_code','T155444')->first(); //role admin
        //role = 0 is employee

        $response = $this->post('/admin/pi-role/'.$pi->id,[
          'role' => 0,
          'role_employee'=> 1
        ]);
        $pi = PI::where('employee_code','T155444')->first();//get pi after change roles

        $response->assertSessionHas('message','Thay đổi vai trò tài khoản thành công');

        $this->assertTrue($pi->admin ==''); //check in admin table on db hasnt any record of this pi

      }

    public function data()
    {
        $actual = [
            "employee_code" => "T198754",
            "full_name" => "Lộc Nguyễn",
            "nation" => "4",
            "religion" => "2",
            "gender" => "0",
            "date_of_birth" => "1997-04-10",
            "place_of_birth" => "Bà rịa",
            "phone_number" => "332530666",
            "permanent_address" => "793 Trần Xuân Soạn",
            "province_1" => "79",
            "district_1" => "777",
            "ward_1" => "27448",
            "contact_address" => "793 Trần Xuân Soạn",
            "province_2" => "79",
            "district_2" => "775",
            "ward_2" => "27379",
            "email_address" => "haimu111bon2234@gmail.com",
            "home_town" => "Hồ Chí Minh",
            "contract_type" => "2",
            "position" => "Giám đốc",
            "date_of_recruitment" => "2010-08-10",
            "professional_title" => "Chưa biết",
            "unit" => "19",
            "identity_card" => "3523902124",
            "date_of_issue" => "2010-10-20",
            "place_of_issue" => "DH Văn Lang",
            "officer_type" => "2",
            "position_type" => "6",
            "is_concurrently" => "0",
            "teacher_type" => "1",
            "teacher_title" => "2",
            "is_excellent_teacher" => "1",
            "is_national_teacher" => "1",
            "is_activity" => "1",
            "is_retired" => "0"

      ];
        return $actual;
    }
    //


}
