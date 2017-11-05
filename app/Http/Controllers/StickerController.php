<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;

use DB;

class StickerController extends Controller {
    public function getIndex() {
    	$data['rs'] = new Sticker;
    	$data['rs'] = $data['rs']->orderBy('id','desc')->get();
        return view('sticker.index',$data);
    }
}
