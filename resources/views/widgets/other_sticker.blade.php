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