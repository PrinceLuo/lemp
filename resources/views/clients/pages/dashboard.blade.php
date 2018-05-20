@extends('clients.layouts.default')
@section('content')
<div class="col-md-8 col-md-offset-2">
    {{ Auth::user() }}
</div>
<form  class="form-horizontal" action="{{ route('clients.logout') }}" method="POST">   
    {{ csrf_field() }}
    <fieldset>
        <legend>Clients Logout</legend>
        <button type="submit" class="btn btn-primary">Logout</button>
    </fieldset>
</form>
@stop