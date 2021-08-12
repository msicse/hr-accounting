<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title> @yield('title') </title>

  <!-- Vendor CSS -->
   <link href="{{ url("vendors/bower_components/fullcalendar/dist/fullcalendar.min.css") }}" rel="stylesheet">
   <link href="{{ url("vendors/bower_components/animate.css/animate.min.css") }}" rel="stylesheet">
   <link href="{{ url("vendors/bower_components/sweetalert/dist/sweetalert.css") }}" rel="stylesheet">
   <link href="{{ url("vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css")}}" rel="stylesheet">
   <link href="{{ url("vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css") }}" rel="stylesheet">
   <link href="{{ url("vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css") }}" rel="stylesheet">

          <!-- FONT-awsem -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
          <!-- CSS -->
   <link href="{{url("css/app_1.min.css")}}" rel="stylesheet">
   <link href="{{url("css/app_2.min.css")}}" rel="stylesheet">
   <link href="{{url("css/custom-style.css")}}" rel="stylesheet">
   <link rel="stylesheet" href="{{ url("css/bootstrap-tagsinput.css") }}" >
   @yield('styles') 
</head>