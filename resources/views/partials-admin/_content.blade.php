	<div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('message') !!}</em></div>
        @endif
        
        @if(Session::has('error-message'))
            <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span><em> {!! session('error-message') !!}</em></div>
        @endif
        <div class="block-header">
            <h2>  @yield('contentHeading') </h2>

            <div class="card">
				<div class="card-body">
					@yield('contentBody')
				
				
            </div>
            </div>
        </div>
					
    </div>