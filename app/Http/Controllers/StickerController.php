<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;

use DB;

class StickerController extends Controller {
    public function getIndex() {
    	$data['sticker'] = new Sticker;
    	$data['sticker'] = $data['sticker']->orderBy('updated_at','desc')->paginate(5);
        return view('sticker.index',$data);
    }
	
	public function getView($id = null){
		$data['rs'] = Sticker::find($id);
    	return view('sticker.view',$data);
	}
}
