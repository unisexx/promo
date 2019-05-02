<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Emoji;

use Form;
use DB;
use Auth;
use Goutte;
use Carbon;

class EmojiController extends Controller {
    public function getIndex() {
    	$data['rs'] = new Emoji;
		$data['rs'] = $data['rs']->where('user_id',Auth::user()->id)->orderBy('updated_at','desc')->get();
        return view('creator.emoji.index',$data);
    }

    public function getForm(){
        return view('creator.emoji.form');
    }

    public function postSave(Request $rq, $id = null){

		$this->validate($rq,[
			'emoji_code' => 'required|unique:emojis'
		],[
			'emoji_code.required' => ' ห้ามเป็นค่าว่าง',
			'emoji_code.unique'   => ' หมายเลขไอดีของธีมนี้มีในระบบแล้ว ถ้าธีมชุดนี้เป็นของคุณ <a href="'.url('creator/page/view/8').'">คลิกที่นี่</a>'
		]);

    	$emoji_code = $rq->emoji_code;
		$crawler = Goutte::request('GET', 'https://store.line.me/emojishop/product/'.$emoji_code.'/th');
		
		$title = trim($crawler->filter('h3.mdCMN08Ttl')->text());
		$creator_name = trim($crawler->filter('p.mdCMN08Copy')->text());
		$detail = trim($crawler->filter('p.mdCMN08Desc')->text());
		$country = "global";
		$price = substr(trim($crawler->filter('p.mdCMN08Price')->text()),0,-3);

		// insert ลง db
		DB::table('emojis')->insert(
			[
				'emoji_code'   => $emoji_code,
				'title'        => $title,
				'detail'       => $detail,
				'creator_name' => $creator_name,
				'created_at'   => date("Y-m-d H:i:s"),
				'category'     => 'creator',
				'country'      => 'thai',
				'price'        => $price,
				'status'       => 'approve',
				'user_id'      => Auth::user()->id,
			]
		);

		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/emoji/index');
    }

	public function getDelete($id = null) {
		$rs = Emoji::find($id);
	    if($rs->user_id = Auth::user()->id) {
	      $rs->delete(); // Delete process
	      set_notify('error', trans('message.completeDelete'));
	    }else{
	    	set_notify('error', 'ไม่สามารถดำเนินรายการได้');
	    }
	    return Redirect('creator/emoji/index');
	}
	
	// เช็ก sticker ซ้ำใน user เดียวกัน
    public function getAjaxcheckemoji(){
      $rs = new Emoji;
      $rs = $rs->where('emoji_code',@$_GET['emoji_code'])->where('user_id',Auth::user()->id)->first();

		if($rs){
	        return 'false';
	    }else{
	    	return 'true';
	    }
	}
	
	public function getUpdate($id = null){
		$rs = Emoji::find($id);
		
		$emoji_code = $rs->emoji_code;
		$crawler = Goutte::request('GET', 'https://store.line.me/emojishop/product/'.$emoji_code.'/th');
		$title = trim($crawler->filter('h3.mdCMN08Ttl')->text());
		$creator_name = trim($crawler->filter('p.mdCMN08Copy')->text());
		$detail = trim($crawler->filter('p.mdCMN08Desc')->text());
		$country = "global";
		$price = substr(trim($crawler->filter('p.mdCMN08Price')->text()),0,-3);
		
		// Save
		$model = $id ? Emoji::find($id) : new Emoji;
		$model->fill(array(
			'id'          => $model->id,
			'emoji_code'   => $emoji_code,
			'title'        => $title,
			'detail'       => $detail,
			'creator_name' => $creator_name,
			'created_at'   => date("Y-m-d H:i:s"),
			'category'     => 'creator',
			'country'      => 'thai',
			'price'        => $price,
			'status'       => 'approve',
			'user_id'      => Auth::user()->id,
		));
		$model->timestamps = false;
		$model->save();
		
		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/emoji/index');
	}

	function getUp($id = null){
		// check datetime
		$lastUpdate = Emoji::where('user_id',Auth::user()->id)->orderBy('updated_at','desc')->first();
		$update = new Carbon($lastUpdate->updated_at);
		$now = Carbon::now();
		$difference = $update->diffInMinutes($now);
		$wait = 5 - $difference;

		if($difference >= 5){
			$model = Emoji::find($id);
			$model->touch();
			set_notify('success', trans('message.completeSave'));
			return Redirect('creator/emoji/index');
		}else{
			set_notify('error', "ไม่สามารถดำเนินรายการได้ในขณะนี้ โปรดรออีกประมาณ ".$wait." นาที");
			return Redirect('creator/emoji/index');
		}
	}
	
}
