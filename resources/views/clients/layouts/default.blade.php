<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('clients.includes.head')
    </head>
    <body>
        <div class="container">

            <header class="row">
                @include('clients.includes.header')
            </header>

            <div id="main" class="row">

                <!-- main content -->
                <div id="content" class="col-md-8">
                    @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                    <p class="alert alert-danger display-error">{{$error}}</p>
                    @endforeach
                    @endif
                    @yield('content')
                </div>

            </div>

            <footer class="row">
                @include('clients.includes.footer')
            </footer>

        </div>
        <!-- Scripts -->
        <script type="text/javascript">$('.display-error').fadeIn().delay(3000).fadeOut();</script>
    </body>
</html>