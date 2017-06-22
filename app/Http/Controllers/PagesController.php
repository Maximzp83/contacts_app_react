<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contact;
use Carbon\Carbon;


class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }


    public function index() {


        $titles = null;
        $contacts = null;
        $modContacts = null;

        if ( Auth::user() ) {
            $contacts = Auth::user()->contacts()->latest()->where('is_friend', '1')->get();

//                    dd($contacts);
            if ( $contacts->isNotEmpty() ) {
                $allIndexes = array_keys( $contacts[0]->getOriginal() ); //get keys of first Contact
//            $titles = array_except($allIndexes, [1,10]); //get only needed keys to show
                $titles = [];
                foreach ($allIndexes as $index => $value ) {
                    if ($allIndexes[$index] == 'birthday') {
                        $allIndexes[$index] = 'age';
                    }

                    if ($allIndexes[$index] != 'user_id' && $allIndexes[$index] != 'updated_at' ) {
                        $titles[] = $allIndexes[$index];
                    }
                }
                $titles[] = 'Actions';


                $modContacts = $contacts;
                $modContacts->map(function ($contact) {
                   $contact['toAge'] = $contact->age;
                    return $contact;
                });

//
            }

        }

//        dd($contacts);
//        return view('index', compact('titles', 'contacts'));

           if (Auth::user()) {
                $data['user'] = Auth::user();
                $data['user']['role'] = 'user';
           } else {
                $data['user']['role'] = 'guest';
           }

           if ($modContacts && $titles) {
                $data['contacts']['titles'] = $titles;
                $data['contacts']['contacts_list'] = $modContacts;


           }   else $data['contacts'] = null;

//        $contacts = '1231212412412';
//        $data = Auth::user();
//        dd($data);

        return response()->json($data);
//        return $this->response->setData(false, $result)->get();
    }


}
