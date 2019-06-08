<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Emoji;

use DB;
use SEO;
use SEOMeta;
use OpenGraph;

class EmojiController extends Controller {
    public function getIndex() {
		// SEO
		SEO::setTitle('อิโมจิไลน์ยอดนิยม');
		SEO::setDescription('รวมอิโมจิไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

    	$data['emoji'] = new Emoji;
    	$data['emoji'] = $data['emoji']->orderBy('updated_at','desc')->simplePaginate(30);
        return view('emoji.index',$data);
    }
	
	public function getView($id = null){
		$data['rs'] = Emoji::where('id', $id)->firstOrFail();

		// SEO
		SEO::setTitle('อิโมจิไลน์'.$data['rs']->name);
		SEO::setDescription('อิโมจิไลน์'.$data['rs']->description);
		SEO::opengraph()->setUrl(url()->current());
		SEO::addImages('http://shop.line-scdn.net/emojishop/v1/products/'.$data['rs']->emoji_path.'/WEBSTORE/icon_198x278.png');
		SEO::twitter()->setSite('@line2me_th');
		SEOMeta::setKeywords('line, sticker, emoji, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ, อิโมจิ');
		// SEOMeta::addKeyword('line, sticker, emoji, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ, อิโมจิ');
		OpenGraph::addProperty('image:width', '198');
		OpenGraph::addProperty('image:height', '278');
		
    	return view('emoji.view',$data);
	}
}
