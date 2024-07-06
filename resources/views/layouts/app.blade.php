<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('parts.links.metatags')
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    @include('parts.links.links')
</head>
@yield('cssStyle')

<body>
    {{-- navbar --}}
    @include('parts.navbar')
   

    @yield('content')
    @include('parts.footer')
    @yield('jsScript')
    @include('parts.links.scripts')

</body>

</html>
