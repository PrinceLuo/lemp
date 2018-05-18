@extends('clients.layouts.default')
@section('content')
<form  class="form-horizontal" action="{{ route('clients.registration') }}" method="POST">
    {{ csrf_field() }}
    <fieldset>
        <legend>Clients Registration</legend>
        <div class="form-group">
            <label for="inputName">Name</label>
            <input class="form-control" type="text" placeholder="Enter Your Name" name="name" value="{{old('name')}}">   
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mobile Number</label>
            <input class="form-control" placeholder="Enter Your Mobile Number" type="text" name="mobile_number" value="{{old('mobile_number')}}">
            <small class="form-text text-muted">We'll never share your mobile number with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="inputName">sex</label>
            <input class="form-control" type="text" placeholder="Enter Your Sex: 0 for Male, 1 for FeMale, 2 for Unknown" name="sex" value="{{old('sex')}}">   
        </div>
        <div class="form-group">
            <label for="inputAge">age</label>
            <input class="form-control" type="text" placeholder="Enter Your Age" name="age" value="{{old('age')}}">   
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" placeholder="Password" type="password" name="password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <!-- Notice: the value of the tag "name" has to be "password_confirmation" to cooperate with the Laravel validation -->
            <input class="form-control" id="example InputPassword1" placeholder="Confirm Password" type="password" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </fieldset>
</form>
@stop