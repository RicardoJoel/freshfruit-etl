<?php

namespace App\Services;

use App\Currency;

class Currencies
{
    public function get()
    {
        $currencies = Currency::orderBy('code')->get();
        $array = [];
        foreach ($currencies as $currency) {
            $array[$currency->id] = $currency->name.' ('.$currency->code.')';
        }
        return $array;
    }

    public function getCode()
    {
        $currencies = Currency::orderBy('code')->get();
        $array = [];
        foreach ($currencies as $currency) {
            $array[$currency->id] = $currency->code;
        }
        return $array;
    }
}