<?php

namespace App\Services;

use App\Business;

class Bussiness
{
    public function get()
    {
        $bussiness = Business::orderBy('name')->get();
        $array = [];
        foreach ($bussiness as $business) {
            $array[$business->id] = $business->name;
        }
        return $array;
    }
}