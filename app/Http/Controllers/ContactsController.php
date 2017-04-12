<?php

namespace App\Http\Controllers;

use App\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContact;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{

    /**
     * middleware assign
     * ContactsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $contacts = Auth::user()->contacts()->get()->toArray();

        list($contactKeys) = array_divide($contacts[0]); //get keys of first Contact
         $exceptKeys = array_except($contactKeys, [0,1,10]); //get only needed keys to show
         list($contactsKeys, $keysValues) = array_divide($exceptKeys); //get keys values
        $contactsKeys =  $keysValues;
//        dd($contacts->first());
//        dd( $keysValues );

        return view('contacts/index', compact('contactsKeys', 'contacts') );
    }

    /**
     * Create a new Contact page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function write() {

        return view('contacts/write');
    }

    /**
     * Export Contact to DB controller,
     * StoreContact - Request Rules
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContact $request) {

//        dd($request->organization);

//       Auth::user()->contacts()->saveMany( factory(Contact::class, 5)->create() );

        Auth::user()->contacts()->create( $request->all() );

        session()->flash('flash_message', 'Contact has been saved!');

        return redirect('contacts')->with(['flash_message']);
    }

    public function show(Contact $contact) {

        return view('contacts/show', compact('contact'));
    }

}
