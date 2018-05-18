@extends('clients.layouts.default')
@section('content')
    <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    PrinceSite
                </div>

                <p class="text-center text-warning">Create anything crazy~~~</p>
                <a href="{{ url('/clients/registration') }}" ><button type="button" class="btn btn-info">Registration</button></a>
                <button href="#" type="button" class="btn btn-info">Login</button>
            </div>
        </div>
@stop