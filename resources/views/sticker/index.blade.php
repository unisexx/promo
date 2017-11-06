@extends('layouts.front')

@section('content')

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
        <br clear="all">
    	<div class="clearfix">{{ $sticker->appends(@$_GET)->render() }}</div>
    </div>
</div>

@endsection
