@extends('layouts.front')

@section('content')

<div class="row">
<div class="col-md-12">
	<div class="box box-default">
		<div class="box-header with-border">
		<h3 class="box-title">สติ๊กเกอร์</h3>
		<!-- /.box-tools -->
		</div>
		<!-- /.box-header -->
		<div class="box-body">
		@foreach($sticker as $row)
			<div class="col-xs-4 col-sm-3 col-md-2">
				<a href="{{ url('sticker/'.$row->slug) }}">
					<div><img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png"></div>
					{{ $row->name }}
				</a>
			</div>
		@endforeach
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
</div>

@endsection
