<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Form;
use DB;

class StickerController extends Controller {
    public function getIndex() {
        return view('creator.sticker.index');
    }
}
