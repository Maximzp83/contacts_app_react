<?php
/**
 * Created by PhpStorm.
 * User: ан
 * Date: 14.04.2017
 * Time: 16:25
 */

namespace Tests\Unit;

use App\User;
use App\Contact;
use Tests\TestCase;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class RouteTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $contact;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->contact = factory(Contact::class)->create(['user_id' => $this->user->id]);
    }

    /**
     * Guest can call home '/' page
     * @test  */
    public function guest_call_home_page() {
        $this->call('get', '/');
        $this->assertResponseStatus(200);
        $this->seePageIs('/');
    }

    /**
     * Guest can call '/register' page
     * @test  */
    public function guest_call_register_page() {
        $this->call('get', '/register');
        $this->assertResponseStatus(200);
        $this->seePageIs('/register');
    }

    /**
     * Guest can call '/login' page
     * @test  */
    public function guest_call_login_page() {
        $this->call('get', '/login');
        $this->assertResponseStatus(200);
        $this->seePageIs('/login');
    }

    /**
     * Guest cannot call 'contacts' page
     * @test  */
    public function guest_call_contacts_page_and_redirected_to_login_page() {
        $this->call('get', '/contacts');
        $this->assertResponseStatus(302);
        $this->dontSee('My Contacts');

        $this->assertRedirectedTo('/login');
    }

    /**
     * Guest cannot call 'contacts/write' page
     * @test  */
    public function guest_call_write_contacts_page_and_redirected_to_login_page() {
        $this->call('get', '/contacts/write');
        $this->assertResponseStatus(302);
        $this->dontSee('Write a new Contact:');

        $this->assertRedirectedTo('/login');
    }

    /**
 * Guest cannot call 'contacts/{id}/edit' page
 * @test  */
    public function guest_call_edit_contact_page_and_redirected_to_login_page() {
        $this->call('get', "contacts/{$this->contact->id}/edit");
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/login');
    }

    /**
     * Guest cannot call 'contacts/{id}/delete' page
     * @test  */
    public function guest_call_delete_contact_and_redirected_to_login_page() {
        $this->call('get', "contacts/{$this->contact->id}/delete");
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/login');
    }

//    =============Auth User Tests=============

    /**
     * Auth User calling home '/' page
     * @test  */
    public function auth_user_can_call_home_page_and_see_this_page() {
        $this->actingAs($this->user);

        $this->call('get', '/');
        $this->assertResponseStatus(200);
        $this->seePageIs('/');
    }

    /**
     * Auth User calling '/register' page
     * @test  */
    public function auth_user_call_register_page_and_redirect_to_dashboard() {
        $this->actingAs($this->user);

        $this->call('get', '/register');
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/dashboard');
    }

    /**
     * Auth User calling '/login' page
     * @test  */
    public function auth_user_call_login_page_and_redirect_to_dashboard() {
        $this->actingAs($this->user);

        $this->call('get', '/login');
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/dashboard');
    }

    /**
     * Auth User calling 'contacts' page
     * @test  */
    public function auth_user_can_call_contacts_page_and_see_this_page() {
        $this->actingAs($this->user);

        $this->call('get', '/contacts');
        $this->assertResponseStatus(200);
        $this->seePageIs('/contacts');
    }

    /**
     * Auth User calling 'contacts/write' page
     * @test  */
    public function auth_user_can_call_write_contact_page_and_see_this_page() {
        $this->actingAs($this->user);

        $this->call('get', '/contacts/write');
        $this->assertResponseStatus(200);
        $this->seePageIs('/contacts/write');
    }

    /**
     * Auth User calling 'contacts/{id}/edit' page
     * @test  */
    public function auth_user_can_call_edit_contact_page_and_see_this_page() {
        $this->actingAs($this->user);

        $this->call('get', "contacts/{$this->contact->id}/edit");
        $this->assertResponseStatus(200);
        $this->seePageIs("contacts/{$this->contact->id}/edit");
    }

    /**
     * Auth User calling 'contacts/{id}/delete' page
     * @test  */
    public function auth_user_can_call_delete_contact_method_and_redirect_to_contacts_page() {
        $this->actingAs($this->user);

        $this->call('get', "contacts/{$this->contact->id}/delete");
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/contacts');
    }


}
