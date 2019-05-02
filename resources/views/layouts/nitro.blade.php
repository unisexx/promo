<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <base href="{{ url('/') }}/"  />
    <!-- Meta & Css -->
    @include('include.nitro.meta')
</head>

<body id="app-layout">
    <div id="fh5co-page">
        <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
        @include('include.nitro.header')
		<div id="fh5co-main">

            @yield('content')
			
		</div>
    </div>
    
    <!-- JavaScripts -->
    @include('include.nitro.js')
</body>
</html>

