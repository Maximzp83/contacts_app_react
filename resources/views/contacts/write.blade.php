@extends('contacts/layouts/contacts_app')

@section('content')

    <h1>Write a new Contact:</h1>
    <hr/>

    @include('errors/list')

    <form action="{{ url('/contacts') }}" method="POST">
        @include('contacts/partials/_form', [
            'contact' => new App\Contact,
            'birthdayDate' => '',
            'submitButtonText' => 'Save contact',
              ])

    </form>



@endsection