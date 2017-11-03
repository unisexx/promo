<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;

use Form;
use DB;
use Auth;

class DashboardController extends Controller {
    public function getIndex() {
    	$data['sticker_count'] = Sticker::where('user_id',Auth::user()->id)->count();
        return view('creator.dashboard.index',$data);
    }
}
