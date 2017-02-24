<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/style.css') }}">
    <script src="https://use.fontawesome.com/b66167c301.js"></script>
</head>
<body>
    @include('partials.page.header')
    <div id="mainContainer">
        <div id="content">
            @yield('content')
        </div>
        @include('partials.page.sidebar')
    </div>
    @include('partials.page.footer')
    @section('footer')
    @show
</body>
</html>
