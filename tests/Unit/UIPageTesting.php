<?php

namespace Tests\Unit;

use App\Http\Controllers\suggestionController;
use App\Student;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UIPageTesting extends TestCase
{
    use DatabaseTransactions;

    /**
     * Testing page to test the basic pages
     * on the user perspective
     */

    /**
     * Index page
     */
    public function testIndexPage()
    {
        $response = $this->get('/index');

        $response->assertStatus(200);
    }

    /**
     * Registration page
     */
    public function testRegisterPage()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * Main page
     */
    public function testMainPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Dashboard after login
     */
    public function testHomepage()
    {
        $user = factory(User::class)->create([
            'username' => 'tempValue'
        ]);


        $this->actingAs($user)
            ->get('/Login/successLogin')
            ->assertStatus(200);


    }

    /**
     * profile view page testing
     */
    public function testProfile()
    {


        $user = factory(User::class)->create([
            'username' => 'tempValue'
        ]);

        $student = factory(Student::class)->create([
            'username' => 'tempValue'
        ]);

        $this->actingAs($user, $student)
            ->get('/profile')
            ->assertStatus(200);


    }

    /**
     * controller
     */

    public function testSuggestionController()
    {

    }

}
