<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactType;
use App\Contact;
use App\Country;
use Redirect;

class ContactController extends Controller
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
            'contact_type_id' => 'required|int|min:1',
            'contact_country_id' => 'required|int|min:1',
            'contact_fullname' => 'required|string|max:50',
            'contact_position' => 'required|string|max:50',
            'contact_birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:-18 years',
            'contact_mobile' => 'required|string|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'contact_phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            'contact_annex' => 'nullable|string|regex:/[0-9]{4,6}/',
            'contact_email' => 'required|email:rfc|max:50',
        ], $this->validationErrorMessages());

        $contacts = session('contacts', []);
        $contacts[] = [
            'id' => '',
            'type' => ContactType::find($request->contact_type_id)->name,
            'country' => Country::find($request->contact_country_id)->name,
            'fullname' => $request->contact_fullname,
            'birthdate' => $request->contact_birthdate,
            'position' => $request->contact_position,
            'mobile' => $request->contact_mobile,
            'phone' => $request->contact_phone,
            'annex' => $request->contact_annex,
            'email' => $request->contact_email,
        ];
        session(['contacts' => $contacts]);
        return json_encode($contacts);
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
        $contacts = session('contacts', []);

        if ($id < 0 || count($contacts) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $item = $contacts[$id];
        $contact = [
            'id' => $item['id'],
            'type_id' => ContactType::where('name',$item['type'])->get()->first()->id,
            'country_id' => Country::where('name',$item['country'])->get()->first()->id,
            'fullname' => $item['fullname'],
            'birthdate' => $item['birthdate'],
            'position' => $item['position'],
            'mobile' => $item['mobile'],
            'phone' => $item['phone'],
            'annex' => $item['annex'],
            'email' => $item['email'],
        ];
        return json_encode($contact);
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
            'contact_type_id' => 'required|int|min:1',
            'contact_country_id' => 'required|int|min:1',
            'contact_fullname' => 'required|string|max:50',
            'contact_position' => 'required|string|max:50',
            'contact_birthdate' => 'nullable|date_format:Y-m-d|before_or_equal:-18 years',
            'contact_mobile' => 'required|string|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'contact_phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            'contact_annex' => 'nullable|string|regex:/[0-9]{4,6}/',
            'contact_email' => 'required|email:rfc|max:50',
        ], $this->validationErrorMessages());

        $contacts = session('contacts', []);
        
        if ($id < 0 || count($contacts) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        $contacts[$id] = [
            'id' => $request->contact_id,
            'type' => ContactType::find($request->contact_type_id)->name,
            'country' => Country::find($request->contact_country_id)->name,
            'fullname' => $request->contact_fullname,
            'birthdate' => $request->contact_birthdate,
            'position' => $request->contact_position,
            'mobile' => $request->contact_mobile,
            'phone' => $request->contact_phone,
            'annex' => $request->contact_annex,
            'email' => $request->contact_email,
        ];
        session(['contacts' => $contacts]);
        return json_encode($contacts);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacts = session('contacts', []);

        if ($id < 0 || count($contacts) <= $id)
            return response()->json(['success' => 'false', 'message' => 'El índice ingresado es inválido.'], 400);
        
        unset($contacts[$id]);
        $contacts = array_values($contacts);
        session(['contacts' => $contacts]);
        return json_encode($contacts);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'contact_type_id.required' => 'Debes seleccionar obligatoriamente un tipo de contacto.',
            'contact_type_id.int' => 'El ID del tipo de contacto ingresado no tiene un formato válido.',
            'contact_type_id.min' => 'El ID del tipo de contacto ingresado es inválido.',

            'contact_country_id.required' => 'Debes seleccionar obligatoriamente un código de país.',
            'contact_country_id.int' => 'El ID del código de país ingresado no tiene un formato válido.',
            'contact_country_id.min' => 'El ID del código de país ingresado es inválido.',

            'contact_fullname.required' => 'Debes ingresar obligatoriamente un nombre completo.',
            'contact_fullname.max' => 'El nombre completo debe tener un máximo de cien (100) caracteres.',
            
            'contact_position.required' => 'Debes ingresar obligatoriamente un cargo.',
            'contact_position.max' => 'El cargo debe tener un máximo de cien (50) caracteres.',

            'contact_birthdate.date_format' => 'La fecha de nacimiento ingresada no tiene un formato válido.',
            'contact_birthdate.before_or_equal' => 'La fecha de nacimiento ingresada no corresponde a una persona con mayoría de edad.',
            
            'contact_mobile.required' => 'Debes ingresar obligatoriamente un número celular.',
            'contact_mobile.regex' => 'El número celular debe estar compuesto por nueve (9) dígitos.',            
            
            'contact_phone.regex' => 'El teléfono fijo debe estar compuesto por el código de ciudad seguido de seis (6) o siete (7) dígitos.',
            'contact_annex.regex' => 'El anexo debe tener entre cuatro (4) y seis (6) dígitos.',
            
            'contact_email.email' => 'El correo electrónico ingresado no tiene un formato válido.',
            'contact_email.max' => 'El correo electrónico debe tener un máximo de cincuenta (50) caracteres.',
        ];
    }
}