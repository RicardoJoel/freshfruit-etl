<?php

namespace App\Services;

use App\Mode;

class Modes
{
    public function get()
    {
        $modes = Mode::orderBy('code')->get();
        $array = [];
        foreach ($modes as $mode) {
            $array[$mode->id] = $mode->name;
        }
        return $array;
    }
}