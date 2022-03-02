<?php

namespace App\Services;

use App\District;

class Districts
{
    public function get()
    {
        $districts = District::where('province','Trujillo')->orderBy('district')->get();
        $array = [];
        foreach ($districts as $district) {
            $array[$district->id] = $district->name;
        }
        return $array;
    }
}