@extends('layouts.nitro')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex animate-box" data-animate-effect="fadeInLeft">

		<div class="sticker-image-cover">
			<img class="img-fluid" src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $rs->title }}">
		</div>

		<div class="sticker-infomation">
			<h3>{{ $rs->name }}</h3>
			<ul>
				<li>ราคา : {{ $rs->price }} บาท</li>
				<li>ประเภท : ครีเอเตอร์</li>
			</ul>
		</div>
		 
	</div>

	<!-- ปุ่มสั่งซื้อ -->
	<div class="text-center animate-box" data-animate-effect="fadeInLeft">
		<hr>
			<a href="https://line.me/ti/p/~ratasak1234" target="_blank"><button type="button" class="btn btn-success btn-block">สั่งซื้อธีมไลน์ชุดนี้คลิก</button></a>
		<hr>
	</div>
	<!-- ปุ่มสั่งซื้อ -->

	@if($rs->description) <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->description }}</p> @endif

	<div class="d-flex flex-xl-wrap flex-lg-nowrap animate-box theme-image-detail-wrap" data-animate-effect="fadeInLeft">
		@for($x = 1; $x <= 5; $x++)
			<img class="align-self-baseline theme-image-detail" src="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_00{{ $x }}_720x1232.png" alt="ธีมไลน์ {{ $rs->title }}">
		@endfor
	</div>

	<!-- Social Share -->
	<hr>
	<ul class="list-inline">
		<li class="list-inline-item">
			แชร์ลิ้งค์ : 
		</li>
		<li class="list-inline-item">
			<a href="https://social-plugins.line.me/lineit/share?url={{ Request::url() }}" target="_blank"><i class="fab fa-2x fa-line"></i></a>
		</li>
		<li class="list-inline-item">
			<a href="https://twitter.com/home?status={{ Request::url() }}" target="_blank"><i class="fab fa-2x fa-twitter"></i></a>
		</li>
		<li class="list-inline-item">
			<a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" target="_blank"><i class="fab fa-2x fa-facebook-square"></i></a>
		</li>
		<li class="list-inline-item">
			<a href="https://line.me/S/shop/theme/detail?id={{ $rs->theme_code }}" target="_blank"><i class="fas fa-2x fa-share"></i></a>
		</li>
	</ul>
	<!-- Social Share -->
		
</div>

@endsection