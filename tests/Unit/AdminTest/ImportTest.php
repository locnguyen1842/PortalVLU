<?php

namespace Tests\Unit;
use App\Admin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Hash;

use Password;
class ImportTest extends TestCase
{

      use DatabaseTransactions;
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
        $origional_file_path_pi = public_path('template-personalinformation.xlsx');
        $origional_file_path_workload = public_path('template-workload.xlsx');
        copy($origional_file_path_pi,public_path('test_data_pi.xlsx'));
        copy($origional_file_path_workload,public_path('test_data_workload.xlsx'));

    }

    public function test_download_statistical(){
        $response= $this->get('admin/statistical-download');
        $response->assertHeader('content-disposition', 'attachment; filename=thongke.xlsx');
        $this->assertEquals($response->getStatusCode(), 200);
    }
    // public function test_send_correct_file_import_template_pi()
    // {

    // //file to test
    //     $test_file_path = public_path('test_data_pi.xlsx');
    //     $uploadedFile = new UploadedFile(
    //         $test_file_path,
    //         'template-personalinformation.xlsx',
    //         'application/vnd.ms-excel',
    //         null,
    //         null,
    //         true

    //     );
    //     // return response()->download($uploadedFile);
    //     $response = $this->post('/admin/pi-import',[
    //     'import_file' => $uploadedFile
    //     ]);


    //     $response->assertSessionHas('message','Import thành công');
    // }

    public function test_get_data_preview_success_after_import_pi(){

        //file to test
        $test_file_path = public_path('test_data_pi.xlsx');

        $uploadedFile =new UploadedFile(
                $test_file_path,
                'template-personalinformation.xlsx',
                'application/vnd.ms-excel',
                null,
                null,
                true

            );
        $response = $this->post('/admin/pi-get-data-import',[
            'import_file' => $uploadedFile
        ]);
        $response->assertSuccessful();
    }
    public function test_send_correct_file_import_template_workload()
    {

    //file to test
        $test_file_path = public_path('test_data_workload.xlsx');
        $uploadedFile = new UploadedFile(
            $test_file_path,
            'Workload.xlsx',
            'application/vnd.ms-excel',
            null,
            null,
            true

        );

        $response = $this->post('/admin/workload-import',[
            'import_file' => $uploadedFile,
            'session_year'=> '2016-2017',
        ]);
        $response->assertSessionHas('message','Import thành công');
    }

    public function test_get_data_preview_success_after_import_workload(){

    //file to test
        $test_file_path = public_path('test_data_workload.xlsx');

        $uploadedFile =new UploadedFile(
            $test_file_path,
            'Workload.xlsx',
            'application/vnd.ms-excel',
            null,
            null,
            true

        );
        $response = $this->post('/admin/workload-get-data-import',[
            'import_file' => $uploadedFile
        ]);
        $response->assertSuccessful();
    }



}
