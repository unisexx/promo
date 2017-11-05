<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Theme;

use Form;
use DB;
use Auth;
use Goutte;

class ThemeController extends Controller {
    public function getIndex() {
    	$data['rs'] = new Theme;
    	$data['rs'] = $data['rs']->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('creator.theme.index',$data);
    }

    public function getForm(){
        return view('creator.theme.form');
    }

    public function postSave(Request $rq, $id = null){
    	$theme_code = $rq->theme_code;
		$crawler = Goutte::request('GET', 'https://store.line.me/themeshop/product/'.$theme_code.'/th');
		$head_credit = $crawler->filter('p.mdCMN08Copy > a')->text();
		$theme_name = $crawler->filter('h3.mdCMN08Ttl')->text();
		$theme_description = $crawler->filter('p.mdCMN08Desc')->text();
		$theme_price = $crawler->filter('p.mdCMN08Price')->text();
		$foot_credit = $crawler->filter('p.mdCMN09Copy')->text();
		$image_cover = $crawler->filter('div.mdCMN08Img > img')->attr('src');
		
		$ex = explode("/", $image_cover);
		$theme_path = $ex[6]."/".$ex[7]."/".$ex[8]."/".$ex[9]."/".$ex[10];
		
		// Save
		$model = $id ? Theme::find($id) : new Theme;
		$model->fill(array(
			'id'				=> $model->id,
			'theme_code'			=> $theme_code,
			'name'			=> $theme_name,
			'description'			=> $theme_description,
			'price'			=> $theme_price,
			'head_credit'			=> $head_credit,
			'foot_credit'			=> $foot_credit,
			'user_id'			=> Auth::user()->id,
			'status'			=> 1,
			'theme_path' => $theme_path,
		));
		$model->save();

		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/theme/index');
    }

	public function getDelete($id = null) {
		$rs = Theme::find($id);
	    if($rs->user_id = Auth::user()->id) {
	      $rs->delete(); // Delete process
	      set_notify('error', trans('message.completeDelete'));
	    }else{
	    	set_notify('error', 'ไม่สามารถดำเนินรายการได้');
	    }
	    return Redirect('creator/theme/index');
	}
	
	// เช็ก sticker ซ้ำใน user เดียวกัน
    public function getAjaxchecktheme(){
      $rs = new Theme;
      $rs = $rs->where('theme_code',@$_GET['theme_code'])->where('user_id',Auth::user()->id)->first();

		if($rs){
	        return 'false';
	    }else{
	    	return 'true';
	    }
	}
	
	public function getUpdate($id = null){
		$rs = Theme::find($id);
		
		$theme_code = $rs->theme_code;
		$crawler = Goutte::request('GET', 'https://store.line.me/themeshop/product/'.$theme_code.'/th');
		$head_credit = $crawler->filter('p.mdCMN08Copy > a')->text();
		$theme_name = $crawler->filter('h3.mdCMN08Ttl')->text();
		$theme_description = $crawler->filter('p.mdCMN08Desc')->text();
		$theme_price = $crawler->filter('p.mdCMN08Price')->text();
		$foot_credit = $crawler->filter('p.mdCMN09Copy')->text();
		$image_cover = $crawler->filter('div.mdCMN08Img > img')->attr('src');
		
		$ex = explode("/", $image_cover);
		$theme_path = $ex[6]."/".$ex[7]."/".$ex[8]."/".$ex[9]."/".$ex[10];
		
		// Save
		$model = $id ? Theme::find($id) : new Theme;
		$model->fill(array(
			'id'				=> $model->id,
			'theme_code'			=> $theme_code,
			'name'			=> $theme_name,
			'description'			=> $theme_description,
			'price'			=> $theme_price,
			'head_credit'			=> $head_credit,
			'foot_credit'			=> $foot_credit,
			'user_id'			=> Auth::user()->id,
			'status'			=> 1,
			'theme_path' => $theme_path,
		));
		$model->save();
		
		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/theme/index');
	}
	
}
