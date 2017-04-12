@extends('contacts/layouts/contacts_app')

@section('content')

{{--        <p>{{ dd($contacts) }}</p>--}}

    @if( $contacts )
        <h1>My Contacts:</h1>
        <hr/>

        <div class="contacts-list-container">

           @foreach ($contactsKeys as $key => $val)
            <ul class="contacts-list">
                <p>{{ucfirst($val)}}</p>
                @foreach( $contacts as $key2 => $contact )
                    @if ( $key == 0 )
                    <li><a href="">{{ $contact[$val] }}</a></li>
                    @elseif( $contact[$val] )
                    <li>{{ $contact[$val] }}</li>
                        @else
                        <li>{{ '-' }}</li>
                    @endif
                @endforeach
            </ul>
            @endforeach




        </div>

    @else
        <h1>No Contacts yet</h1>
        <hr/>
    @endif

@endsection