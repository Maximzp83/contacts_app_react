<input type="hidden" name="_token" value="{{ csrf_token() }}"/>
<div class="form-group">
    <label for="name-input" class="">Name: </label>
    <input id="name-input" type="text" name="name" class="form-control" value="">

</div>

<div class="form-group">
    <label for="email-input" class="">E-Mail: </label>
    <input id="email-input" type="email" class="form-control" name="email" value="">
</div>

<div class="form-group">
    <label for="phone-input" class="">Phone: </label>
    <input id="phone-input" type="tel" class="form-control" name="phone" value="">
</div>

<div class="form-group">
    <label for="address-input" class="">Address: </label>
    <input id="address-input" type="text" class="form-control" name="address" value="">
</div>

<div class="form-group">
    <label for="organization-input" class="">Organization/Company: </label>
    <input id="organization-input" type="text" class="form-control" name="organization" value="">
</div>

<div class="form-group">
    <label for="birthday-input" class="">Publish On: </label>
    {{--<input id="published-input" type="date" name="published_at" class="form-control" value="{{ $article->published_at->format('Y-m-d') }}">--}}
    <input id="birthday-input" type="date" name="birthday" class="form-control" value="">
</div>

<div class="form-group">
    <label for="friend-input" class="">Is a Friend: </label>
    <input id="friend-input" type="checkbox" class="form-control" name="friend" value="">
</div>


<button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>