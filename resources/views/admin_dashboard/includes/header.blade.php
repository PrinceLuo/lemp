<div class="navbar">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guard('staff')->check())
                <!-- add the url from the database later -->
                @foreach(Auth::user()->role->columns as $column)
                <li><a href="{{ route($column->route) }}">{{ $column->name }}</a></li>
                @endforeach
                @endif
            </ul>
        </div>
    </nav>
</div>