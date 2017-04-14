@extends('app')

@section('content')

    @if ( Auth::user() )
        <h1>Welcome {{ Auth::user()->name }}!</h1>
        <hr/>

        @if( $contacts->isNotEmpty() )
            <h4>Your Friends Contacts:</h4>

            <div class="contacts-list-container">

                <table id="contacts"
                       class="display table table-striped table-bordered table-responsive "
                       cellspacing="0" width="100%">
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
                            <td><a href="/contacts/{!! $contact->id !!}/edit"
                                   class="edit-link">{{ $contact->name }}</a></td>
                            <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->address }}</td>
                            <td>{{ $contact->organization }}</td>
                            <td>
                                @if ($contact->is_friend) yes @else - @endif
                            </td>
                            <td>{{ $contact->getAgeAttribute($contact->birthday) }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td class="actions-column">
                                <a href="/contacts/{!! $contact->id !!}/delete" class="delete-link">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        @else
            <h1>No Friends yet</h1>
            <hr/>
        @endif

    @else
        <h1>Hello There!</h1>
        <p>To use this application, you must be a registered and login.</p>
    @endif

@endsection