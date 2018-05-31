@extends('admin_dashboard.layouts.default')
@section('content')
<div class="col-md-16 col-md-offset-2">
    <h1>Hello! {{ Auth::user()->name }}</h1>
</div>
<form class="form-horizontal" action="{{ route('staff.createRole') }}" method="POST">   
    {{ csrf_field() }}
    <fieldset>
        <legend>Create New Role</legend>
        <input type="text" size="40" name="title" placeholder="Please enter the name of the new role"><br>
        <textarea rows="5" cols="50" name="explaination" placeholder="Please write something to explain this role"></textarea><br>
        <div class="col-md-6">
            <h3>Select Columns</h3>
            @foreach($columns as $column)
        <label for="inputColumns">
            <input type="checkbox" name="columns[]" value="{{ $column->id }}">{{ $column->name }}
        </label>
        @endforeach
        </div><hr>
        <div class="col-md-6">
            <h3>Select Operations</h3>
            @foreach($operations as $operation)
        <label for="inputOperations">
            <input type="checkbox" name="operations[]" value="{{ $operation->id }}">{{ $operation->name }}
        </label>
        @endforeach
        </div>
        <button type="submit" class="btn btn-primary">CreateRole</button>
    </fieldset>
</form>
@stop