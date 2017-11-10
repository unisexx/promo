<!DOCTYPE html>

<html lang="en">

<head>

	<base href="{{ url('/') }}/"  />

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

	{!! SEO::generate() !!}

    <!-- Fonts -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">



    <!-- Styles -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}



    <style>

        body {

        	font-size: 11pt;

    		line-height: 140%;

            font-family: 'Helvetica Neue', Helvetica, arial, sans-serif;

        }



        .fa-btn {

            margin-right: 6px;

        }

        

       a{color:#0000de;}

       a:hover{color: #cc6600; text-decoration: underline;}

       a:hover img {

		    opacity: 0.8;

		    filter: alpha(opacity=80);

		    -ms-filter: "alpha( opacity=80 )";

		}

    </style>

</head>

<body id="app-layout">

    <!-- Header -->

	@include('include.front.header')

    

    <div class="container">

    	<div class="row">

    		

    		<div class="col-6 col-md-2 sidebar-offcanvas" id="sidebar">

                @include('include.front.sidebar')

        	</div>

        	

        	<div class="col-md-7" style="border-right: 1px solid #eee; border-left: 1px solid #eee;">

    			@yield('content')

    		</div>

            <div class="col-6 col-md-2 sidebar-offcanvas" id="sidebar">

                @include('include.front.right_sidebar')

        	</div>

    			

        </div>

	</div>

	

	<!-- Main Footer -->

  	{{--  @include('include.front.footer') --}}



    <!-- JavaScripts -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>



    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    

</body>

</html>

