<?php

namespace App\Services;

use App\ContactType;

class ContactTypes
{
    public function get()
    {
        $contactTypes = ContactType::orderBy('name')->get();
        $array = [];
        foreach ($contactTypes as $contactType) {
            $array[$contactType->id] = $contactType->name;
        }
        return $array;
    }
}