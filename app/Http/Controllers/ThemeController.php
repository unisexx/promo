<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Theme;

use DB;

class ThemeController extends Controller {
    public function getIndex() {
    	$data['rs'] = new Theme;
    	$data['rs'] = $data['rs']->orderBy('id','desc')->get();
        return view('theme.index',$data);
    }
}
