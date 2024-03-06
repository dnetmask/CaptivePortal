<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('cautiveportal::partials.head')
</head>
<body>

    @include('cautiveportal::partials.header')

    <div class="page-content-wrapper">
        @yield('content')
    </div>

    @include('cautiveportal::partials.footer')

    @include('cautiveportal::partials.footer-scripts')
</body>
</html>