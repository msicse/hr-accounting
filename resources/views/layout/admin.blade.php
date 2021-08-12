<!DOCTYPE html>
<html>
    @include ('partials-admin._head')
    <body class="myClassBody">

    @include ('partials-admin._header')
		<section id="main">
        @if(Auth::check())
    @include ('partials-admin._sidebar')
			<section id="content">
                @include ('partials-admin._content')
			</section>
        </section>
    @else
    <div class="col-md-4 col-md-offset-4">
         <h1>please Login first <small> <a href="{{route('user.login')}}">Click to Login</a> </small> </h1>

    </div>
       
    @endif

		 @include ('partials-admin._footer')

        <!-- Page Loader -->
        <div class="page-loader">
            <div class="preloader pls-blue">
                <svg class="pl-circular" viewBox="25 25 50 50">
                    <circle class="plc-path" cx="50" cy="50" r="20" />
                </svg>

                <p>Please wait...</p>
            </div>
        </div>
        <!-- Javascript Libraries -->
         @include ('partials-admin._scripts')
         @yield('scripts')
    </body>
</html>
		
		
		
		