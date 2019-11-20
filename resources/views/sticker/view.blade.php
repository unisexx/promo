@extends('layouts.nitro')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex animate-box" data-animate-effect="fadeInLeft">

		<div class="sticker-image-cover">
			<img class="img-fluid playAnimate" src="{{ get_sticker_img_url($rs->stickerresourcetype,$rs->version,$rs->sticker_code) }}" alt="สติ๊กเกอร์ไลน์ {{ $rs->name }}" data-animation="{{ get_sticker_img_url($rs->stickerresourcetype,$rs->version,$rs->sticker_code) }}">
			<audio id="mainAudio" class="d-none" controls autoplay preload="metadata">
				<source src="https://sdl-stickershop.line.naver.jp/stickershop/v1/product/{{ $rs->sticker_code }}/IOS/main_sound.m4a" type="audio/mpeg">
			</audio>
		</div>

		<div class="sticker-infomation">
			<h3>{{ $rs->name }} {!! getStickerResourctTypeName($rs->stickerresourcetype) !!}</h3>
			<ul>
				<li>ราคา : {{ $rs->price }}</li>
				<li>ประเภท : ครีเอเตอร์</li>
			</ul>
		</div>
		
	</div>

	<!-- ปุ่มสั่งซื้อ -->
	<div class="text-center animate-box" data-animate-effect="fadeInLeft">
		<hr>
			<a href="https://line.me/ti/p/~ratasak1234" target="_blank"><button type="button" class="btn btn-success btn-block">สั่งซื้อสติ๊กเกอร์ไลน์ชุดนี้คลิก</button></a>
		<hr>
	</div>
	<!-- ปุ่มสั่งซื้อ -->

	@if($rs->description) 
		<p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->description }}</p>
	@endif
	<p class="animate-box" data-animate-effect="fadeInLeft"><small>*** โปรดแตะที่ตัวสติ๊กเกอร์เพื่อดูตัวอย่าง หรือฟังเสียง (ถ้าเป็นสติ๊กเกอร์แบบมีเสียง) ***</small></p> 

	<div class="animate-box" data-animate-effect="fadeInLeft">
		@if(count($rs->stamp) == 0)

			<img class="img-fluid" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">

		@else

			<ul class="list-inline">
				@foreach($rs->stamp()->get() as $key=>$row)
				@php
					if($rs->stickerresourcetype == 'SOUND' || $rs->stickerresourcetype == 'STATIC' || $rs->stickerresourcetype == 'NAME_TEXT'){
						$data_animation = "https://stickershop.line-scdn.net/stickershop/v1/sticker/".$row->stamp_code."/android/sticker.png;compress=true";
					}elseif($rs->stickerresourcetype == 'POPUP' || $rs->stickerresourcetype == 'POPUP_SOUND'){
						$data_animation = "https://stickershop.line-scdn.net/stickershop/v1/sticker/".$row->stamp_code."/IOS/sticker_popup.png;compress=true";
					}
					else{
						$data_animation = "https://stickershop.line-scdn.net/stickershop/v1/sticker/".$row->stamp_code."/IOS/sticker_animation@2x.png;compress=true";
					}
				@endphp
					<li class="sticker-stamp-list">
						<img class="sticker-stamp playAnimate" src="https://stickershop.line-scdn.net/stickershop/v1/sticker/{{ $row->stamp_code }}/android/sticker.png;compress=true" data-animation="{{ $data_animation }}">
						<audio preload="metadata">
							<source src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $row->stamp_code }}.m4a" type="audio/mpeg">
						</audio>
						{{-- @if($row->tag != "")
							@php
								$tags = explode(',',$row->tag);
							@endphp
							<div class="tag small">
								@php
									$myArray = "";
									foreach($tags as $key){
										$myArray[] = '<a href="'.url('tag/'.trim($key)).'">'.trim($key).'</a>';
									}
									echo str_replace(',',' |',implode( ', ', $myArray ));
								@endphp
							</div>
						@endif --}}
					</li>
				@endforeach
			</ul>

		@endif
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
			<a href="https://line.me/S/sticker/{{ $rs->sticker_code }}" target="_blank"><i class="fas fa-2x fa-share"></i></a>
		</li>
	</ul>
	<!-- Social Share -->
		
</div>
@endsection
