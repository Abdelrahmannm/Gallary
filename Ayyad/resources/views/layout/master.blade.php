<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <title>@yield('title', 'Unknown page')</title>
</head>

<body>
    {{-- start navbar --}}
    @include('layout.navbar')
    {{-- end navbar --}}
    @yield('content', 'no content')

    @include('layout.sidebar')
</body>

</html>
