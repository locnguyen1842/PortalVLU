<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Auth;
use Illuminate\Support\Facades\Session;
use App\PI;

class Viewtest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function create_user_for_login()
    {

    }

    public function test_view_list_PI()
    {
        $response = $this->get('/admin/pi-add');

        dd($response);
    }
}
