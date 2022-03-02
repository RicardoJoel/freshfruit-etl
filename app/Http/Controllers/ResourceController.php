<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ResourceController extends Controller
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
            'rsc_id' => 'required|int|min:1',
        ], $this->validationErrorMessages());

        $resources = session('resources', []);

        $user = User::find($request->rsc_id);
        foreach ($resources as $rsc)
            if ($rsc['id'] == $user->id)
                return response()->json(['success' => 'false', 'errors' => ['msg' => "$user->fullname ya figura como parte del proyecto."]], 400);

        $resources[] = [
            'id' => $user->id,
            'name' => $user->fullname
        ];
        session(['resources' => $resources]);
        return json_encode($resources);
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
            'rsc_id' => 'required|int|min:1',
        ], $this->validationErrorMessages());

        $resources = session('resources', []);
        if ($id < 0 || count($resources) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $user = User::find($request->rsc_id);
        foreach ($resources as $index => $rsc)
            if ($index != $id && $rsc['id'] == $user->id)
                return response()->json(['success' => 'false', 'errors' => ['msg' => "$user->fullname ya figura como parte del proyecto."]], 400);

        $resources[$id] = [
            'id' => $user->id,
            'name' => $user->fullname
        ];
        session(['resources' => $resources]);
        return json_encode($resources);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resources = session('resources', []);
        
        if ($id < 0 || count($resources) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        unset($resources[$id]);
        $resources = array_values($resources);
        session(['resources' => $resources]);
        return json_encode($resources);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'rsc_id.required' => 'Debes ingresar obligatoriamente un colaborador.',
            'rsc_id.int' => 'El ID del colaborador ingresado no tiene un formato válido.',
            'rsc_id.min' => 'El ID del colaborador ingresado es inválido.',
        ];
    }
}