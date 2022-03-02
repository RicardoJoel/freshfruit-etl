<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Currency;
use App\ExchangeRate;

class ProviderController extends Controller
{
    /**
     * Display a listing of the provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created provider in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pro_profile_id' => 'required|int|min:1',
            'pro_detail' => 'nullable|string|max:50',
            'pro_currency_id' => 'required|int|min:1',
            'pro_rate_value' => 'required|numeric|min:0',
            'pro_rate_id' => 'nullable|int|min:1',
            'pro_price' => 'required|numeric|min:0',
        ], $this->validationErrorMessages());

        $providers = session('providers', []);
        $providers[] = [
            'id' => '',
            'profile' => Profile::find($request->pro_profile_id)->name,
            'detail' => $request->pro_detail,
            'currency' => Currency::find($request->pro_currency_id)->code,
            'rate_value' => $request->pro_rate_value,
            'rate_id' => $request->pro_rate_id,
            'price' => $request->pro_price,
            'subtotal' => $request->pro_rate_value * $request->pro_price,
        ];
        session(['providers' => $providers]);
        return json_encode($providers);
    }

    /**
     * Display the specified provider.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified provider.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $providers = session('providers', []);

        if ($id < 0 || count($providers) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $item = $providers[$id];
        $provider = [
            'id' => $item['id'],
            'profile_id' => Profile::where('name',$item['profile'])->get()->first()->id,
            'detail' => $item['detail'],
            'currency_id' => Currency::where('code',$item['currency'])->get()->first()->id,
            'rate_value' => $item['rate_value'],
            'rate_id' => $item['rate_id'],
            'price' => $item['price'],
            'subtotal' => $item['subtotal'],
        ];
        return json_encode($provider);
    }

    /**
     * Update the specified provider in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'pro_profile_id' => 'required|int|min:1',
            'pro_detail' => 'nullable|string|max:50',
            'pro_currency_id' => 'required|int|min:1',
            'pro_rate_value' => 'required|numeric|min:0',
            'pro_rate_id' => 'nullable|int|min:1',
            'pro_price' => 'required|numeric|min:0',
        ], $this->validationErrorMessages());

        $providers = session('providers', []);
        
        if ($id < 0 || count($providers) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $providers[$id] = [
            'id' => $request->id,
            'profile' => Profile::find($request->pro_profile_id)->name,
            'detail' => $request->pro_detail,
            'currency' => Currency::find($request->pro_currency_id)->code,
            'rate_value' => $request->pro_rate_value,
            'rate_id' => $request->pro_rate_id,
            'price' => $request->pro_price,
            'subtotal' => $request->pro_rate_value * $request->pro_price,
        ];
        
        session(['providers' => $providers]);
        return json_encode($providers);
    }

    /**
     * Remove the specified provider from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $providers = session('providers', []);

        if ($id < 0 || count($providers) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        unset($providers[$id]);
        $providers = array_values($providers);
        session(['providers' => $providers]);
        return json_encode($providers);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'pro_profile_id.required' => 'Debes seleccionar obligatoriamente un perfil.',
            'pro_profile_id.int' => 'El ID del perfil ingresado no tiene un formato válido.',
            'pro_profile_id.min' => 'El ID del perfil ingresado es inválido.',

            'pro_detail.max' => 'El detalle debe tener un máximo de cincuenta (50) caracteres.',

            'pro_currency_id.required' => 'Debes seleccionar obligatoriamente una moneda.',
            'pro_currency_id.int' => 'El ID de la moneda ingresada no tiene un formato válido.',
            'pro_currency_id.min' => 'El ID de la moneda ingresada es inválido.',

            'pro_rate_value.required' => 'Debes ingresar obligatoriamente un tipo de cambio.',
            'pro_rate_value.numeric' => 'El tipo de cambio ingresado no tiene un formato válido.',
            'pro_rate_value.min' => 'El tipo de cambio ingresado es inválido.',

            'pro_rate_id.int' => 'El ID del tipo de cambio ingresado no tiene un formato válido.',
            'pro_rate_id.min' => 'El ID del tipo de cambio ingresado es inválido.',

            'pro_price.required' => 'Debes ingresar obligatoriamente un costo.',
            'pro_price.numeric' => 'El costo ingresado no tiene un formato válido.',
            'pro_price.min' => 'El costo ingresado es inválido.',
        ];
    }
}