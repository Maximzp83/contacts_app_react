<input type="hidden" name="_token" value="{{ csrf_token() }}"/>

<div class="contacts-form-wrapper">
    {{--NAME--}}
<div class="form-group">
    <label for="name-input" class="">Name: </label>
    <input id="name-input" type="text" name="name" class="form-control" value="{{ $contact->name }}" required>
</div>
{{--EMAIL--}}
<div class="form-group">
    <label for="email-input" class="">E-Mail: </label>
    <input id="email-input" type="email" class="form-control" name="email" value="{{ $contact->email }}">
</div>
{{--PHONE--}}
<div class="form-group">
    <label for="phone-input" class="">Phone: </label>
    <input id="phone-input" type="tel" class="form-control" name="phone" value="{{ $contact->phone }}">
</div>
{{--ADDRESS--}}
<div class="form-group">
    <label for="address-input" class="">Address: </label>
    <input id="address-input" type="text" class="form-control" name="address" value="{{ $contact->address }}">
</div>
{{--COMPANY--}}
<div class="form-group">
    <label for="organization-input" class="">Organization/Company: </label>
    <input id="organization-input" type="text" class="form-control" name="organization" value="{{ $contact->organization }}">
</div>
{{--BIRTHDAY--}}
<div class="form-group">
    <label for="birthday-input" class="">Was Born In: </label>
    <input id="birthday-input" type="date" name="birthday" class="form-control" value="{{ $birthdayDate }}">
</div>
{{--FIEND CHECKBOX--}}
<div class="form-group">
    <label for="friend-input" class="">Is a Friend: </label>
    <input id="friend-input" type="checkbox" class="form-control friend-check" name="is_friend" value="1"
        <?php if($contact->is_friend) {echo "checked";} ?> >
</div>

<button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
</div>