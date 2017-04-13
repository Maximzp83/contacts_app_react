@extends('contacts/layouts/contacts_app')

@section('content')

{{--            <p>{{ dd($contacts) }}</p>--}}

    @if( $contacts->isNotEmpty() )
        <h1>My Contacts:</h1>
        <hr/>

        <div class="contacts-list-container">

            <table id="contacts" class="display table table-striped table-bordered table-responsive " cellspacing="0" width="100%">
                <thead>
                    <tr role="row" class="">
                        @foreach($titles as $index)
                        <th>{{ ucfirst($index) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tfoot>
                    <tr role="row" class="">
                        @foreach($titles as $index)
                            <th>{{ ucfirst($index) }}</th>
                        @endforeach
                    </tr>
                </tfoot>
                <tbody>
                @foreach($contacts as $contact )
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td><a href="/contacts/{!! $contact->id !!}/edit" class="edit-link">{{ $contact->name }}</a></td>
                    <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->address }}</td>
                    <td>{{ $contact->organization }}</td>
                    <td>
                        @if ($contact->is_friend) yes @else - @endif
                    </td>
                    <td>{{ $contact->getAgeAttribute($contact->birthday) }}</td>
                    <td>{{ $contact->created_at }}</td>
                    <td><a href="/contacts/{!! $contact->id !!}/delete" class="delete-link"><span class="glyphicon glyphicon-remove-circle"></span></a></td>

                </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    @else
        <h1>No Contacts yet</h1>
        <hr/>
    @endif

@endsection