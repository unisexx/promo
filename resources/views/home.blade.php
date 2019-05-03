@extends('layouts.nitro') @section('content')

<div class="fh5co-narrow-content">
	<div id="demo" class="carousel slide" data-ride="carousel" style="max-width:945px;">

	<!-- Indicators -->
	<ul class="carousel-indicators">
		<li data-target="#demo" data-slide-to="0" class="active"></li>
		<li data-target="#demo" data-slide-to="1"></li>
		<li data-target="#demo" data-slide-to="2"></li>
	</ul>
	
	<!-- The slideshow -->
	<div class="carousel-inner">
		<div class="carousel-item active">
		<img class="img-fluid" src="https://i.imgur.com/ViYBUDf.jpg" alt="linepop.in.th">
		</div>
		<div class="carousel-item">
		<img class="img-fluid" src="https://i.imgur.com/oSc61sH.jpg" alt="linepop.in.th">
		</div>
		<div class="carousel-item">
		<img class="img-fluid" src="https://i.imgur.com/zzlfeSW.jpg" alt="linepop.in.th">
		</div>
	</div>
	
	<!-- Left and right controls -->
	<a class="carousel-control-prev" href="#demo" data-slide="prev">
		<span class="carousel-control-prev-icon"></span>
	</a>
	<a class="carousel-control-next" href="#demo" data-slide="next">
		<span class="carousel-control-next-icon"></span>
	</a>
	</div>
</div>



<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ครีเอเตอร์</h2>
		<p class="text-right read-more-text"><a href="{{ url('sticker') }}">ดูทั้งหมด ></a></p>
	</div>
		<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
			@foreach($sticker as $row)
			<div class="work-item text-center">
				{!! new_icon($row->created_at) !!}
				<a href="{{ url('sticker/'.$row->sticker_code) }}">
					<div class="sticker-image-cover">
						<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->name }}" class="img-fluid">
						{!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
					</div>
					<h3 class="fh5co-work-title">{{ $row->name }}</h3>
					<p>{{ ucfirst($row->country) }}, {{ $row->price }}</p>
				</a>
			</div>
			@endforeach
		</div>
</div>



<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์ครีเอเตอร์</h2>
		<p class="text-right read-more-text"><a href="{{ url('theme') }}">ดูทั้งหมด ></a></p>
	</div>
		<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
			@foreach($theme as $row)
			<div class="work-item text-center">
				{!! new_icon($row->created_at) !!}
				<a href="{{ url('theme/'.$row->id) }}">
					<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->name }}" class="img-fluid">
					<h3 class="fh5co-work-title">{{ $row->name }}</h3>
					<p>{{ $row->price }} บาท</p>
				</a>
			</div>
			@endforeach
		</div>
</div>


<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์ครีเอเตอร์</h2>
		<p class="text-right read-more-text"><a href="{{ url('theme') }}">ดูทั้งหมด ></a></p>
	</div>
		<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
			@foreach($emoji as $row)
			<div class="work-item text-center">
				{!! new_icon($row->created_at) !!}
				<a href="{{ url('emoji/'.$row->id) }}">
					<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->title }}" class="img-fluid">
					<h3 class="fh5co-work-title">{{ $row->title }}</h3>
					<p>{{ $row->price }} บาท</p>
				</a>
			</div>
			@endforeach
		</div>
</div>

@endsection