@extends('layouts.nitro') @section('content')
<div class="fh5co-narrow-content">
	<div class="row">
		<div class="col-md-12">
			<h2 class="fh5co-heading animate-box aboutus-heading" data-animate-effect="fadeInLeft">{{ $rs->title }}</h2>
            <p>{!! $rs->description !!}</p>
		</div>
	</div>
</div>
@endsection