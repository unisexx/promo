<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\Sticker;
use App\Models\Theme;

use DB;
use SEO;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
        // $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');
        SEO::setDescription('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

    	$data['sticker'] = new Sticker;
    	$data['sticker'] = $data['sticker']->orderBy('updated_at','desc')->take(12)->get();
		
		$data['theme'] = new Theme;
    	$data['theme'] = $data['theme']->orderBy('updated_at','desc')->take(12)->get();
        return view('home',$data);
    }

    public function search(){
        $data['sticker'] = new Sticker;
        if(!empty($_GET['q'])){
            $data['sticker'] = $data['sticker']->where('name', 'like', '%'.$_GET['q'].'%')->orWhere('description', 'like', '%'.$_GET['q'].'%');
        }
        $data['sticker'] = $data['sticker']->orderBy('updated_at','desc')->get();

        $data['theme'] = new Theme;
        if(!empty($_GET['q'])){
            $data['theme'] = $data['theme']->where('name', 'like', '%'.$_GET['q'].'%')->orWhere('description', 'like', '%'.$_GET['q'].'%');
        }
        $data['theme'] = $data['theme']->orderBy('updated_at','desc')->get();

        return view('home',$data);
    }
}
