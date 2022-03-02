<?php

namespace App\Services;

use App\ProjectType;

class ProjectTypes
{
    public function get()
    {
        $types = ProjectType::where('code','!=','OTR')->orderBy('name')->get();
        $others = ProjectType::where('code','OTR')->orderBy('name')->get();
        $array = [];
        foreach ($types as $type) {
            $array[$type->id] = $type->name.' ('.$type->code.')';
        }
        foreach ($others as $other) {
            $array[$other->id] = $other->name.' ('.$other->code.')';
        }
        return $array;
    }
}