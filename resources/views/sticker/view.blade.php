@extends('layouts.front_view')

@section('content')
<div class="col-xs-5 col-sm-5 col-md-5 img-cover">
	<img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/main@2x.png;compress=true">
	@if($rs->stickerresourcetype == 'ANIMATION')
		<span class="MdIcoPlay_b">Animation only icon</span>
	@endif
</div>

<div class="col-xs-7 col-sm-7 col-md-7">
	<small>{{ $rs->head_credit }}</small>
	<h1>{{ $rs->name }}</h2>
	<p>{{ $rs->description }}</p>
	<p class="price">{{ $rs->price }}</p>
</div>

<br clear="all">
<hr>
<img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->name }}">
@endsection
