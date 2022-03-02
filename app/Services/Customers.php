<?php

namespace App\Services;

use App\Customer;

class Customers
{
    public function get()
    {
        $customers = Customer::orderBy('name')->get();
        $array = [];
        foreach ($customers as $customer) {
            $array[$customer->id] = $customer->name.' ('.$customer->code.')';
        }
        return $array;
    }
}