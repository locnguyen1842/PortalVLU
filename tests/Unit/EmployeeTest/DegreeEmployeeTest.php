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
use App\Employee;
class DegreeEmployeeTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Degree_Create_Admin()
    {
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');

        $degree = [
            'date_of_issue' => '1999-02-02',
            'place_of_issue' =>'Mot noi rat xa',
            'degree' =>1,
            'specialized'=> 1,

        ];
        //
        $pi_id = 1;
        $addde = $this->post('/pi-degree-create',$degree);

        $addde->assertSessionHas('message','Thêm thành công');

    }
    public function test_Degree_Update_Admin()
    {
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');

        $degree = [
            'date_of_issue' => '1999-02-03',
            'place_of_issue' =>'Mot noi rat xa xoi',
            'degree' =>1,
            'specialized'=> 1,

        ];
        //

        $addde = $this->post('/pi-updatedetaildegree/'.$employee->pi->degreedetails->first()->id,$degree);
        $addde->assertSessionHas('message','Cập nhật thành công');

    }

    public function test_delete_degreedetail(){
        $employee = Employee::where('username', 'T155444')->first();
        $this->actingAs($employee, 'employee');
        $pi = PI::find(1);

        $response = $this->get('/pi-degree-delete/'.$pi->degreedetails->first()->id);
        $response->assertSessionHas('message','Xóa thành công');
    }

}
