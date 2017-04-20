<?php
/**
 * Created by PhpStorm.
 * User: ан
 * Date: 14.04.2017
 * Time: 14:37
 */

namespace Tests\Unit;


use App\User;
use App\Contact;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends BrowserKitTestCase
{

    use DatabaseTransactions;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make([
            'name' => 'TestName',
            'email' => 'test@email.com',
            'password' => bcrypt('password'),
        ]);

    }

    public function getUser() {
        return $this->user;
    }

    /**
     * Users table in DB check
     * @test  */
    function user_can_added_to_DB_and_name_check() {
       $user = factory(User::class)->create();

        $this->assertEquals( !0, User::all()->count() );
        $this->seeInDatabase('users', ['name' => $user->name]);
    }

    /**
     * User Has a Contacts
     * @test  */
    public function registered_user_has_a_contact()
    {
        $user = factory(User::class)->create();
        factory(Contact::class)->create(['user_id' => $user->id]);

        $userContacts = $user->contacts()->get();

        $this->assertEquals( !0, $userContacts->count() );
        $this->seeInDatabase('contacts', ['user_id' => $user->id]);
    }

//    ==============REGISTRATION TESTS==================

    /**
     * Guest registered
     * @test  */
    public function guest_completed_registration_form_Successfully_registered_and_checked_in_DB()
    {
        $this->visit('/register')
            ->seePageIs('/register')
            ->type($this->user->name, 'name')
            ->type($this->user->email, 'email')
            ->type($this->user->password, 'password')
            ->type($this->user->password, 'password_confirmation')
            ->press('Register');


        $this->seeInDatabase('users', ['name' => $this->user->name]);
    }

    /**
     * Guest write_allready_exist_email in registration form
     * @test  */
    public function user_cannot_registered_if_write_allready_exist_email()
    {
        factory(User::class)->create(['email' => 'test@email.com']);

        $this->visit('/register')
            ->seePageIs('/register')
            ->type($this->user->name, 'name')
            ->type('test@email.com', 'email')
            ->type($this->user->password, 'password')
            ->type($this->user->password, 'password_confirmation')
            ->press('Register')
            ->see('The email has already been taken.')
            ->seePageIs('/register');

        $this->call('post', '/register');
        $this->assertResponseStatus(302);

        $this->dontSeeInDatabase('users', ['name' => $this->user->name]);
    }

    /**
     * Guest write_allready_exist_email in registration form
     * @test  */
    public function user_cannot_registered_if_write_wrong_name()
    {
        $this->visit('/register')
            ->seePageIs('/register')
            ->type('', 'name')
            ->type($this->user->email, 'email')
            ->type($this->user->password, 'password')
            ->type($this->user->password, 'password_confirmation')
            ->press('Register')
            ->see('The name field is required.')
            ->seePageIs('/register');

        $this->call('post', '/register');
        $this->assertResponseStatus(302);

        $this->dontSeeInDatabase('users', ['name' => $this->user->name]);
    }

//    ==============LOGIN TESTS==================
    /**
     * User Login Test
     * @test  */
    public function user_write_wrong_email_cannot_login()
    {
        $user = factory(User::class)->create(['email' => 'test@email.com']);

        $this->visit('/login')
            ->seePageIs('/login')
            ->type('wrongemail@test.com', 'email')
            ->type($user->password, 'password')
            ->press('Login')
            ->see('These credentials do not match our records.')
            ->seePageIs('/login');

        $this->call('post', '/login');
        $this->assertResponseStatus(302);

        $this->assertFalse( Auth::check() );
    }

    /**
     * User Login Test
     * @test  */
    public function user_completed_wrong_password_cannot_login()
    {
        $user = factory(User::class)->create([ 'password' => bcrypt('password') ]);

        $this->call('get', '/login');
        $this->assertResponseStatus(200);

        $this->visit('/login')
            ->seePageIs('/login')
            ->type($user->email, 'email')
            ->type('wrongpassword', 'password')
            ->press('Login')
            ->see('These credentials do not match our records.')
            ->seePageIs('/login');

        $this->call('post', '/login');
        $this->assertResponseStatus(302);

        $this->assertFalse( Auth::check() );

    }

    /**
     * User Login Test
     * @test  */
    public function not_registered_user_cannot_login()
    {
        $this->dontSeeInDatabase('users', ['email' => 'wrongemail@test.com']);

        $this->visit('/login')
            ->seePageIs('/login')
            ->type('wrongemail@test.com', 'email')
            ->type('somepassword', 'password')
            ->press('Login')
            ->see('These credentials do not match our records.')
            ->seePageIs('/login');

        $this->call('post', '/login');
        $this->assertResponseStatus(302);

        $this->assertFalse( Auth::check() );
    }

    /**
     * User Login Test
     * @test  */
    public function registered_user_login_OK_and_redirect_to_dashboard()
    {
        $user = factory(User::class)->create([
            'name' => 'TestName',
            'password' => bcrypt('testpass123')
        ]);

        $this->seeInDatabase('users', ['name' => 'TestName']);


        $this->visit('/login')
            ->seePageIs('/login')
            ->type($user->email, 'email')
            ->type('testpass123', 'password')
            ->press('Login')
            ->seePageIs('/dashboard');

        $this->assertResponseStatus(200);
        $this->assertTrue( Auth::check() );

        $this->assertEquals( 'TestName',  Auth::user()->name );
    }

    /**
     * User Logout Test
     * @test  */
    public function auth_user_logout_OK_and_redirect_to_home_page()
    {
        $user = factory(User::class)->create([
            'name' => 'TestName',
        ]);

        $this->actingAs($user);
        $this->assertTrue( Auth::check() );

        $this->call('post', '/logout');
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/');

        $this->assertFalse( Auth::check() );
    }


}
