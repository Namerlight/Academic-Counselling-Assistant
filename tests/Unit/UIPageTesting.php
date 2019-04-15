<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UIPageTesting extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIndexPage()
    {
        $response = $this->get('/index');

        $response->assertStatus(200);
    }

    public function testRegisterPage()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function testMainPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
