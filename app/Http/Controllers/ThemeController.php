<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Theme;

use DB;

class ThemeController extends Controller {
    public function getIndex() {
    	$data['theme'] = new Theme;
    	$data['theme'] = $data['theme']->orderBy('updated_at','desc')->paginate(30);
        return view('theme.index',$data);
    }
	
	public function getView($id = null){
		$data['rs'] = Theme::find($id);
    	return view('theme.view',$data);
	}
}
