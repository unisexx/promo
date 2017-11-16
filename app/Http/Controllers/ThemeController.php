<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Theme;

use DB;
use SEO;
use SEOMeta;

class ThemeController extends Controller {
    public function getIndex() {
		// SEO
		SEO::setTitle('ธีมไลน์ยอดนิยม');
		SEO::setDescription('รวมธีมไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

    	$data['theme'] = new Theme;
    	$data['theme'] = $data['theme']->orderBy('updated_at','desc')->paginate(30);
        return view('theme.index',$data);
    }
	
	public function getView($param = null){
		$data['rs'] = Theme::where('slug', $param)->firstOrFail();

		// ธีมอื่นๆของ user นี้
		$data['other'] = new Theme;
		$data['other'] = $data['other']->whereNotIn('id',[$data['rs']->id])->inRandomOrder()->take(10)->get();

		// SEO
		SEO::setTitle($data['rs']->name.' - ธีมไลน์');
		SEO::setDescription('ธีมไลน์'.$data['rs']->description);
		SEO::opengraph()->setUrl(url()->current());
		SEO::addImages('https://shop.line-scdn.net/themeshop/v1/products/'.$data['rs']->theme_path.'/WEBSTORE/icon_198x278.png');
		SEO::twitter()->setSite('@line2me_th');
		SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		
    	return view('theme.view',$data);
	}
}
