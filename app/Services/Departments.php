<?php

namespace App\Services;

use App\Department;

class Departments
{
    public function get()
    {
        $types = Department::orderBy('name')->get();
        $array = [];
        foreach ($types as $type) {
            $array[$type->id] = $type->name;
        }
        return $array;
    }
}