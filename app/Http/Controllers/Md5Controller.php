<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * md5相关工具
 * Class Md5Controller
 * @package App\Http\Controllers
 */
class Md5Controller extends Controller
{
    public function index()
    {
        $str = request('str');
        $validator = validator(['str'=>$str],['str'=>'required']);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return $messages->first('str');
        }
        //TODO 支持大写输出
        return md5($str);
    }
}
