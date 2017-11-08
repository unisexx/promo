<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;

use DB;
use SEO;

class StickerController extends Controller {
    public function getIndex() {
		// SEO
		SEO::setTitle('สติ๊กเกอร์ไลน์ยอดนิยม');
		SEO::setDescription('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

    	$data['sticker'] = new Sticker;
    	$data['sticker'] = $data['sticker']->orderBy('updated_at','desc')->paginate(5);
        return view('sticker.index',$data);
    }
	
	public function getView($id = null){
		$data['rs'] = Sticker::find($id);
		
		// SEO
		SEO::setTitle($data['rs']->name.' - สติ๊กเกอร์ไลน์');
		SEO::setDescription($data['rs']->description);

    	return view('sticker.view',$data);
	}
}
