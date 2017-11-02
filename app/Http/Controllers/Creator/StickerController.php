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

    public function getForm(){
        $sticker_code = 1433464;
        // $url = "https://store.line.me/stickershop/product/".$sticker_code."/th";
		// $html = file_get_html($url);

		// $image = trim($html->find('div.mdCMN08Img > img',0)->src);
		// $image = explode("/", $image);
		// $data['version'] = str_replace('v','',$image[4]);

		// update productInfo
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,'https://store.line.me/stickershop/product/5876/th');
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		$json = json_decode($result, true);
        
        var_dump($result);



        // $curlSession = curl_init();
        // curl_setopt($curlSession, CURLOPT_URL, 'https://chart.googleapis.com/chart?cht=p3&chs=250x100&chd=t:60,40&chl=Hello|World&chof=json');
        // curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        // curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
    
        // $jsonData = json_decode(curl_exec($curlSession));
        // curl_close($curlSession);

        // var_dump($jsonData);
        
        return view('creator.sticker.form');
    }

    // public function postSave(){

    //     $sticker_code = 8756;
    //     $url = "https://store.line.me/stickershop/product/".$sticker_code."/th";
	// 	$html = file_get_html($url);

	// 	$image = trim($html->find('div.mdCMN08Img > img',0)->src);
	// 	$image = explode("/", $image);
	// 	$data['version'] = str_replace('v','',$image[4]);

	// 	// update productInfo
	// 	//  Initiate curl
	// 	$ch = curl_init();
	// 	// Disable SSL verification
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// 	// Will return the response, if false it print the response
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	// Set the url
	// 	curl_setopt($ch, CURLOPT_URL,'http://dl.stickershop.line.naver.jp/products/0/0/'.$data['version'].'/'.$sticker_code.'/LINEStorePC/productInfo.meta');
	// 	// Execute
	// 	$result=curl_exec($ch);
	// 	// Closing
	// 	curl_close($ch);
	// 	$json = json_decode($result, true);
    //     echo $json;

    // }
}
