@extends('admin_dashboard.layouts.default')
@section('content')
<h1>Hello! {{ Auth::user()->name }}!</h1><br>
@if(in_array(2,$ops))
<button type="button" class="btn btn-success">添加</button>
@else
<button type="button" class="btn btn-success" disabled="disabled">添加</button>
@endif
<table border="1" width="600">
    <tr>
        <th>序号</th>
        <th>标题</th>
        <th>创建时间</th>
        <th>最后更改时间</th>
        <th>最后更改人员</th>
        <th colspan="3">操作</th>
    </tr>
    @foreach($table_data as $data)
    <?php $index = 0; ?>
    <tr>
        <td>{{ ++$index }}</td>
        <td>{{ $data['title'] }}</td>
        <td>{{ $data['created_at'] }}</td>
        <td>{{ $data['updated_at'] }}</td>
        <td>{{ $data['mod_name'] }}</td>
        <td>
            <button type="button" class="btn btn-primary">查看</button>
        </td>
        <td>
            @if(in_array(3,$ops))
            <button type="button" class="btn btn-warning">修改</button>
            @else
            <button type="button" class="btn btn-warning" disabled="disabled">修改</button>
            @endif
        </td>
        <td>
            @if(in_array(4,$ops))
            <button type="button" class="btn btn-danger">删除</button>
            @else
            <button type="button" class="btn btn-danger" disabled="disabled">删除</button>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@stop