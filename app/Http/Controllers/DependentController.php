<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dependent;
use App\DependentType;
use App\DocumentType;
use App\Gender;

class DependentController extends Controller
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
            'dependent_fullname' => 'required|string|max:50',
            'dependent_type_id' => 'required|int|min:1',
            'dependent_birthdate' => 'required|date_format:Y-m-d|before_or_equal:today',
            'dependent_document_type_id' => 'required|int|min:1',
            'dependent_document' => 'required|string|regex:/'.$request->dependent_doc_pattern.'/',
            'dependent_gender_id' => 'required|int|min:1'
        ], $this->validationErrorMessages());

        $dependents = session('dependents', []);
        $dependents[] = [
            'id' => '',
            'fullname' => $request->dependent_fullname,
            'type' => DependentType::find($request->dependent_type_id)->name,
            'birthdate' => $request->dependent_birthdate,
            'document_type' => DocumentType::find($request->dependent_document_type_id)->name,
            'document' => $request->dependent_document,
            'gender' => Gender::find($request->dependent_gender_id)->name
        ];
        session(['dependents' => $dependents]);
        return json_encode($dependents);
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
        $dependents = session('dependents', []);

        if ($id < 0 || count($dependents) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $item = $dependents[$id];
        $dependent = [
            'id' => $item['id'],
            'fullname' => $item['fullname'],
            'type_id' => DependentType::where('name',$item['type'])->get()->first()->id,
            'birthdate' => $item['birthdate'],
            'document_type_id' => DocumentType::where('name',$item['document_type'])->get()->first()->id,
            'document' => $item['document'],
            'gender_id' => Gender::where('name',$item['gender'])->get()->first()->id
        ];
        return json_encode($dependent);
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
            'dependent_fullname' => 'required|string|max:50',
            'dependent_type_id' => 'required|int|min:1',
            'dependent_birthdate' => 'required|date_format:Y-m-d|before_or_equal:today',
            'dependent_document_type_id' => 'required|int|min:1',
            'dependent_document' => 'required|string|regex:/'.$request->dependent_doc_pattern.'/',
            'dependent_gender_id' => 'required|int|min:1'
        ], $this->validationErrorMessages());

        $dependents = session('dependents', []);
        
        if ($id < 0 || count($dependents) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $dependents[$id] = [
            'id' => $request->id,
            'fullname' => $request->dependent_fullname,
            'type' => DependentType::find($request->dependent_type_id)->name,
            'birthdate' => $request->dependent_birthdate,
            'document_type' => DocumentType::find($request->dependent_document_type_id)->name,
            'document' => $request->dependent_document,
            'gender' => Gender::find($request->dependent_gender_id)->name
        ];
        session(['dependents' => $dependents]);
        return json_encode($dependents);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dependents = session('dependents', []);

        if ($id < 0 || count($dependents) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        unset($dependents[$id]);
        $dependents = array_values($dependents);
        session(['dependents' => $dependents]);
        return json_encode($dependents);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'dependent_fullname.required' => 'Debes ingresar obligatoriamente un nombre completo.',
            'dependent_fullname.max' => 'El nombre completo debe tener un máximo de cincuenta (50) caracteres.',
            'dependent_fullname.regex' => 'El nombre completo ingresado no tiene un formato válido.',
            
            'dependent_type_id.required' => 'Debes seleccionar obligatoriamente un tipo de dependiente.',
            'dependent_type_id.int' => 'El ID del tipo de dependiente ingresado no tiene un formato válido.',
            'dependent_type_id.min' => 'El ID del tipo de dependiente ingresado es inválido.',
            
            'dependent_birthdate.required' => 'Debes ingresar obligatoriamente una fecha de nacimiento.',
            'dependent_birthdate.date_format' => 'La fecha de nacimiento ingresada no tiene un formato válido.',
            'dependent_birthdate.before_or_equal' => 'La fecha de nacimiento no puede ser posterior a la fecha actual.',

            'dependent_document_type_id.required' => 'Debes seleccionar obligatoriamente un tipo de documento.',
            'dependent_document_type_id.int' => 'El ID del tipo de documento ingresado no tiene un formato válido.',
            'dependent_document_type_id.min' => 'El ID del tipo de documento ingresado es inválido.',

            'dependent_document.required' => 'Debes ingresar obligatoriamente un N° Documento.',
            'dependent_document.regex' => 'El N° Documento ingresado no corresponde al tipo de documento seleccionado.',

            'dependent_gender_id.required' => 'Debes seleccionar obligatoriamente un género.',
            'dependent_gender_id.int' => 'El ID del género ingresado no tiene un formato válido.',
            'dependent_gender_id.min' => 'El ID del género ingresado es inválido.',
        ];
    }
}
