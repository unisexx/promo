@extends('layouts.front_view')

@section('content')
<div class="col-xs-5 col-sm-5 col-md-4">
	<img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/main@2x.png;compress=true" style="margin-right: 15px;">
</div>

<div class="col-xs-7 col-sm-7 col-md-8">
	<small>{{ $rs->head_credit }}</small>
	<h1>{{ $rs->name }}</h2>
	<p>{{ $rs->description }}</p>
	<p class="price">{{ $rs->price }}</p>
</div>

<br clear="all">
<hr>
<img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->name }}">
	
@endsection

@section('sidebar')

	<h2 class="h2sidebar text-center bg-black">สติ๊กเกอร์ชุดอื่นๆ</h2>

	@foreach($other as $row)
		<div class="media mediablk col-md-12 col-xs-6">
		<a href="{{ url('sticker/'.$row->slug) }}">
		<div class="media-left media-top">
			<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/thumbnail.png" width="40" height="40">
		</div>
		<div class="media-body">
			<h3 class="media-heading h3sidebar">{{ $row->name }}</h3>
		</div>
		</a>
		</div>
	@endforeach

@endsection
