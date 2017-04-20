<?php

namespace App\Http\Controllers;

use App\Contact;
use Carbon\Carbon;
use App\Http\Requests\StoreContact;
use Illuminate\Support\Facades\Auth;
use Validator;

class ContactsController extends Controller
{

    /**
     * middleware assign
     * This Controller Methods Available only for Auth Users
     * ContactsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = Auth::user()->contacts()->latest()->get();

//        ----Prepare array with Indexes for Contacts table --------
        if ($contacts->isNotEmpty()) {
            $allIndexes = array_keys($contacts[0]->getOriginal()); //get keys of first Contact
//            $titles = array_except($allIndexes, [1,10]); //get only needed keys to show
            $titles = [];
            foreach ($allIndexes as $index => $value) {
                if ($allIndexes[$index] == 'birthday') {
                    $allIndexes[$index] = 'age';
                }

                if ($allIndexes[$index] != 'user_id' && $allIndexes[$index] != 'updated_at') {
                    $titles[] = $allIndexes[$index];
                }
            }
            $titles[] = 'Actions';
        }

        return view('contacts/index', compact('titles', 'contacts'));
    }

    /**
     * new Contact creating page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function write()
    {
        return view('contacts/write');
    }

    /**
     * Export Contact to DB Controller,
     * StoreContact - Request Rules
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContact $request)
    {
//       Auth::user()->contacts()->saveMany( factory(Contact::class, 10)->create() );

//        ----Birth Date Validation---
        $birthDate = $request->birthday;
        if ($birthDate != null && Carbon::parse($birthDate)->diffInDays(Carbon::now(), false) < 1) {
            session()->flash('flash_message_warning', "Wrong Birth Date!");
            session()->flash('flash_message_important', true);
            return redirect('contacts/write')->with(['flash_message_warning']);
        }

        Auth::user()->contacts()->create($request->all());

        session()->flash('flash_message', 'Contact has been saved!');

        return redirect('contacts')->with(['flash_message']);
    }

    /**
     * Delete Contact Controller
     * @param Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {// Contact $contact, StoreContact $request ) {
//    dd($contact);

        //-----contact exists in DB validation-----
        $validationData = [];
        $validationData['id'] = $id;

        $validate = Validator::make($validationData, [
            'id' => 'required|exists:contacts,id',
        ]);

        if ($validate->fails()) {
            session()->flash('flash_message_warning', "Contact not exist!");
            session()->flash('flash_message_important', true);
            return redirect('contacts')->with(['flash_message_warning']);
        }

        $contact = Contact::find($id);

        //----- Does this contact belong to this user validation---
        if ($contact->user_id == Auth::user()->id) {
            $contact->delete();
            session()->flash('flash_message', 'Contact removed!');
        } else {
            session()->flash('flash_message_warning', "You Can't remove not Your's Contact!");
            session()->flash('flash_message_important', true);
            return redirect('contacts')->with(['flash_message_warning']);
        }

        return redirect('contacts')->with(['flash_message']);
    }

    /**
     * Edit Contact Controller
     * Prepare Contact to Edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
     //----contact exists in DB validation------
        $validationData = [];
        $validationData['id'] = $id;

        $validate = Validator::make($validationData, [
            'id' => 'required|exists:contacts,id',
        ]);

        if ($validate->fails()) {
            session()->flash('flash_message_warning', "Contact not exist!");
            session()->flash('flash_message_important', true);
            return redirect('contacts')->with(['flash_message_warning']);
        }

        $contact = Contact::find($id);

        //----- Does this contact belong to this user validation---
        if ($contact->user_id == Auth::user()->id) {
            return view('contacts/edit', compact('contact'));
        } else {
            session()->flash('flash_message_warning', "You Can't edit not Your's Contact!");
            session()->flash('flash_message_important', true);
            return redirect('contacts')->with(['flash_message_warning']);
        }
    }

    /**
     * Prepare Contact after Edit to Save into DataBase
     * @param StoreContact $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreContact $request, $id)
    {
    //-----Birth Date Validation------
        $birthDate = $request->birthday;
        if ($birthDate != null && Carbon::parse($birthDate)->diffInDays(Carbon::now(), false) < 1) {
            session()->flash('flash_message_warning', "Wrong Birth Date!");
            session()->flash('flash_message_important', true);
            return redirect("contacts/{$id}/edit")->with(['flash_message_warning']);
        }

        $validationData = [];
        $validationData['id'] = $id;

    //-----contact exists in DB validation----
        $validate = Validator::make($validationData, [
            'id' => 'required|exists:contacts,id',
        ]);

        if ($validate->fails()) {
            session()->flash('flash_message_warning', "Contact not exist!");
            session()->flash('flash_message_important', true);
            return redirect('contacts')->with(['flash_message_warning']);
        }

        $contact = Contact::find($id);

        $input = $request->all();
        $input['is_friend'] = isset($input['is_friend']) ? 1 : 0;

        //----- Does this contact belong to this user validation---
        if ($contact->user_id == Auth::user()->id) {
            $contact->update($input);
            session()->flash('flash_message', 'Changes saved!');
        } else {
            session()->flash('flash_message_warning', "You Can't edit not Your's Contact!");
            session()->flash('flash_message_important', true);
            return redirect('contacts')->with(['flash_message_warning']);
        }

        return redirect('contacts')->with(['flash_message']);
    }


}
