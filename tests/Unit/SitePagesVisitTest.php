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
use Tests\TestCase;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SitePagesVisitTest extends BrowserKitTestCase
{
    use DatabaseTransactions;
//    use WithoutMiddleware;

    protected $user;
    protected $contact;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function getUser() {
        return $this->user;
    }

    /**
     * Guest visit homepage
     * @test  */
    public function guest_visit_home_page_and_see_this_page_with_links()
    {
        $this->visit('/')
            ->seePageIs('/')
            ->seeText('Hello Guest!')
            ->seeLink('Register', '/register')
            ->seeLink('Login', '/login')
            ->seeLink('Home', '/')
            ->dontSeeLink('My Contacts', '/contacts');
    }

    /**
     * Guest visit register page from homepage
     * @test  */
    public function guest_visit_home_then_register_page_and_see_this_page_with_form()
    {
        $this->visit('/')
            ->click('Register')
            ->seePageIs('/register')
            ->seeLink('Register', '/register')
            ->seeLink('Login', '/login')
            ->seeLink('Home', '/')
            ->seeElement('form')
            ->seeElement('button', ['type' => 'submit']);
    }

    /**
     * Guest visit login page from homepage
     * @test  */
    public function guest_visit_home_then_click_login_and_see_this_page_with_form()
    {
        $this->visit('/')
            ->click('Login')
            ->seePageIs('/login')
            ->seeLink('Register', '/register')
            ->seeLink('Login', '/login')
            ->seeLink('Home', '/')
            ->seeElement('form')
            ->seeElement('button', ['type' => 'submit']);
    }

    /**
     * Guest visit homepage from login page
     * @test  */
    public function guest_visit_login_page_then_click_home_and_see_this_page()
    {
        $this->visit('/login')
            ->click('Home')
            ->seePageIs('/')
            ->seeText('Hello Guest!')
            ->seeLink('Register', '/register')
            ->seeLink('Login', '/login')
            ->seeLink('Home', '/');
    }

//=============Auth User Tests=============

    /**
     * Auth User visit homepage
     * @test  */
    public function auth_user_visit_homepage_and_see_this_page_with_links_and_no_friends()
    {
        $this->actingAs($this->user);

        $this->visit('/')
            ->seePageIs('/')
            ->seeText("Welcome {$this->user->name}!")
            ->seeText("No Friends yet")
            ->seeLink('Home', '/')
            ->seeLink("My Contacts", '/contacts')
            ->seeLink("Logout", '/logout')
            ->dontSeeLink('Register', '/register')
            ->dontSeeLink('Login', '/login')
            ->dontSeeElement('table', ['id' => 'contacts']);
    }

    /**
 * Auth User visit homepage with friends contacts
 * @test  */
    public function auth_user_visit_homepage_and_see_this_page_with_friend_contact_with_edit_and_delete_links()
    {
        $this->actingAs($this->user);
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id, 'is_friend' => 1]);

        $this->visit('/')
            ->seePageIs('/')
            ->seeText("Welcome {$this->user->name}!")
            ->dontSeeText("No Friends yet")
            ->seeText("Your Friends Contacts:")
            ->seeElement('table', ['id' => 'contacts'])
            ->seeLink("{$contact->name}", "/contacts/{$contact->id}/edit")
            ->seeLink("", "/contacts/{$contact->id}/delete")

            ->seeLink('Home', '/')
            ->seeLink("My Contacts", '/contacts')
            ->seeLink("Logout", '/logout')
            ->dontSeeLink('Register', '/register')
            ->dontSeeLink('Login', '/login');
    }

    /**
     * Auth User visit my contacts from homepage without contacts
     * @test  */
    public function auth_user_visit_homepage_then_My_contacts_and_see_this_page_without_contacts()
    {
        $this->actingAs($this->user);

        $this->visit('/')
            ->seePageIs('/')
            ->click('My Contacts')
            ->seePageIs('/contacts')
            ->dontSeeText("My Contacts:")
            ->seeText("No Contacts yet")
            ->dontSeeElement('table', ['id' => 'contacts'])

            ->seeLink('Home', '/')
            ->seeLink("My Contacts", '/contacts')
            ->seeLink("Write Contact", '/contacts/write')
            ->seeLink("Logout", '/logout')
            ->dontSeeLink('Register', '/register')
            ->dontSeeLink('Login', '/login');
    }

    /**
     * Auth User visit my contacts from homepage with all contacts
     * @test  */
    public function auth_user_visit_homepage_then_My_contacts_and_see_this_page_with_contacts_with_edit_and_delete_links()
    {
        $this->actingAs($this->user);
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id, 'is_friend' => 1]);

        $this->visit('/')
            ->seePageIs('/')
            ->click('My Contacts')
            ->seePageIs('/contacts')
            ->seeText("My Contacts:")
            ->dontSeeText("No Contacts yet")
            ->seeElement('table', ['id' => 'contacts'])
            ->seeLink("{$contact->name}", "/contacts/{$contact->id}/edit")
            ->seeLink("", "/contacts/{$contact->id}/delete")

            ->seeLink('Home', '/')
            ->seeLink("My Contacts", '/contacts')
            ->seeLink("Write Contact", '/contacts/write')
            ->seeLink("Logout", '/logout')
            ->dontSeeLink('Register', '/register')
            ->dontSeeLink('Login', '/login');
    }

    /**
     * Auth User visit Write Contact page from My contacts page
     * @test  */
    public function auth_user_visit_My_contacts_then_Write_Contact_and_see_this_page_with_form()
    {
        $this->actingAs($this->user);

        $this->visit('/contacts')
            ->seePageIs('/contacts')
            ->click('Write Contact')
            ->seePageIs('/contacts/write')
            ->seeText("Write a new Contact:")
            ->seeElement('form')
            ->seeElement('button', ['type' => 'submit'])

            ->seeLink('Home', '/')
            ->seeLink("My Contacts", '/contacts')
            ->seeLink("Write Contact", '/contacts/write')
            ->seeLink("Logout", '/logout')
            ->dontSeeLink('Register', '/register')
            ->dontSeeLink('Login', '/login');
    }


   /* public function user_can_visit_and_see_all_pages()
    {

        $this->actingAs($this->user);
        $allPages = [
            '/',
            '/register',
            '/login',
            '/dashboard'
        ];

//        $this->withoutMiddleware();
        foreach ($allPages as $page) {
            $this->visit($page);
        }
        $this->withoutMiddleware();
       $this->visit('/contacts')
            ->seePageIs('/contacts');
       $this->visit('/register')
            ->seePageIs('/register');
    }*/



}
