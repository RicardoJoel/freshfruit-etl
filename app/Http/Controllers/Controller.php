<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function inArray($id, $array) {
        foreach ($array as $item) {
            if ((int)$id == (int)$item['id'])
                return true;
        }
        return false;
    }

    protected function to_float($str) {
        $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
        return floatval(str_replace(',', '', $str));
    }

    protected function to_int($str) {
        $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
        return intval(str_replace(',', '', $str));
    }

    protected function to_date($str) {
        $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
        return $str ? date('Y-m-d', strtotime(str_replace('/', '-', $str))) : null;
    }

    protected function to_onlydate($str) {
        $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
        return $str ? date('Y-m-d', strtotime(str_replace('/', '-', substr($str,0,10)))) : null;
    }

    protected function to_string($str) {
        $str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
        return substr(trim(substr($str, -1) == '?' ? substr($str,0,-1) : $str),0,255);
    }
}
