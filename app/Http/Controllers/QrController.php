<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class QrController extends Controller
{
    function index() {
        //生成二维码图片（直接调用第三方接口 http://www.liantu.com/pingtai/）
        $str = request('str');
        $validator = validator(['str'=>$str],['str'=>'required']);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages->first('str');
        }

        $content = file_get_contents('http://qr.liantu.com/api.php?text='.$str);
        return response($content)->header('Content-Type', 'image/png');
    }
}
