<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('contacts/index');
    }

    public function write() {

        return view('contacts/write');
    }
}
