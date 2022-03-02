<?php

namespace App\Services;

use App\Type;

class Types
{
    public function get()
    {
        $types = Type::orderBy('code')->get();
        $array = [];
        foreach ($types as $type) {
            $array[$type->id] = $type->name;
        }
        return $array;
    }
}