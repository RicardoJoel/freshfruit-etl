<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Freelancer;
use Redirect;
use DB;

class FreelancerController extends Controller
{
    protected const MSG_SCS_CRTFRL = 'Independiente con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTFRL = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el independiente.';
    protected const MSG_SCS_UPDFRL = 'Independiente con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDFRL = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el independiente.';
    protected const MSG_SCS_DELFRL = 'Independiente con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELFRL = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el independiente.';
    protected const MSG_NOT_FNDFRL = 'El independiente solicitado no ha sido encontrado.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freelancers = Freelancer::orderBy('name')->paginate(1000000);
        return view('freelancers.index', compact('freelancers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('freelancers.create');
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
            'name' => 'required|string|max:100',
            'profile_id' => 'required|int|min:1',
            'document_type_id' => 'required|int|min:1',
            'document' => 'required|string|unique:freelancers,document,NULL,id,deleted_at,NULL|regex:/'.$request->doc_pattern.'/',
            'birthdate' => 'required|date_format:Y-m-d|before_or_equal:-18 years',
            'other' => 'nullable|string|max:100',
            'address' => 'required|string|max:100',
            'district_id' => 'required|int|min:1',
            'country_id' => 'required|int|min:1',
            'mobile' => 'required|string|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            'annex' => 'nullable|string|regex:/[0-9]{4,6}/',
            'email' => 'nullable|email:rfc|max:50',
            'bank_id' => 'required|int|min:1',
            'account' => 'required|string|max:20',
            'cci' => 'nullable|string|max:23',
        ], $this->validationErrorMessages());

        $freelancer = Freelancer::create($request->all());
        
        if (!$freelancer)
            return Redirect::back()->with('error', self::MSG_ERR_CRTFRL)->withInput();

        return Redirect::route('freelancers.index')->with('success', str_replace('value', $freelancer->code, self::MSG_SCS_CRTFRL));
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
        $freelancer = Freelancer::find($id);
        
        if (!$freelancer) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDFRL);

        return view('freelancers.edit', compact('freelancer'));
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
            'name' => 'required|string|max:100',
            'profile_id' => 'required|int|min:1',
            'document_type_id' => 'required|int|min:1',
            'document' => 'required|string|unique:freelancers,document,'.$id.',id,deleted_at,NULL|regex:/'.$request->doc_pattern.'/',
            'birthdate' => 'required|date_format:Y-m-d|before_or_equal:-18 years',
            'other' => 'nullable|string|max:100',
            'address' => 'required|string|max:100',
            'district_id' => 'required|int|min:1',
            'country_id' => 'required|int|min:1',
            'mobile' => 'required|string|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            'annex' => 'nullable|string|regex:/[0-9]{4,6}/',
            'email' => 'nullable|email:rfc|max:50',
            'bank_id' => 'required|int|min:1',
            'account' => 'required|string|max:20',
            'cci' => 'nullable|string|max:23',
        ], $this->validationErrorMessages());

        $freelancer = Freelancer::find($id);
        
        if (!$freelancer)
            return Redirect::back()->with('error', self::MSG_NOT_FNDFRL)->withInput();
        
        if (!$freelancer->update($request->all()))
            return Redirect::back()->with('error', self::MSG_ERR_UPDFRL)->withInput();

        return Redirect::route('freelancers.index')->with('success',str_replace('value', $freelancer->code, self::MSG_SCS_UPDFRL));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $freelancer = Freelancer::find($id);
        
        if (!$freelancer) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDFRL);

        if (!$freelancer->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELFRL);
        
        return Redirect::route('freelancers.index')->with('success',str_replace('value',$freelancer->code,self::MSG_SCS_DELFRL));
    }

    public function getByDocument($ruc) {
        $freelancers = Freelancer::where('ruc',$ruc)->get(['id','code','ruc','name']);
        if (!count($freelancers)) return null;
        return $freelancers->first();
    }

    public function searchByFilter(Request $request) {
        $ruc = $request->cust_ruc;
        $code = $request->cust_code;
        $name = $request->cust_name;
        $alias = $request->cust_alias;
        $business_id = $request->cust_business_id;

        $freelancers = Freelancer::select([
            DB::raw('freelancers.id as id'),
            DB::raw('freelancers.ruc as ruc'),
            DB::raw('freelancers.code as code'),
            DB::raw('freelancers.name as name'),
            DB::raw('freelancers.alias as alias'),
            DB::raw('bussiness.name as business')
        ])
        ->leftJoin('bussiness','bussiness.id','freelancers.business_id')
        ->where(DB::raw('ifnull(freelancers.ruc,"")'),'like','%'.$ruc.'%')
        ->where(DB::raw('ifnull(freelancers.code,"")'),'like','%'.$code.'%')
        ->where(DB::raw('ifnull(freelancers.name,"")'),'like','%'.$name.'%')
        ->where(DB::raw('ifnull(freelancers.alias,"")'),'like','%'.$alias.'%')
        ->where(function ($query) use ($business_id) {
            if ($business_id)
                $query->where('freelancers.business_id',$business_id);
            return $query;
        })
        ->get();

        return json_encode($freelancers);
    }

    protected function validationErrorMessages()
    {
        return [
            'name.required' => 'Debes ingresar obligatoriamente un nombre o razón social.',
            'name.max' => 'El nombre o razón social debe tener un máximo de cien (100) caracteres.',
            
            'profile_id.required' => 'Debes seleccionar obligatoriamente una ocupación.',
            'profile_id.int' => 'El ID de la ocupación seleccionada no tiene un formato válido.',
            'profile_id.min' => 'El ID de la ocupación seleccionada es inválido.',

            'document_type_id.required' => 'Debes seleccionar obligatoriamente un tipo de documento.',
            'document_type_id.int' => 'El ID del tipo de documento seleccionado no tiene un formato válido.',
            'document_type_id.min' => 'El ID del tipo de documento seleccionado es inválido.',

            'document.required' => 'Debes ingresar obligatoriamente un N° Documento.',
            'document.unique' => 'El N° Documento ingresado ya existe en el sistema.',
            'document.regex' => 'El N° Documento ingresado no corresponde al tipo de documento seleccionado.',

            'birthdate.required' => 'Debes ingresar obligatoriamente una fecha de nacimiento.',
            'birthdate.date_format' => 'La fecha de nacimiento ingresada no tiene un formato válido.',
            'birthdate.before_or_equal' => 'La fecha de nacimiento ingresada no corresponde a una persona con mayoría de edad.',

            'other.max' => 'Para especificar otra profesión debes ingresar como máximo cien (100) caracteres.',

            'address.required' => 'Debes ingresar obligatoriamente una dirección de domicilio.',
            'address.max' => 'La dirección de domicilio debe tener un máximo de cien (100) caracteres.',
            
            'district_id.required' => 'Debes seleccionar obligatoriamente un distrito de domicilio.',
            'district_id.int' => 'El ID del distrito de domicilio ingresado no tiene un formato válido.',
            'district_id.min' => 'El ID del distrito de domicilio ingresado es inválido.',
            
            'country_id.required' => 'Debes seleccionar obligatoriamente un código de país.',
            'country_id.int' => 'El ID del código de país seleccionado no tiene un formato válido.',
            'country_id.min' => 'El ID del código de país seleccionado es inválido.',

            'mobile.required' => 'Debes ingresar obligatoriamente un número celular.',
            'mobile.regex' => 'El número celular debe estar compuesto por nueve (9) dígitos.',            
            'phone.regex' => 'El teléfono fijo debe estar compuesto por el código de ciudad seguido de seis (6) o siete (7) dígitos.',
            'annex.regex' => 'El anexo debe tener entre cuatro (4) y seis (6) dígitos.',
            
            'email.email' => 'El correo electrónico ingresado no tiene un formato válido.',
            'email.max' => 'El correo electrónico debe tener un máximo de cincuenta (50) caracteres.',

            'bank_id.required' => 'Debes seleccionar obligatoriamente una entidad bancaria.',
            'bank_id.int' => 'El ID de la entidad bancaria no tiene un formato válido.',
            'bank_id.min' => 'El ID de la entidad bancaria seleccionada es inválido.',

            'account.required' => 'Debes ingresar obligatoriamente un N° Cuenta.',
            'account.max' => 'El N° Cuenta debe tener veinte (20) caracteres.',
            'cci.max' => 'El Código de Cuenta Interbancario debe tener veintitrés (23) caracteres.',
        ];
    }
}
