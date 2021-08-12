<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 Page Not Found</title>

  <link href="{{ url('css/404.css') }}" media="all" rel="stylesheet" type="text/css">

  <link rel="shortcut icon" type="image/x-icon" href="">

</head>

<body>
  <header class="page-container page-container-responsive space-top-5 ">
    <a href="/" class="h2">
        Company Name
    </a>
  </header>

  <div class="page-container page-container-responsive">
    <div class="row space-top-8 space-8 row-table">
        <div class="col-5 col-middle">
          <h1 class="text-jumbo text-ginormous">Oops!</h1>
          <h2>We can't seem to find the page you're looking for.</h2>
          <h6>Error code: 404</h6>
          <ul class="list-unstyled">
            <li>Here are some helpful links instead:</li>
            <li><a href="{{ url('/') }}">Home</a></li>
          </ul>
        </div>
        <div class="col-5 col-middle text-center">
          <img src="{{ url('images/404.gif') }}" width="313" height="428" alt="Girl has dropped her ice cream.">
        </div>
      </div>
    </div>
  </div>
</body>
</html>
