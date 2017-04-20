<?php
/**
 * Created by PhpStorm.
 * User: ан
 * Date: 19.04.2017
 * Time: 18:57
 */

namespace Tests\Unit;


use App\User;
use App\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    protected $user;
    protected $contact;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->contact = factory(Contact::class)->make(['user_id' => $this->user->id]);

        $this->actingAs($this->user);
        /*$this->user = factory(Contact::class)->make([
            'name' => 'TestName',
            'email' => 'test@email.com',
            'phone' => 123456,
            ''
        ]);*/
    }

    /**
     * Contacts table in DB check
     * @test
     */
    function contact_can_added_to_DB_and_name_check()
    {
        $contact = factory(Contact::class)->create(['user_id' => $this->user->id]);

        $this->assertEquals(!0, Contact::all()->count());
        $this->seeInDatabase('contacts', ['name' => $contact->name]);
    }

    //    =========CONTACT TESTS FOR GUEST========

    /**
     * Guest writing a new Contact
     * @test
     */
    public function guest_cannot_write_new_contact()
    {
        Auth::logout();
        $this->assertFalse( Auth::check() );

        $this->visit('/contacts/write')
            ->assertResponseStatus(200)
            ->seePageIs('/login');
    }

    /**
     * Guest editing a new Contact
     * @test
     */
    public function guest_cannot_edit_contact()
    {
        Auth::logout();
        $this->assertFalse( Auth::check() );

        $user = $this->user;
        $contact = factory(Contact::class)->create(['user_id' => $user->id]);

        $this->visit("/contacts/{$contact->id}/edit")
            ->assertResponseStatus(200)
            ->seePageIs('/login');
    }

    /**
     * Guest deleting a new Contact
     * @test
     */
    public function guest_cannot_delete_contact()
    {
        Auth::logout();
        $this->assertFalse( Auth::check() );

        $user = $this->user;
        $contact = factory(Contact::class)->create(['user_id' => $user->id]);

        $this->visit("/contacts/{$contact->id}/delete")
            ->assertResponseStatus(200)
            ->seePageIs('/login');
    }

    //    =========CONTACT TESTS FOR AUTH User========
    /**
     * User writing a new Contact
     * @test
     */
    public function user_completed_contact_form_and_new_contact_created_ok()
    {
        $this->visit('/contacts/write')
            ->seePageIs('/contacts/write')
            ->type($this->contact->name, 'name')
            ->type($this->contact->email, 'email')
            ->type($this->contact->phone, 'phone')
            ->type($this->contact->address, 'address')
            ->type($this->contact->organization, 'organization')
            ->check('is_friend')
            ->type($this->contact->birthday, 'birthday')
            ->press('Save contact')
            ->assertResponseStatus(200)
            ->seePageIs('/contacts')
            ->see("Contact has been saved!");

        $this->seeInDatabase('contacts', ['name' => $this->contact->name]);
    }

    //    =========EDIT CONTACT TESTS========
    /**
     * User Edit a exist Contact
     * @test
     */
    public function user_edit_his_existing_contact()
    {
        $contact = factory(Contact::class)->create(['name' => 'FirstContactName', 'user_id' => $this->user->id, 'is_friend' => 1]);

        $this->assertEquals('FirstContactName', Contact::find($contact->id)->name);
        $this->seeInDatabase('contacts', ['name' => 'FirstContactName']);
        $this->dontSeeInDatabase('contacts', ['name' => 'NewContactName']);

        $this->visit("/contacts")
            ->click("{$contact->name}")
            ->seePageIs("/contacts/{$contact->id}/edit")
            ->type('NewContactName', 'name')
            ->uncheck('is_friend')
            ->press('Save Changes')
            ->assertResponseStatus(200)
            ->seePageIs('/contacts')
            ->see("Changes saved");

        $this->seeInDatabase('contacts', ['name' => 'NewContactName']);
        $this->dontSeeInDatabase('contacts', ['name' => 'FirstContactName']);
        $this->assertEquals('NewContactName', Contact::find($contact->id)->name);
    }

    /**
     * User Edit a does not exist Contact
     * @test
     */
    public function user_cannot_edit_not_existing_contact()
    {
        $this->dontSeeInDatabase('contacts', ['id' => '99']);

        $this->visit("/contacts/99/edit")
            ->see("Contact not exist!")
            ->assertResponseStatus(200)
            ->seePageIs('/contacts');
    }

    /**
     * User Edit not his Contact
     * @test
     */
    public function user_cannot_edit_not_his_contact()
    {
        $user1 = $this->user;
        $user2 = factory(User::class)->create();

        $this->actingAs($user1);
        $contact = factory(Contact::class)->create(['user_id' => $user2->id]);

        $this->visit("/contacts/{$contact->id}/edit")
            ->see("You Can't edit not Your's Contact!")
            ->assertResponseStatus(200)
            ->seePageIs('/contacts');
    }

//    =========DELETE CONTACT TESTS========
    /**
     * User delete a exist Contact
     * @test
     */
    public function user_delete_his_existing_contact()
    {
        $contact = factory(Contact::class)->create(['name' => 'ContactName', 'user_id' => $this->user->id]);

        $this->seeInDatabase('contacts', ['name' => 'ContactName']);

        $this->visit("contacts/{$contact->id}/delete")
            ->see("Contact removed!")
            ->assertResponseStatus(200)
            ->seePageIs('/contacts');

        $this->dontSeeInDatabase('contacts', ['name' => 'ContactName']);
    }

    /**
     * User delete a does not exist Contact
     * @test
     */
    public function user_cannot_delete_not_existing_contact()
    {
        $this->dontSeeInDatabase('contacts', ['id' => '99']);

        $this->visit("/contacts/99/delete")
            ->see("Contact not exist!")
            ->assertResponseStatus(200)
            ->seePageIs('/contacts');
    }

    /**
     * User Delete not his Contact
     * @test
     */
    public function user_cannot_delete_not_his_contact()
    {
        $user1 = $this->user;
        $user2 = factory(User::class)->create();

        $this->actingAs($user1);
        $contact = factory(Contact::class)->create(['user_id' => $user2->id]);

        $this->visit("/contacts/{$contact->id}/delete")
            ->see("You Can't remove not Your's Contact!")
            ->assertResponseStatus(200)
            ->seePageIs('/contacts');
    }

    //    =========Birthday CONTACT TESTS ========

    /**
     * User Birthday test Contact
     * @test
     */
    public function user_set_valid_birthday_date_and_contact_created_ok()
    {
        $this->visit('/contacts/write')
            ->seePageIs('/contacts/write')
            ->type('TestContact', 'name')
            ->type('2000-04-12', 'birthday')
            ->press('Save contact')
            ->assertResponseStatus(200)
            ->seePageIs('/contacts')
            ->see("Contact has been saved!");

        $contact = Contact::where('name', 'TestContact')->get()->first();
        $this->assertEquals( '2000-04-12', $contact->birthday );
    }

    /**
     * User Birthday test Contact
     * @test
     */
    public function user_set_birthday_to_now_date_and_contact_not_created()
    {
        $nowDate = Carbon::now()->format('Y-m-d');

        $this->visit('/contacts/write')
            ->seePageIs('/contacts/write')
            ->type('TestContact', 'name')
            ->type($nowDate, 'birthday')
            ->press('Save contact')
            ->assertResponseStatus(200)
            ->seePageIs('/contacts/write')
            ->see("Wrong Birth Date!");

        $this->dontSeeInDatabase('contacts', ['name' => 'TestContact']);
    }

    /**
     * User Birthday test Contact
     * @test
     */
    public function user_set_birthday_to_future_date_and_contact_not_created()
    {
        $futureDate = Carbon::now()->addDay()->format('Y-m-d');

        $this->visit('/contacts/write')
            ->seePageIs('/contacts/write')
            ->type('TestContact', 'name')
            ->type($futureDate, 'birthday')
            ->press('Save contact')
            ->assertResponseStatus(200)
            ->seePageIs('/contacts/write')
            ->see("Wrong Birth Date!");

        $this->dontSeeInDatabase('contacts', ['name' => 'TestContact']);
    }

    /**
     * User Age Calculation Test
     * @test
     */
    public function birthday_date_calculating_to_age_in_years_correct()
    {
        $contact = factory(Contact::class)->create([
            'name' => 'TestContact',
            'user_id' => $this->user->id,
            'birthday' => Carbon::now()->subYears(10)->format('Y-m-d')
        ]);
        $this->seeInDatabase('contacts', ['name' => 'TestContact']);

        $age = $contact->getAgeAttribute($contact->birthday);
        $this->assertEquals( 10, $age );
    }

    /**
     * User Can See Person Age on contacts page
     * @test
     */
    public function user_visit_on_contacts_page_and_see_age()
    {
        $contact = factory(Contact::class)->create([
            'name' => 'TestContact',
            'user_id' => $this->user->id,
            'birthday' => Carbon::now()->subYears(10)->format('Y-m-d')
        ]);
        $this->seeInDatabase('contacts', ['name' => 'TestContact']);
        $this->assertEquals( 1, Contact::all()->count() );

        $age = $contact->getAgeAttribute($contact->birthday);

        $this->visit('/contacts')
            ->seePageIs('/contacts')
            ->seeText($age);
    }

}

