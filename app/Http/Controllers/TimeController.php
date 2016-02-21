<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 时间相关工具
 * Class TimeController
 * @package App\Http\Controllers
 */
class TimeController extends Controller
{
    public function index()
    {
        $str = request('str');
        $timestamp = $this->_getTimestamp($str);
        echo '时间戳：'.$timestamp;
        echo '<br>时间：'.date('Y-m-d H:i:s', $timestamp);
        return null;

    }

    private function _getTimestamp($input) {
        $timestamp = 0;
        if (empty($input)) {//输出当前时间
            $timestamp = time();
        } elseif (strval(intval($input)) === strval($input)) {//如果输入时间戳
            $timestamp = $input;
        } elseif (strpos($input, ',') !== false) {//如果以半角逗号分隔
            $time_arr = explode(',', $input);
            $count = count($time_arr);
            if ($count == 3) {
                $now_time_arr = getdate();
                $timestamp = mktime($time_arr[0], $time_arr[1], $time_arr[2], $now_time_arr['mon'], $now_time_arr['mday'], $now_time_arr['year']);
            } elseif ($count == 6) {
                $timestamp = mktime($time_arr[3], $time_arr[4], $time_arr[5], $time_arr[1], $time_arr[2], $time_arr[0]);
            }
        } else {
            $timestamp = strtotime($input);
            $timestamp === false && $timestamp = 0;
        }
        return $timestamp;
    }
}
