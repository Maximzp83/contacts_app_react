@extends('app')

@section('content')

    @if ( Auth::user() )
        <h1>Welcome {{ Auth::user()->name }}!</h1>
        <hr/>
        <p>Your Friends Contacts:</p>
    @else
        <h1>Hello There!</h1>
        <p>To use this application, you must be a registered and login.</p>
    @endif

@endsection