<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Currency;
use App\ExchangeRate;

class IndependentController extends Controller
{
    /**
     * Display a listing of the independent.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new independent.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created independent in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fre_profile_id' => 'required|int|min:1',
            'fre_detail' => 'nullable|string|max:50',
            'fre_currency_id' => 'required|int|min:1',
            'fre_rate_value' => 'required|numeric|min:0',
            'fre_rate_date' => 'nullable|date|before_or_equal:today',
            'fre_rate_id' => 'nullable|int|min:1',
            'fre_price' => 'required|numeric|min:0',
        ], $this->validationErrorMessages());

        $independents = session('independents', []);
        $independents[] = [
            'id' => '',
            'profile' => Profile::find($request->fre_profile_id)->name,
            'detail' => $request->fre_detail,
            'currency' => Currency::find($request->fre_currency_id)->code,
            'rate_value' => $request->fre_rate_value,
            'rate_date' => $request->fre_rate_date,
            'rate_id' => $request->fre_rate_id,
            'price' => $request->fre_price,
            'subtotal' => $request->fre_rate_value * $request->fre_price,
        ];
        session(['independents' => $independents]);
        return json_encode($independents);
    }

    /**
     * Display the specified independent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified independent.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $independents = session('independents', []);

        if ($id < 0 || count($independents) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $item = $independents[$id];
        $independent = [
            'id' => $item['id'],
            'profile_id' => Profile::where('name',$item['profile'])->get()->first()->id,
            'detail' => $item['detail'],
            'currency_id' => Currency::where('code',$item['currency'])->get()->first()->id,
            'rate_value' => $item['rate_value'],
            'rate_date' => $item['rate_date'],
            'rate_id' => $item['rate_id'],
            'price' => $item['price'],
            'subtotal' => $item['subtotal'],
        ];
        return json_encode($independent);
    }

    /**
     * Update the specified independent in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fre_profile_id' => 'required|int|min:1',
            'fre_detail' => 'nullable|string|max:50',
            'fre_currency_id' => 'required|int|min:1',
            'fre_rate_value' => 'required|numeric|min:0',
            'fre_rate_date' => 'nullable|date|before_or_equal:today',
            'fre_rate_id' => 'nullable|int|min:1',
            'fre_price' => 'required|numeric|min:0',
        ], $this->validationErrorMessages());

        $independents = session('independents', []);
        
        if ($id < 0 || count($independents) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $independents[$id] = [
            'id' => $request->id,
            'profile' => Profile::find($request->fre_profile_id)->name,
            'detail' => $request->fre_detail,
            'currency' => Currency::find($request->fre_currency_id)->code,
            'rate_value' => $request->fre_rate_value,
            'rate_date' => $request->fre_rate_date,
            'rate_id' => $request->fre_rate_id,
            'price' => $request->fre_price,
            'subtotal' => $request->fre_rate_value * $request->fre_price,
        ];
        
        session(['independents' => $independents]);
        return json_encode($independents);
    }

    /**
     * Remove the specified independent from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $independents = session('independents', []);

        if ($id < 0 || count($independents) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        unset($independents[$id]);
        $independents = array_values($independents);
        session(['independents' => $independents]);
        return json_encode($independents);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'fre_profile_id.required' => 'Debes seleccionar obligatoriamente un perfil.',
            'fre_profile_id.int' => 'El ID del perfil ingresado no tiene un formato válido.',
            'fre_profile_id.min' => 'El ID del perfil ingresado es inválido.',

            'fre_detail.max' => 'El detalle debe tener un máximo de cincuenta (50) caracteres.',

            'fre_currency_id.required' => 'Debes seleccionar obligatoriamente una moneda.',
            'fre_currency_id.int' => 'El ID de la moneda ingresada no tiene un formato válido.',
            'fre_currency_id.min' => 'El ID de la moneda ingresada es inválido.',

            'fre_rate_value.required' => 'Debes ingresar obligatoriamente un tipo de cambio.',
            'fre_rate_value.numeric' => 'El tipo de cambio ingresado no tiene un formato válido.',
            'fre_rate_value.min' => 'El tipo de cambio ingresado es inválido.',

            'fre_rate_date.date' => 'La fecha del tipo de cambio ingresado no tiene un formato válido.',
            'fre_rate_date.before_or_equal' => 'La fecha del tipo de cambio ingresado no puede ser posterior a la fecha actual.',

            'fre_rate_id.int' => 'El ID del tipo de cambio ingresado no tiene un formato válido.',
            'fre_rate_id.min' => 'El ID del tipo de cambio ingresado es inválido.',

            'fre_price.required' => 'Debes ingresar obligatoriamente un costo.',
            'fre_price.numeric' => 'El costo ingresado no tiene un formato válido.',
            'fre_price.min' => 'El costo ingresado es inválido.',
        ];
    }
}