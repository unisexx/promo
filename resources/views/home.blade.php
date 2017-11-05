@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading col-container">สติ๊กเกอร์</div>

                <div class="panel-body">
                    @foreach($sticker as $row)
                    	<div class="col-xs-6 col-sm-3 col-md-2">
                    		<a href="#">
	                    		<div class="box" style="height:180px;">
	                    		<div><img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" width="120"></div>
	                    		{{ $row->name }}
	                    		</div>
                    		</a>
                    	</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">ธีม</div>

                <div class="panel-body">
                    @foreach($theme as $row)
                    	<div class="col-xs-6 col-sm-3 col-md-2">
                    		<a href="#">
	                    		<div class="box" style="height:210px;">
	                    		<div><img src="https://shop.line-scdn.net/themeshop/v1/products/{{ $row->theme_path }}/WEBSTORE/icon_136x190.png" width="120"></div>
	                    		{{ $row->name }}
	                    		</div>
                    		</a>
                    	</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
