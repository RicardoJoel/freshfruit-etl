<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Contact;
use App\ContactType;
use App\Country;
use Redirect;
use DB;

class CustomerController extends Controller
{
    protected const MSG_SCS_CRTCST = 'Cliente con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTCST = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar el cliente.';
    protected const MSG_SCS_UPDCST = 'Cliente con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDCST = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el cliente.';
    protected const MSG_SCS_DELCST = 'Cliente con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELCST = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el cliente.';
    protected const MSG_NOT_FNDCST = 'El cliente solicitado no ha sido encontrado.';

    protected const MSG_SCS_CRTCNT = 'Contacto con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTCNT = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar un contacto.';
    protected const MSG_SCS_UPDCNT = 'Contacto con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDCNT = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar un contacto.';
    protected const MSG_SCS_DELCNT = 'Contacto con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELCNT = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar un contacto.';
    protected const MSG_NOT_FNDCNT = 'El contacto solicitado no ha sido encontrado.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('name')->paginate(1000000);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('errors')) {
            $contacts = session('contacts', []);
        }
        else {
            $contacts = [];
            session(['contacts' => $contacts]);
        }
        return view('customers.create', compact('contacts'));
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
            'alias' => 'required|string|max:50',
            'ruc' => 'required|string|unique:customers,ruc,NULL,id,deleted_at,NULL|regex:/[0-9]{11}/',
            'code' => 'required|string|unique:customers,code,NULL,id,deleted_at,NULL|regex:/[A-Z]{3}/',
            'address' => 'required|string|max:100',
            'district_id' => 'required|int|min:1',
            'business_id' => 'required|int|min:1',
        ], $this->validationErrorMessages());

        $customer = Customer::create($request->all());
        
        if (!$customer)
            return Redirect::back()->with('error', self::MSG_ERR_CRTCST)->withInput();

        $contacts = session('contacts', []);
        foreach ($contacts as $contact) {
            $contact = Contact::create([
                'contact_type_id' => ContactType::where('name',$contact['type'])->get()->first()->id,
                'country_id' => Country::where('name',$contact['country'])->get()->first()->id,
                'fullname' => $contact['fullname'],
                'birthdate' => $contact['birthdate'],
                'position' => $contact['position'],
                'mobile' => $contact['mobile'],
                'phone' => $contact['phone'],
                'annex' => $contact['annex'],
                'email' => $contact['email'],
                'customer_id' => $customer->id
            ]);
            if (!$contact)
                return Redirect::back()->with('error', self::MSG_ERR_CRTCNT)->withInput();
        }
        session()->forget('contacts');
        return Redirect::route('customers.index')->with('success', str_replace('value', $customer->code, self::MSG_SCS_CRTCST));
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
        $customer = Customer::find($id);
        
        if (!$customer) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDCST);

        if (session()->has('errors')) {
            $contacts = session('contacts', []);
        }
        else {
            $contacts = [];
            foreach ($customer->contacts as $contact) {
                $contacts[] = [
                    'id' => $contact->id,
                    'type' => ContactType::find($contact->contact_type_id)->name,
                    'country' => Country::find($contact->country_id)->name,
                    'fullname' => $contact->fullname,
                    'birthdate' => $contact->birthdate,
                    'position' => $contact->position,
                    'mobile' => $contact->mobile,
                    'phone' => $contact->phone,
                    'annex' => $contact->annex,
                    'email' => $contact->email,
                ];
            }
            session(['contacts' => $contacts]);
        }
        return view('customers.edit', compact('customer','contacts'));
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
            'alias' => 'required|string|max:50',
            'ruc' => 'required|string|unique:customers,ruc,'.$id.',id,deleted_at,NULL|regex:/[0-9]{11}/',
            'code' => 'required|string|unique:customers,code,'.$id.',id,deleted_at,NULL|regex:/[A-Z]{3}/',
            'address' => 'required|string|max:100',
            'district_id' => 'required|int|min:1',
            'business_id' => 'required|int|min:1',
        ], $this->validationErrorMessages());

        $customer = Customer::find($id);
        
        if (!$customer)
            return Redirect::back()->with('error', self::MSG_NOT_FNDCST)->withInput();
        
        $contacts = session('contacts', []);
        foreach ($customer->contacts as $contact) {
            if (!($this->inArray($contact->id, $contacts)))
                $contact->delete();
        }
        foreach ($contacts as $contact) {
            if ($contact['id']) { //Contacto actualmente registrado
                $result = Contact::find($contact['id'])->update([
                    'contact_type_id' => ContactType::where('name',$contact['type'])->get()->first()->id,
                    'country_id' => Country::where('name',$contact['country'])->get()->first()->id,
                    'fullname' => $contact['fullname'],
                    'birthdate' => $contact['birthdate'],
                    'position' => $contact['position'],
                    'mobile' => $contact['mobile'],
                    'phone' => $contact['phone'],
                    'annex' => $contact['annex'],
                    'email' => $contact['email'],
                    'customer_id' => $id
                ]);
                if (!$result)
                    return Redirect::back()->with('error', self::MSG_ERR_UPDCNT)->withInput();
            }
            else { //Contacto sin registrar
                $result = Contact::create([
                    'contact_type_id' => ContactType::where('name',$contact['type'])->get()->first()->id,
                    'country_id' => Country::where('name',$contact['country'])->get()->first()->id,
                    'fullname' => $contact['fullname'],
                    'birthdate' => $contact['birthdate'],
                    'position' => $contact['position'],
                    'mobile' => $contact['mobile'],
                    'phone' => $contact['phone'],
                    'annex' => $contact['annex'],
                    'email' => $contact['email'],
                    'customer_id' => $id
                ]);
                if (!$result)
                    return Redirect::back()->with('error', self::MSG_ERR_CRTCNT)->withInput();
            }
        }
        session()->forget('contacts');

        if (!$customer->update($request->all()))
            return Redirect::back()->with('error', self::MSG_ERR_UPDCST)->withInput();

        return Redirect::route('customers.index')->with('success',str_replace('value', $customer->code, self::MSG_SCS_UPDCST));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        
        if (!$customer) 
            return Redirect::back()->with('error', self::MSG_NOT_FNDCST);

        foreach ($customer->contacts as $contact)
            if (!$contact->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELCNT);

        if (!$customer->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELCST);
        
        return Redirect::route('customers.index')->with('success',str_replace('value',$customer->code,self::MSG_SCS_DELCST));
    }

    public function getByDocument($ruc) {
        $customers = Customer::where('ruc',$ruc)->get(['id','code','ruc','name']);
        if (!count($customers)) return null;
        return $customers->first();
    }

    public function searchByFilter(Request $request) {
        $ruc = $request->cust_ruc;
        $code = $request->cust_code;
        $name = $request->cust_name;
        $alias = $request->cust_alias;
        $business_id = $request->cust_business_id;

        $customers = Customer::select([
            DB::raw('customers.id as id'),
            DB::raw('customers.ruc as ruc'),
            DB::raw('customers.code as code'),
            DB::raw('customers.name as name'),
            DB::raw('customers.alias as alias'),
            DB::raw('bussiness.name as business')
        ])
        ->leftJoin('bussiness','bussiness.id','customers.business_id')
        ->where(DB::raw('ifnull(customers.ruc,"")'),'like','%'.$ruc.'%')
        ->where(DB::raw('ifnull(customers.code,"")'),'like','%'.$code.'%')
        ->where(DB::raw('ifnull(customers.name,"")'),'like','%'.$name.'%')
        ->where(DB::raw('ifnull(customers.alias,"")'),'like','%'.$alias.'%')
        ->where(function ($query) use ($business_id) {
            if ($business_id)
                $query->where('customers.business_id',$business_id);
            return $query;
        })
        ->get();

        return json_encode($customers);
    }

    protected function validationErrorMessages()
    {
        return [
            'name.required' => 'Debes ingresar obligatoriamente una razón social.',
            'name.max' => 'La razón social debe tener un máximo de cien (100) caracteres.',
            
            'alias.required' => 'Debes ingresar obligatoriamente un nombre comercial.',
            'alias.max' => 'El nombre comercial debe tener un máximo de cincuenta (50) caracteres.',
            
            'ruc.required' => 'Debes ingresar obligatoriamente un R.U.C.',
            'ruc.unique' => 'El R.U.C. ingresado ya existe en el sistema.',
            'ruc.regex' => 'El R.U.C. debe estar compuesto por once (11) dígitos.',
            
            'code.required' => 'Debes ingresar obligatoriamente un código.',
            'code.unique' => 'El código ingresado ya existe en el sistema.',
            'code.regex' => 'El código debe estar compuesto únicamente por tres (3) letras.',

            'address.required' => 'Debes ingresar obligatoriamente una dirección de facturación.',
            'address.max' => 'La dirección de facturación debe tener un máximo de cien (100) caracteres.',
            
            'district_id.required' => 'Debes seleccionar obligatoriamente un distrito de facturación.',
            'district_id.int' => 'El ID del distrito de facturación ingresado no tiene un formato válido.',
            'district_id.min' => 'El ID del distrito de facturación ingresado es inválido.',
            
            'business_id.required' => 'Debes seleccionar obligatoriamente un rubro de negocio.',
            'business_id.int' => 'El ID del rubro de negocio ingresado no tiene un formato válido.',
            'business_id.min' => 'El ID del rubro de negocio ingresado es inválido.',
        ];
    }
}
