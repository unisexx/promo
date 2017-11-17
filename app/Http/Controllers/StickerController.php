<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;

use DB;
use SEO;
use SEOMeta;
use Session;


class StickerController extends Controller {
    public function getIndex() {
		// SEO
		SEO::setTitle('สติ๊กเกอร์ไลน์ยอดนิยม');
		SEO::setDescription('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

    	$data['sticker'] = new Sticker;
    	$data['sticker'] = $data['sticker']->orderBy('updated_at','desc')->paginate(30);
        return view('sticker.index',$data);
    }
	
	public function getView($param = null){
		$data['rs'] = Sticker::where('slug', $param)->firstOrFail();
		
		// tracking
		// $array = @array_merge(Session::get('track_sticker'), array($data['rs']->id));
		// Session::set('track_sticker', $array);
		// dump(array_unique(Session::get('track_sticker')));

		// SEO
		SEO::setTitle($data['rs']->name.' - สติ๊กเกอร์ไลน์');
		SEO::setDescription('สติ๊กเกอร์ไลน์'.$data['rs']->description);
		SEO::opengraph()->setUrl(url()->current());
		SEO::addImages('https://sdl-stickershop.line.naver.jp/products/0/0/'.$data['rs']->version.'/'.$data['rs']->sticker_code.'/LINEStorePC/main@2x.png');
		SEO::twitter()->setSite('@line2me_th');
		SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');

    	return view('sticker.view',$data);
	}
}
