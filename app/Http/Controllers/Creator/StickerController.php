<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;

use Form;
use DB;
use Auth;
use Goutte;
use Carbon;

class StickerController extends Controller {
    public function getIndex() {
    	$data['rs'] = new Sticker;
		$data['rs'] = $data['rs']->where('user_id',Auth::user()->id)->orderBy('updated_at','desc')->get();
        return view('creator.sticker.index',$data);
    }

    public function getForm(){
		// $sticker_code = 1563388;
		// $crawler = Goutte::request('GET', 'https://store.line.me/stickershop/product/'.$sticker_code.'/th');
		// $image_cover = $crawler->filter('div.mdCMN08Img > img')->attr('src');
		// $head_credit = $crawler->filter('p.mdCMN08Copy > a')->text();
		// $sticker_name = $crawler->filter('h3.mdCMN08Ttl')->text();
		// $sticker_description = $crawler->filter('p.mdCMN08Desc')->text();
		// $sticker_price = $crawler->filter('p.mdCMN08Price')->text();
		// $foot_credit = $crawler->filter('p.mdCMN09Copy')->text();
// 
		// dump($image_cover);
		// dump($head_credit);
		// dump($sticker_name);
		// dump($sticker_description);
		// dump($sticker_price);
		// dump($foot_credit);
// 
		// $image_cover_path = explode("/", $image_cover);
		// $version = str_replace('v','',$image_cover_path[4]);
// 
		// $curlSession = curl_init();
        // curl_setopt($curlSession, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/'.$version.'/'.$sticker_code.'/LINEStorePC/productInfo.meta');
        // curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        // curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        // $jsonData = json_decode(curl_exec($curlSession));
        // curl_close($curlSession);
		// dump($jsonData);

        return view('creator.sticker.form');
    }

    public function postSave(Request $rq, $id = null){

		$sticker_code = $rq->sticker_code;
		$crawler = Goutte::request('GET', 'https://store.line.me/stickershop/product/'.$sticker_code.'/th');
		$image_cover = $crawler->filter('div.mdCMN08Img > img')->attr('src');
		$head_credit = $crawler->filter('p.mdCMN08Copy > a')->text();
		$sticker_name = $crawler->filter('h3.mdCMN08Ttl')->text();
		$sticker_description = $crawler->filter('p.mdCMN08Desc')->text();
		$sticker_price = $crawler->filter('p.mdCMN08Price')->text();
		$foot_credit = $crawler->filter('p.mdCMN09Copy')->text();

		// dump($image_cover);
		// dump($head_credit);
		// dump($sticker_name);
		// dump($sticker_description);
		// dump($sticker_price);
		// dump($foot_credit);

		$image_cover_path = explode("/", $image_cover);
		$version = str_replace('v','',$image_cover_path[4]);

		$curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/'.$version.'/'.$sticker_code.'/LINEStorePC/productInfo.meta');
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        // $jsonData = json_decode(curl_exec($curlSession));
		$result=curl_exec($curlSession);
        curl_close($curlSession);
		$json = json_decode($result, true);
		// dump($jsonData);

		// Save
		$model = $id ? Sticker::find($id) : new Sticker;
		$model->fill(array(
			'id'				=> $model->id,
			'sticker_code'			=> $sticker_code,
			'name'			=> $sticker_name,
			'description'			=> $sticker_description,
			'price'			=> $sticker_price,
			'head_credit'			=> $head_credit,
			'foot_credit'			=> $foot_credit,
			'user_id'			=> Auth::user()->id,
			'status'			=> 1,
			'version'			=> $version,
			'hasanimation'			=> $json['hasAnimation'],
			'hassound'			=> $json['hasSound'],
			'stickerresourcetype'			=> $json['stickerResourceType'],
		));
		$model->save();

		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/sticker/index');
    }

	public function getDelete($id = null) {
		$rs = Sticker::find($id);
	    if($rs->user_id = Auth::user()->id) {
	      $rs->delete(); // Delete process
	      set_notify('error', trans('message.completeDelete'));
	    }else{
	    	set_notify('error', 'ไม่สามารถดำเนินรายการได้');
	    }
	    return Redirect('creator/sticker/index');
	}
	
	// เช็ก sticker ซ้ำใน user เดียวกัน
    public function getAjaxchecksticker(){
      $rs = new Sticker;
      $rs = $rs->where('sticker_code',@$_GET['sticker_code'])->where('user_id',Auth::user()->id)->first();

		if($rs){
	        return 'false';
	    }else{
	    	return 'true';
	    }
	}
	
	public function getUpdate($id = null){
      $rs = Sticker::find($id);
	  
		$sticker_code = $rs->sticker_code;
		$crawler = Goutte::request('GET', 'https://store.line.me/stickershop/product/'.$sticker_code.'/th');
		$image_cover = $crawler->filter('div.mdCMN08Img > img')->attr('src');
		$head_credit = $crawler->filter('p.mdCMN08Copy > a')->text();
		$sticker_name = $crawler->filter('h3.mdCMN08Ttl')->text();
		$sticker_description = $crawler->filter('p.mdCMN08Desc')->text();
		$sticker_price = $crawler->filter('p.mdCMN08Price')->text();
		$foot_credit = $crawler->filter('p.mdCMN09Copy')->text();
		
		// dump($image_cover);
		// dump($head_credit);
		// dump($sticker_name);
		// dump($sticker_description);
		// dump($sticker_price);
		// dump($foot_credit);
		
		$image_cover_path = explode("/", $image_cover);
		$version = str_replace('v','',$image_cover_path[4]);

		$curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/'.$version.'/'.$sticker_code.'/LINEStorePC/productInfo.meta');
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        // $jsonData = json_decode(curl_exec($curlSession));
		$result=curl_exec($curlSession);
        curl_close($curlSession);
		$json = json_decode($result, true);
		// dump($jsonData);

		// Save
		$model = $id ? Sticker::find($id) : new Sticker;
		$model->fill(array(
			'id'				=> $rs->id,
			'sticker_code'			=> $sticker_code,
			'name'			=> $sticker_name,
			'description'			=> $sticker_description,
			'price'			=> $sticker_price,
			'head_credit'			=> $head_credit,
			'foot_credit'			=> $foot_credit,
			'user_id'			=> Auth::user()->id,
			'status'			=> 1,
			'version'			=> $version,
			'hasanimation'			=> @$json['hasAnimation'],
			'hassound'			=> @$json['hasSound'],
			'stickerresourcetype'			=> @$json['stickerResourceType'],
		));
		$model->timestamps = false;
		$model->save();
		
		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/sticker/index');
	}

	function getUp($id = null){
		// check datetime
		$lastUpdate = Sticker::where('user_id',Auth::user()->id)->orderBy('updated_at','desc')->first();
		$update = new Carbon($lastUpdate->updated_at);
		$now = Carbon::now();
		$difference = $update->diffInMinutes($now);
		$wait = 5 - $difference;

		if($difference >= 5){
			$model = Sticker::find($id);
			$model->touch();
			set_notify('success', trans('message.completeSave'));
			return Redirect('creator/sticker/index');
		}else{
			set_notify('error', "ไม่สามารถดำเนินรายการได้ในขณะนี้ โปรดรออีกประมาณ ".$wait." นาที");
			return Redirect('creator/sticker/index');
		}
	}
}
