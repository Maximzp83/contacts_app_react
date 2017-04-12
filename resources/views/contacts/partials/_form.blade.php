<input type="hidden" name="_token" value="{{ csrf_token() }}"/>

<div class="contacts-form-wrapper">
    {{--NAME--}}
<div class="form-group">
    <label for="name-input" class="">Name: </label>
    <input id="name-input" type="text" name="name" class="form-control" value="" required>
</div>
{{--EMAIL--}}
<div class="form-group">
    <label for="email-input" class="">E-Mail: </label>
    <input id="email-input" type="email" class="form-control" name="email" value="">
</div>
{{--PHONE--}}
<div class="form-group">
    <label for="phone-input" class="">Phone: </label>
    <input id="phone-input" type="tel" class="form-control" name="phone" value="">
</div>
{{--ADDRESS--}}
<div class="form-group">
    <label for="address-input" class="">Address: </label>
    <input id="address-input" type="text" class="form-control" name="address" value="">
</div>
{{--COMPANY--}}
<div class="form-group">
    <label for="organization-input" class="">Organization/Company: </label>
    <input id="organization-input" type="text" class="form-control" name="organization" value="">
</div>
{{--BIRTHDAY--}}
<div class="form-group">
    <label for="birthday-input" class="">Was Born In: </label>
    <input id="birthday-input" type="date" name="birthday" class="form-control" value="">
</div>
{{--FIEND CHECKBOX--}}
<div class="form-group">
    <label for="friend-input" class="">Is a Friend: </label>
    <input id="friend-input" type="checkbox" class="form-control friend-check" name="is_friend" value="1">
</div>

<button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
</div>