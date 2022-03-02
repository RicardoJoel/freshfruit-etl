<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use App\User;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sel_user_id' => 'required|int|min:1',
            'sel_detail' => 'nullable|string|max:50',
        ], $this->validationErrorMessages());

        $sellers = session('sellers', []);
        $user = User::find($request->sel_user_id);

        foreach ($sellers as $seller)
            if ($seller['code'] === $user->code)
                return response()->json(['success' => 'false', 'errors' => ['msg' => "El colaborador con código $user->code ya figura como vendedor del proyecto."]], 400);

        $sellers[] = [
            'id' => '',
            'code' => $user->code,
            'user' => $user->fullname,
            'detail' => $request->sel_detail,
            'commission' => $user->commission,
        ];
        session(['sellers' => $sellers]);
        return json_encode($sellers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sellers = session('sellers', []);

        if ($id < 0 || count($sellers) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $item = $sellers[$id];
        $seller = [
            'id' => $item['id'],
            'user_id' => User::where('code',$item['code'])->get()->first()->id,
            'code' => $item['code'],
            'detail' => $item['detail'],
            'commission' => $item['commission'],
        ];
        return json_encode($seller);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sel_user_id' => 'required|int|min:1',
            'sel_detail' => 'nullable|string|max:50',
        ], $this->validationErrorMessages());

        $sellers = session('sellers', []);
        
        if ($id < 0 || count($sellers) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $user = User::find($request->sel_user_id);

        foreach ($sellers as $index => $seller)
            if ($index != $id && $seller['code'] === $user->code)
                return response()->json(['success' => 'false', 'errors' => ['msg' => "El colaborador con código $user->code ya figura como vendedor del proyecto."]], 400);
        
        $sellers[$id] = [
            'id' => $request->sel_id,
            'code' => $user->code,
            'user' => $user->fullname,
            'detail' => $request->sel_detail,
            'commission' => $user->commission,
        ];
        session(['sellers' => $sellers]);
        return json_encode($sellers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sellers = session('sellers', []);

        if ($id < 0 || count($sellers) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        unset($sellers[$id]);
        $sellers = array_values($sellers);
        session(['sellers' => $sellers]);
        return json_encode($sellers);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'sel_user_id.required' => 'Debes seleccionar obligatoriamente un perfil.',
            'sel_user_id.int' => 'El ID del perfil ingresado no tiene un formato válido.',
            'sel_user_id.min' => 'El ID del perfil ingresado es inválido.',

            'sel_detail.max' => 'El detalle debe tener un máximo de cincuenta (50) caracteres.',
        ];
    }
}