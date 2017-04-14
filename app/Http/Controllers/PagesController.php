<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if ( Auth::user() ) {
            $contacts = Auth::user()->contacts()->latest()->where('is_friend', '1')->get();

            //        dd($contacts);
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
            }

        }

        return view('index', compact('titles', 'contacts'));
    }


}
