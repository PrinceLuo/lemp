@extends('clients.layouts.default')
@section('content')
<div class="col-md-8 col-md-offset-2">
    Congratulations! {{ Auth::user()->name }}, you pass the auth test!
</div>
@stop