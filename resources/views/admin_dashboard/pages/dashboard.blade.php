@extends('admin_dashboard.layouts.default')
@section('content')
<div class="col-md-8 col-md-offset-2">
    <h1>Hello! {{ Auth::user()->name }}</h1>
</div>
<div class=col-md-16>
    @if(Auth::user()->role->id == 1)
    Role list: 
    <table border="1">
        <tr>
            <th>名称</th><th>解释说明</th>
        </tr>
        @foreach($role_list as $role)
        <tr>
            <th>{{ $role->title }}</th><th>{{ $role->explaination }}</th>
        </tr>
        @endforeach
    </table>
    <div class="form-horizontal">
        <a href="/staff/createrole" class="btn btn-primary btn-lg">CreateRole</a>    
    </div>
    <div class="form-horizontal">
        <h3>Staff Registration</h3>
        <a href="/staff/registration" class="btn btn-primary btn-lg">GoToRegister</a>    
    </div    >
    @else
    Role: {{ Auth::user()->role->title }} 
    @endif
</div>
<form  class="form-horizontal" action="{{ route('staff.logout') }}" method="POST">   
    {{ csrf_field() }}
    <fieldset>
        <legend>Staff Logout</legend>
        <button type="submit" class="btn btn-primary">Logout</button>
    </fieldset>
</form>
@stop