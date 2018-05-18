@extends('clients.layouts.default')
@section('content')
<form  class="form-horizontal" action="{{ route('clients.login') }}" method="POST">
    {{ csrf_field() }}
    <fieldset>
        <legend>Clients Registration</legend>
        <div class="form-group">
            <label for="exampleInputEmail1">Mobile Number</label>
            <input class="form-control" placeholder="Enter Your Mobile Number" type="text" name="mobile_number" value="{{old('mobile_number')}}">
            <small class="form-text text-muted">We'll never share your mobile number with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" placeholder="Password" type="password" name="password">
        </div>
        
        <button type="submit" class="btn btn-primary">Login</button>
    </fieldset>
</form>
@stop