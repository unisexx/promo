@extends('layouts.nitro')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">สติ๊กเกอร์ไลน์ตาม คำพูด ความรู้สึก : "{{ $tag }}"</h2>

	<div class="animate-box d-flex flex-wrap" data-animate-effect="fadeInLeft">
		@foreach($stamp as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('sticker/'.$row->sticker_code) }}">
				<div class="sticker-image-cover">
					<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
					{!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
				</div>
				<h3 class="fh5co-work-title">{{ $row->name }}</h3>
				<p>{{ $row->price }}</p>
			</a>
		</div>
		@endforeach
		<div class="clearfix visible-md-block"></div>
	</div>
</div>

@endsection