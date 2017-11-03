<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;

use Form;
use DB;
use Goutte;

class StickerController extends Controller {
    public function getIndex() {
        return view('creator.sticker.index');
    }

    public function getForm(){
		$sticker_code = 1563388;
		$crawler = Goutte::request('GET', 'https://store.line.me/stickershop/product/'.$sticker_code.'/th');
		$image_cover = $crawler->filter('div.mdCMN08Img > img')->attr('src');
		$head_credit = $crawler->filter('p.mdCMN08Copy > a')->text();
		$sticker_name = $crawler->filter('h3.mdCMN08Ttl')->text();
		$sticker_description = $crawler->filter('p.mdCMN08Desc')->text();
		$sticker_price = $crawler->filter('p.mdCMN08Price')->text();
		$foot_credit = $crawler->filter('p.mdCMN09Copy')->text();

		dump($image_cover);
		dump($head_credit);
		dump($sticker_name);
		dump($sticker_description);
		dump($sticker_price);
		dump($foot_credit);

		$image_cover_path = explode("/", $image_cover);
		$version = str_replace('v','',$image_cover_path[4]);

		$curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/'.$version.'/'.$sticker_code.'/LINEStorePC/productInfo.meta');
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);
		dump($jsonData);

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

		dump($image_cover);
		dump($head_credit);
		dump($sticker_name);
		dump($sticker_description);
		dump($sticker_price);
		dump($foot_credit);

		$image_cover_path = explode("/", $image_cover);
		$version = str_replace('v','',$image_cover_path[4]);

		$curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/'.$version.'/'.$sticker_code.'/LINEStorePC/productInfo.meta');
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);
		dump($jsonData);

		// Save
		$model = $id ? Sticker::find($id) : new Sticker;
		$model->fill(array(
			'ticket_results_id' => $model->id,
			'helps_id'          => $i,
			'helps_fill'        => empty($rq->help_fill[$i])?null: $rq->help_fill[$i],
		));
		$model->save();

		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/sticker/index');
    }
}
