@extends('contacts/layouts/contacts_app')

@section('content')

    <h1>Write a new Contact:</h1>
    <hr/>

    <form action="{{ url('/contacts') }}" method="POST">
        @include('contacts/partials/_form', [
            'articleTitle' => '',
            'articleBody' => '',
            'articlePublishedTime' => date('Y-m-d'),
            'submitButtonText' => 'Save Contact',
            'article' => new App\Contact,
              ])

    </form>

    @include('errors/list')

@endsection