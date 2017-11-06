@extends('layouts.front')

@section('content')
<div class="col-xs-5 col-sm-5 col-md-4">
	<img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/main@2x.png;compress=true" style="margin-right: 15px;">
</div>

<div class="col-xs-6 col-sm-6 col-md-4">
	<small>{{ $rs->head_credit }}</small>
	<h1>{{ $rs->name }}</h2>
	<p>{{ $rs->description }}</p>
	<p>{{ $rs->price }}</p>
</div>

<br clear="all">
<hr>
<img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->name }}">
	
@endsection
