@extends('contacts/layouts/contacts_app')

@section('content')

    <h1>Edit <b>{{ $contact->name }}</b> contact</h1>
    <hr/>

    @include('errors/list')

    <form action="{!! action( 'ContactsController@update', [$contact->id] ) !!}" method="POST">
        <input type="hidden" name="_method" value="PATCH"/>
        @include('contacts/partials/_form', [
            'contact' => $contact,
            'birthdayDate' => $contact->birthday,
            'submitButtonText' => 'Save Changes',
              ])

    </form>



@endsection