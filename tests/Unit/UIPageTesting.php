<?php

namespace Tests\Unit;

use App\Competitive_Entrance_Exams;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
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


        $this->actingAs($user)
            ->visit('/profile')
            ->assertSee('');


    }

    /**
     * University profile
     */

    public function testUniversitySearch()
    {
        $this->get('/universitySearch')
            ->assertStatus(200);
    }

    public function testUniversityProfile()
    {
        $this->get('/universitySearch')
            ->assertStatus(200);
    }


    /**
     * user experience and feedback
     */

    public function testFeedback()
    {

        $user = factory(User::class)->create([
            'username' => 'tempValue'
        ]);

        $username = $user->username;
        $this->get('/$username/helpUs')
            ->assertStatus(200);
    }

    /**
     * important links
     */
    public function testImportantLinks()
    {
        $this->get('/links/dashboard')
            ->assertStatus(200);
    }

    /**
     * how to apply
     */

    public function testHowToApply()
    {
        $this->get('/links/dashboard/howToApply')
            ->assertStatus(200);
    }

    /**
     * auto suggestion Page
     */

    public function testAutoSuggestion()
    {

        $user = factory(User::class)->create([
            'username' => 'tempValue'
        ]);

        $username = $user->username;
        $this->get('/$username/autoSuggestion')
            ->assertStatus(200);
    }


    /**
     * testing for login controller working or not
     */

    public function testLogin()
    {


        $user = factory(User::class)->create([
            'username' => 'tempvalue',
            'password' => bcrypt('i-love-laravel'),
        ]);

        $response = $this->from('/Login/checkLogin')->post('/Login/checkLogin', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('/Login/checkLogin');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));

    }

    /**
     * testing unit test
     */

    public function testAdd()
    {
        $x = 5;
        $y = 6;

        $reg = new RegistrationController();

        $sum = $reg->add($x, $y);

        $this->assertEquals(11, $sum);

    }

    /**
     * academic point testing
     */
    public function testAcademicPoint()
    {

        $user = factory(User::class)->create([
            'username' => 'tempValue',
        ]);


        $student = new Student();
        $cExam = new Competitive_Entrance_Exams();
        $student->username = 'tempValue';
        $student->cgpa_bachelor = 3.93;
        $student->others = 'something';
        $student->ssc_o_level = 5.0;
        $student->hsc_a_level = 5.0;
        $cExam->username = 'tempValue';
        $cExam->ielts = 6.5;


        $student->save();
        $cExam->save();


        $student = Student::where('username', 'tempValue')->first();


        $reg = new RegistrationController();


        $student->academic_point = $reg->academicPointGenerator($student->username);


        $point = $reg->getAcademicPoint($student->username);

        $expectedResult = (3.93 * 100) + (150) + (5 * 40) + (5 * 40) + (6.5 * 20);


        $this->assertEquals($expectedResult, $point);
    }

    /**
     * session tester
     */
    public function testSession()
    {
        $user = factory(User::class)->create([
            'username' => 'tempValue'
        ]);

        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/Login/successLogin')
            ->assertSee($user->name);
    }

    /**
     * profile controllers
     */

    public function testShowProfile()
    {
        $user = factory(User::class)->create([
            'username' => 'tempValue'
        ]);

        $student = new Student();
        $cExam = new Competitive_Entrance_Exams();
        $student->username = 'tempValue';
        $student->cgpa_bachelor = 3.93;
        $student->others = 'something';
        $student->ssc_o_level = 5.0;
        $student->hsc_a_level = 5.0;
        $cExam->username = 'tempValue';
        $cExam->ielts = 6.5;

        $student->save();
        $cExam->save();

        $profile = new LoginController();



        $this->actingAs($user)
            ->withSession(['foo' => 'bar']);

        $link = $profile->profile();

        $this->visit('pages.profile')
            ->assertSee('');
    }

    /**
     * ai testing
     */

    public function testAI(){

        /**
         * need to give a actual value
         * or do it without Database Transaction
         */

        $user = factory(User::class)->create([
            'username' => 'tempValue',
        ]);

        $student = new Student();
        $cExam = new Competitive_Entrance_Exams();
        $student->username = 'tempValue';
        $student->cgpa_bachelor = 3.93;
        $student->others = 'something';
        $student->ssc_o_level = 5.0;
        $student->hsc_a_level = 5.0;
        $cExam->username = 'tempValue';
        $cExam->ielts = 6.5;
        $student->save();
        $cExam->save();
        $student = Student::where('username', 'tempValue')->first();

        $reg = new RegistrationController();

        $student->academic_point = $reg->academicPointGenerator($student->username);


        $suggestion = new suggestionController();

        $content = $suggestion->directAiResult($user->username);

        $actual = $content[41].$content[42].$content[43];



        $this->assertEquals('MIT',$actual);


    }

    /**
     * registration controller
     */

    public function testRegistrationController()
    {
        /**
         * Unable to locate factory with name [default] [App\Student].
         */

        $reg = new RegistrationController();

        $user = factory(User::class)->create([
            'username' => 'tempvalue',
        ]);

        $student = factory(Student::class)->create([
            'username' => 'tempValue',
        ]);

        $reg->register();
    }





    /**
     * pre defined  method
     */
    public function visit($uri)
    {
        return $this->get($uri);
    }

    protected function click($name)
    {
        $link = $this->crawler()->selectLink($name);

        if (!count($link)) {
            $link = $this->filterByNameOrId($name, 'a');

            if (!count($link)) {
                throw new InvalidArgumentException(
                    "Could not find a link with a body, name, or ID attribute of [{$name}]."
                );
            }
        }

        $this->visit($link->link()->getUri());

        return $this;
    }

}
