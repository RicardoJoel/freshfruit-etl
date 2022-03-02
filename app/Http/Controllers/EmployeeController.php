<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Profile;

class EmployeeController extends Controller
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
            'emp_profile_id' => 'required|int|min:1',
            'emp_detail' => 'nullable|string|max:50',
            'emp_hourly_rate' => 'required|numeric|between:0,1000',
            'emp_num_hours' => 'required|numeric|between:0,1000',
        ], $this->validationErrorMessages());

        $employees = session('employees', []);
        $employees[] = [
            'id' => '',
            'profile' => Profile::find($request->emp_profile_id)->name,
            'detail' => $request->emp_detail,
            'hourly_rate' => $request->emp_hourly_rate,
            'num_hours' => $request->emp_num_hours,
            'subtotal' => $request->emp_hourly_rate * $request->emp_num_hours,
        ];
        session(['employees' => $employees]);
        return json_encode($employees);
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
        $employees = session('employees', []);

        if ($id < 0 || count($employees) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $item = $employees[$id];
        $employee = [
            'id' => $item['id'],
            'profile_id' => Profile::where('name',$item['profile'])->get()->first()->id,
            'detail' => $item['detail'],
            'hourly_rate' => $item['hourly_rate'],
            'num_hours' => $item['num_hours'],
            'subtotal' => $item['subtotal'],
        ];
        return json_encode($employee);
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
            'emp_profile_id' => 'required|int|min:1',
            'emp_detail' => 'nullable|string|max:50',
            'emp_hourly_rate' => 'required|numeric|between:0,1000',
            'emp_num_hours' => 'required|numeric|between:0,1000',
        ], $this->validationErrorMessages());

        $employees = session('employees', []);
        
        if ($id < 0 || count($employees) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $employees[$id] = [
            'id' => $request->emp_id,
            'profile' => Profile::find($request->emp_profile_id)->name,
            'detail' => $request->emp_detail,
            'hourly_rate' => $request->emp_hourly_rate,
            'num_hours' => $request->emp_num_hours,
            'subtotal' => $request->emp_hourly_rate * $request->emp_num_hours,
        ];
        session(['employees' => $employees]);
        return json_encode($employees);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = session('employees', []);

        if ($id < 0 || count($employees) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        unset($employees[$id]);
        $employees = array_values($employees);
        session(['employees' => $employees]);
        return json_encode($employees);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'emp_profile_id.required' => 'Debes seleccionar obligatoriamente un perfil.',
            'emp_profile_id.int' => 'El ID del perfil ingresado no tiene un formato válido.',
            'emp_profile_id.min' => 'El ID del perfil ingresado es inválido.',

            'emp_detail.max' => 'El detalle debe tener un máximo de cincuenta (50) caracteres.',

            'emp_hourly_rate.numeric' => 'El costo x hora ingresado no tiene un formato válido.',
            'emp_hourly_rate.between' => 'El costo x hora debe estar comprendido entre 0 y 1000.',

            'emp_num_hours.numeric' => 'El número de horas ingresado no tiene un formato válido.',
            'emp_num_hours.between' => 'El número de horas debe estar comprendido entre 0 y 1000.',
        ];
    }
}