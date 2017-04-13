{{--
@if (Session::has('flash_message') || Session::has('flash_message_important') )
    <div class="alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if( Session::has('flash_message_important') )
            {{ session('flash_message_important') }}
            <button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
        @endif
         {{ session('flash_message') }}
    </div>
@endif--}}

@if (Session::has('flash_message'))
    <div class="alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if( Session::has('flash_message_important') )
            <button type="button" class="close" data-dismiss="alert" area-hidden="true">&times;</button>
        @endif
        {{ session('flash_message') }}
    </div>
@endif

@if (Session::has('flash_message_warning'))
    <div class="alert alert-danger {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if( Session::has('flash_message_important') )
            <button type="button" class="close" data-dismiss="alert" area-hidden="true">&times;</button>
        @endif
        {{ session('flash_message_warning') }}
    </div>
@endif