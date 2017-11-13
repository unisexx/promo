<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
{!! SEO::generate() !!}

{{--
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
--}}
{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/dist/css/skins/skin-blue.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<style>
    /* mobile */
    @media screen and (max-width: 568px){
        body{font-size: 12px !important;}
        h1{font-size:18px; font-weight:bold; margin:3px 0; line-height:18px;}
        p.price{font-size:14px !important; font-weight:bold !important;}

        .carousel-indicators {bottom: -10px !important;}
    }

    /* Small devices (tablets, 768px and up) */
    @media screen and (max-width: 768px){}

    /* Medium devices (desktops, 992px and up) */
    @media screen and (min-width: 992px){
    }

    /* Large devices (large desktops, 1200px and up) */
    @media screen and (min-width: 1200px){
    }

    body {
        font-size: 11pt;
        line-height: 140%;
        font-family: 'Helvetica Neue', Helvetica, arial, sans-serif;
    }
    .fa-btn {
        margin-right: 6px;
    }
    a{color:#737373;}
    a:hover{color: #cc6600; text-decoration: underline;}
    a:hover img {
        opacity: 0.8;
        filter: alpha(opacity=80);
        -ms-filter: "alpha( opacity=80 )";
    }
    p.price{font-size: 32px; color: #00b84f;}
    .mediablk{margin-top:5px; border-bottom:1px dashed #ddd; padding-bottom:5px;}
    .mediablk .panel{margin-bottom:0px;}
    .mediablk .panel-body h2{text-align:left;}
    .h2sidebar{font-size:10pt; line-height: 1.2; padding:10px; margin-top:0px; font-weight:bold;}
    .h3sidebar{font-size:10pt; line-height: 1.2;}
    .table > thead > tr > th, .table > thead > tr > td {
        border: 0;
    }
    .carousel-indicators {bottom: 0px;}
    .foter {
        margin: 20px 0px 0px 0px;
        text-align: center;
        font-size: 10pt;
        line-height: 160%;
        background: #eeeeee;
        /* border-bottom: 1px solid #888888; */
        /* border-right: 1px solid #888888; */
        padding: 4px 10px 2px 10px;
    }
    
    {{-- flex-box --}}
    .panel-body h2 {
		text-align: center;
		line-height: 1.4;
    	height: 38px;
		font-size: 14px;
		overflow: hidden;
		text-overflow: ellipsis;
		display: block;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		margin-top:10px;
	}

	/* not requied only for demo * */
	.row [class*='col-'] {
	background-colo: #cceeee;
	background-clip: content-box;
	}
	.panel {
		height: 100%;
		border: none !important;
		box-shadow: none !important;
	}
    .panel-body{padding:0px !important;}
</style>