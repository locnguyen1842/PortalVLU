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
      use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
     // public function setUp()
     //  {
     //      parent::setUp();
     //      Notification::fake();
     //  }

     public function est_send_correct_file_import_template()
     {

        //file to test
         $filePath = public_path('template-personalinformation.xlsx');

         $uploadedFile = new UploadedFile(
              $filePath,
              'template-personalinformation.xlsx',
              'application/vnd.ms-excel',
              600,
              0,
              true

          );

         $response = $this->post('/admin/pi-import',[
           'import_file' => $uploadedFile
         ]);

         $response->assertSessionHas('message','Import thành công');
     }



}
