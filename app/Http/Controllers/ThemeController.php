<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Theme;

use DB;
use SEO;

class ThemeController extends Controller {
    public function getIndex() {
		// SEO
		SEO::setTitle('ธีมไลน์ยอดนิยม');
		SEO::setDescription('รวมธีมไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

    	$data['theme'] = new Theme;
    	$data['theme'] = $data['theme']->orderBy('updated_at','desc')->paginate(30);
        return view('theme.index',$data);
    }
	
	public function getView($id = null){
		$data['rs'] = Theme::find($id);

		// SEO
		SEO::setTitle($data['rs']->name.' - ธีมไลน์');
		SEO::setDescription($data['rs']->description);
		
    	return view('theme.view',$data);
	}
}
