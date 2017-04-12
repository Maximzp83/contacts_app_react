@extends('contacts/layouts/contacts_app')

@section('content')

    <h1>Write a new Contact:</h1>
    <hr/>

    @include('errors/list')

    <form action="{{ url('/contacts') }}" method="POST">
        @include('contacts/partials/_form', [
            'articleTitle' => '',
            'articleBody' => '',
            'articlePublishedTime' => date('Y-m-d'),
            'submitButtonText' => 'Save Contact',
            'contact' => new App\Contact,
              ])

    </form>



@endsection