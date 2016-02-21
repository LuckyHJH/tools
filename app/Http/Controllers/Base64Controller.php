<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * base64相关工具
 * Class Base64Controller
 * @package App\Http\Controllers
 */
class Base64Controller extends Controller
{
    function index() {
        $str = request('str');
        $type = request('type');
        $validator = validator(['str'=>$str],['str'=>'required']);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages->first('str');
        }

        if ($type == 'decode') {
            return base64_decode($str);
        } else {
            return base64_encode($str);
        }
    }
}
