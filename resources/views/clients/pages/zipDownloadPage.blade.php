@extends('clients.layouts.default')
@section('content')
<div class="col-md-8 col-md-offset-2">
    {{ Auth::user() }}
</div>
<form  class="form-horizontal" action="{{ route('clients.zip_download') }}" method="POST">   
    {{ csrf_field() }}
    <fieldset>
        <legend>Zipper Download</legend>
        <p>Put all the files you want to be downloaded into the {$files} array.</p>
        <p>This method is implementing the Zipper which suit Laravel framework.</p>
        <button type="submit" class="btn btn-primary">Zip_Download</button>
    </fieldset>
</form>
<form  class="form-horizontal" action="{{ route('clients.simple_zip_download') }}" method="POST">   
    {{ csrf_field() }}
    <fieldset>
        <legend>ZipArchive Download</legend>
        <p>Put all the files you want to be downloaded into the {$files} array.</p>
        <p>This method is implementing the default PHP ZipArchive.</p>
        <button type="submit" class="btn btn-primary">Zip_Download</button>
    </fieldset>
</form>
@stop