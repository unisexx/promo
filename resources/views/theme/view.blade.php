@extends('layouts.front_view')

@section('content')
<div class="col-xs-5 col-sm-5 col-md-4">
	<img class="img-responsive" src="https://shop.line-scdn.net/themeshop/v1/products/{{ $rs->theme_path }}/WEBSTORE/icon_198x278.png" style="margin-right: 15px;">
</div>

<div class="col-xs-6 col-sm-6 col-md-8">
	<small>{{ $rs->head_credit }}</small>
	<h1>{{ $rs->name }}</h2>
	<p>{{ $rs->description }}</p>
	<p class="price">{{ $rs->price }}</p>
</div>

<br clear="all">
<hr>

@for ($i = 1; $i <= 5; $i++)
<div class="col-xs-12 col-sm-6 col-md-4" style="margin-bottom: 10px;">
    <img class="img-responsive" src="https://shop.line-scdn.net/themeshop/v1/products/{{ $rs->theme_path }}/ANDROID/th/preview_00{{$i}}_720x1232.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->name }}">
</div>
@endfor
<br clear="all">

@endsection


@section('sidebar')

	<h2 class="h2sidebar text-center bg-black">ธีมชุดอื่นๆ</h2>

	@foreach($other as $row)
		<div class="media mediablk col-md-12 col-xs-6">
		<a href="{{ url('theme/'.$row->slug) }}">
		<div class="media-left media-top">
			<img src="https://shop.line-scdn.net/themeshop/v1/products/{{ $row->theme_path }}/WEBSTORE/icon_136x190.png" width="60" height="84">
		</div>
		<div class="media-body">
			<h3 class="media-heading h3sidebar">{{ $row->name }}</h3>
		</div>
		</a>
		</div>
	@endforeach

@endsection