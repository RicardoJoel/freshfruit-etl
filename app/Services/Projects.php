<?php

namespace App\Services;

use App\Project;
use Auth;

class Projects
{
    public function getOpen()
    {
        if (Auth::user()->is_admin)
            $projects = Project::where('code','not like','OTR000000000%')->where('status','O')->orderBy('name')->get();
        else
            $projects = Auth::user()->projects->where('status','O')->sortBy('name');
        $others = Project::where('code','like','OTR000000000%')->orderBy('name')->get();
        $array = [];
        foreach ($projects as $project) {
            $array[$project->id] = $project->nameCode;
        }
        foreach ($others as $other) {
            $array[$other->id] = $other->name;
        }
        return $array;
    }
}