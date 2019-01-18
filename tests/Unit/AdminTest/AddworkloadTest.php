<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 1/18/2019
 * Time: 16:34
 */

namespace Tests\Unit\AdminTest;
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


class AddworkloadTest extends TestCase
{
    public function data()
    {
        $actual = [
            'employee_code' => 'T154725',
            'unit.*'=>1,
            'session_new' =>0,
            'session_id' =>1,
            'subject_code.*' =>'AV07',
            'subject_name.*' =>'Anh Văn 7',
            'number_of_lessons.*'=> 45,
            'class_code.*' =>'K21T02',
            'number_of_students.*' =>45,
            'total_workload.*' =>50,
            'theoretical_hours.*' =>45,
            'practice_hours.*' =>5,
            'semester.*' =>1,
            'note.*' =>'',

        ];
        return $actual;
    }
    public function test_add_workload_correct_data()
    {
        $actual = $this->data();
        $pp = strtoupper($actual['employee_code']);
        $pi = PI::where('employee_code', $pp)->first();
//        $pi = PI::where('employee_code', $actual['employee_code'])->first();//
        $response = $this->post('/admin/workload-add', $actual);
        $response->assertSessionHas('message','Thêm thành công');
    }
}
