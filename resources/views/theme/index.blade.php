@extends('layouts.front')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading col-container">สติ๊กเกอร์</div>

    <div class="panel-body">
        @foreach($theme as $row)
        	<div class="col-xs-6 col-sm-3 col-md-2">
        		<a href="{{ url('theme/'.$row->slug) }}">
            		<div class="box" style="height:210px;">
            		<div><img src="https://shop.line-scdn.net/themeshop/v1/products/{{ $row->theme_path }}/WEBSTORE/icon_136x190.png" width="120"></div>
            		{{ $row->name }}
            		</div>
        		</a>
        	</div>
        @endforeach
        <br clear="all">
    	<div class="clearfix">{{ $theme->appends(@$_GET)->render() }}</div>
    </div>
</div>

@endsection
