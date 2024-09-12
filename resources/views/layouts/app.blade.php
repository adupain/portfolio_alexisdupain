<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

</head>
<body>
    <div>
        <div id="app">
            <div id="wrapper" class="position-relative">
                <div id="navigation">
                    <nav-bar></nav-bar>
                </div>
                <main class="py-2">
                    @yield('content')
                </main>
                <div id="footer" style="bottom: 0; left: 0; right: 0;">
                    <custom-footer></custom-footer>
                </div>
            </div>
        </div>
    </div>
    @stack('js')
    <script>
        $(function(){
            new Vue({
                el: '#navigation',
                data: function () {
                    return {
                    }
                },
                props: {
                },
            });
        });
        $(function(){
            new Vue({
                el: '#footer',
                data: function () {
                    return {
                    }
                },
                props: {
                },
            });
        });
    </script>
</body>
</html>
