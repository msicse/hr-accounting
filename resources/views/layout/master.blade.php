<!DOCTYPE html>
<html lang="en">
    @include('partials._head')
    <body> 
        @yield('content')
            @include('partials._footer')
        @include('partials._scripts')
        @yield('scripts')
    </body>
</html>