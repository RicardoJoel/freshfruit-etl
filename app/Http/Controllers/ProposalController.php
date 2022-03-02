<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use App\Proposal;
use App\Employee;
use App\Independent;
use App\Provider;
use App\Profile;
use App\Seller;
use App\Visit;
use App\User;
use Carbon\Carbon;
use Redirect;
use DB;

class ProposalController extends Controller
{
    protected const MSG_SCS_CRTPRO = 'Propuesta con código value registrada de manera exitosa.';
    protected const MSG_ERR_CRTPRO = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar la propuesta.';
    protected const MSG_SCS_UPDPRO = 'Propuesta con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDPRO = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la propuesta.';
    protected const MSG_SCS_DLTPRO = 'Propuesta con código value eliminada de manera exitosa.';
    protected const MSG_ERR_DLTPRO = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar la propuesta.';
    protected const MSG_NOT_FNDPRO = 'La propuesta solicitada no ha sido encontrada.';
    
    protected const MSG_NOT_FNDVST = 'La visita solicitada no ha sido encontrada.';
    protected const MSG_ERR_DIFCST = 'No puedes cambiar el cliente de la visita seleccionada.';
    protected const MSG_ERR_UPDVST = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la visita seleccionada.';
    protected const MSG_ERR_CNTPRO = 'La visita seleccionada ya tiene una propuesta asociada.';
    protected const MSG_ERR_GTDATE = 'La fecha de propuesta no puede ser anterior a la fecha de visita.';
    protected const MSG_SCS_APPROV = 'El estado de la propuesta con código value ha sido cambiado a APROBADO.';
    protected const MSG_SCS_REJECT = 'El estado de la propuesta con código value ha sido cambiado a RECHAZADO.';
    protected const MSG_ERR_STATUS = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el estado de la propuesta.';
    protected const MSG_NOT_EDITAB = 'La propuesta solicitada tiene el estado value y no puede ser editada.';
    protected const MSG_NOT_DELETE = 'La propuesta solicitada tiene el estado value y no puede ser eliminada.';
    protected const MSG_NOT_APBRCH = 'Solo se permite la creación de nuevas versiones para propuestas que hayan sido rechazadas.';
    protected const MSG_HAY_PENDIE = 'No puedes crear nuevas versiones de la propuesta mientras tenga versiones en estado PENDIENTE o APROBADO.';
    protected const MSG_SCS_CRTVRS = 'Nueva versión de la propuesta con código value registrada de manera exitosa.';
    protected const MSG_ERR_CRTVRS = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar una nueva versión para la propuesta.';
    protected const MSG_SCS_UPDVRS = 'Versión de la propuesta con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDVRS = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la versión para la propuesta.';

    protected const MSG_SCS_CRTRSC = 'Recurso con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTRSC = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar un recurso.';
    protected const MSG_SCS_UPDRSC = 'Recurso con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDRSC = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar un recurso.';
    protected const MSG_SCS_DLTRSC = 'Recurso con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DLTRSC = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar un recurso.';
    protected const MSG_NOT_FNDRSC = 'El recurso solicitado no ha sido encontrado.';

    /**
     * Display a listing of the employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proposals = Proposal::orderByRaw('code','version')->paginate(1000000);
        return view('proposals.index', compact('proposals'));
    }

    /**
     * Show the form for creating a new employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('errors')) {
            $employees = session('employees', []);
            $independents = session('independents', []);
            $providers = session('providers', []);
            $sellers = session('sellers', []);
        }
        else {
            $employees = $independents = $providers = $sellers = [];
            session([
                'employees' => $employees, 
                'independents' => $independents,
                'providers' => $providers, 
                'sellers' => $sellers,
            ]);
        }
        return view('proposals.create', compact('employees','independents','providers','sellers'));
    }

    /**
     * Store a newly created employee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'visit_id' => 'nullable|int|min:1',
            'code' => 'required|string|unique:proposals,code,NULL,id,deleted_at,NULL|regex:/[A-Za-z0-9]{15}/',
            'happen_at' => 'required|date_format:Y-m-d',
            'customer_id' => 'required|int|min:1',
            'user_id' => 'required|int|min:1',
            'project_type_id' => 'required|int|min:1',
            'name' => 'required|string|max:200', 
            'pay_curr_id' => 'required|int|min:1',
            'pay_mode_id' => 'required|int|min:1',
            'pay_type_id' => 'required|int|min:1',
            'term_weeks' => 'required|int|min:0',
            'serv_order' => 'nullable|string|max:50',
        ], $this->validationErrorMessages());

        if ($request->visit_id) {
            $visit = Visit::find($request->visit_id);

            if (!$visit)
                return Redirect::back()->with('error', self::MSG_NOT_FNDVST)->withInput();
            
            if (count($visit->proposals))
                return Redirect::back()->with('error', self::MSG_ERR_CNTPRO)->withInput();

            if ($visit->customer_id != $request->customer_id)
                return Redirect::back()->with('error', self::MSG_ERR_DIFCST)->withInput();
            
            /*if (Carbon::parse($visit->happen_at)->gt(Carbon::parse($request->happen_at)))
                return Redirect::back()->with('error', self::MSG_ERR_GTDATE)->withInput();*/

            if (!$visit->update(['code' => $request->code]))
                return Redirect::back()->with('error', self::MSG_ERR_UPDVST)->withInput();
        }

        $proposal = Proposal::create($request->all());

        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_ERR_CRTPRO)->withInput();

        /* Registro de los perfiles de colaborador asociados */
        $employees = session('employees', []);
        foreach ($employees as $employee) {
            if (!Employee::create([
                'profile_id' => Profile::where('name',$employee['profile'])->get()->first()->id,
                'detail' => $employee['detail'],
                'hourly_rate' => $employee['hourly_rate'],
                'num_hours' => $employee['num_hours'],
                'proposal_id' => $proposal->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
        }
        /* Registro de los perfiles de independiente asociados */
        $independents = session('independents', []);
        foreach ($independents as $independent) {
            if (!Independent::create([
                'profile_id' => Profile::where('name',$independent['profile'])->get()->first()->id,
                'detail' => $independent['detail'],
                'currency_id' => Currency::where('code',$independent['currency'])->get()->first()->id,
                'exchange_rate_id' => $independent['rate_id'],
                'price' => $independent['price'],
                'proposal_id' => $proposal->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
        }
        /* Registro de los perfiles de proveedor asociados */
        $providers = session('providers', []);
        foreach ($providers as $provider) {
            if (!Provider::create([
                'profile_id' => Profile::where('name',$provider['profile'])->get()->first()->id,
                'detail' => $provider['detail'],
                'currency_id' => Currency::where('code',$provider['currency'])->get()->first()->id,
                'exchange_rate_id' => $provider['rate_id'],
                'price' => $provider['price'],
                'proposal_id' => $proposal->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
        }
        /* Registro de los vendedores asociados */
        $sellers = session('sellers', []);
        foreach ($sellers as $seller) {
            if (!Seller::create([
                'user_id' => User::where('code',$seller['code'])->get()->first()->id,
                'detail' => $seller['detail'],
                'proposal_id' => $proposal->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
        }
        session()->forget('employees','independents','providers','sellers');
        return Redirect::route('proposals.index')->with('success', str_replace('value', $proposal->code, self::MSG_SCS_CRTPRO));
    }

    /**
     * Display the specified employee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposal = Proposal::find($id);

        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRO);

        $employees = $independents = $providers = $sellers = [];
        foreach ($proposal->employees as $employee)
            $employees[] = [
                'id' => $employee->id,
                'profile' => $employee->profile->name,
                'detail' => $employee->detail,
                'hourly_rate' => $employee->hourly_rate,
                'num_hours' => $employee->num_hours,
                'subtotal' => $employee->subtotal,
            ];
        foreach ($proposal->independents as $independent)
            $independents[] = [
                'id' => $independent->id,
                'profile' => $independent->profile->name,
                'detail' => $independent->detail,
                'currency' => $independent->currency->code,
                'rate_value' => $independent->exchangeRate ->value ?? 1,
                'rate_date' => $independent->exchangeRate ->date ?? null,
                'rate_id' => $independent->exchangeRate ->id ?? null,
                'price' => $independent->price,
                'subtotal' => $independent->subtotal,
            ];
        foreach ($proposal->providers as $provider)
            $providers[] = [
                'id' => $provider->id,
                'profile' => $provider->profile->name,
                'detail' => $provider->detail,
                'currency' => $provider->currency->code,
                'rate_value' => $provider->exchangeRate ->value ?? 1,
                'rate_date' => $provider->exchangeRate ->date ?? null,
                'rate_id' => $provider->exchangeRate ->id ?? null,
                'price' => $provider->price,
                'subtotal' => $provider->subtotal,
            ];
        foreach ($proposal->sellers as $seller)
            $sellers[] = [
                'id' => $seller->id,
                'user' => $seller->user->fullname,
                'code' => $seller->user->code,
                'detail' => $seller->detail,
                'commission' => $seller->user->commission,
            ];
        return view('proposals.show', compact('proposal','employees','independents','providers','sellers'));
    }

    /**
     * Show the form for editing the specified employee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proposal = Proposal::find($id);
        
        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRO);

        if ($proposal->status !== 'P')
            return Redirect::back()->with('error', str_replace('value', $proposal->status === 'A' ? 'APROBADO' : 'RECHAZADO', self::MSG_NOT_EDITAB));

        if (session()->has('errors')) {
            $employees = session('employees', []);
            $independents = session('independents', []);
            $providers = session('providers', []);
            $sellers = session('sellers', []);
        }
        else {
            $employees = $independents = $providers = $sellers = [];
            foreach ($proposal->employees as $employee)
                $employees[] = [
                    'id' => $employee->id,
                    'profile' => $employee->profile->name,
                    'detail' => $employee->detail,
                    'hourly_rate' => $employee->hourly_rate,
                    'num_hours' => $employee->num_hours,
                    'subtotal' => $employee->subtotal,
                ];
            foreach ($proposal->independents as $independent)
                $independents[] = [
                    'id' => $independent->id,
                    'profile' => $independent->profile->name,
                    'detail' => $independent->detail,
                    'currency' => $independent->currency->code,
                    'rate_value' => $independent->exchangeRate ->value ?? 1,
                    'rate_date' => $independent->exchangeRate ->date ?? null,
                    'rate_id' => $independent->exchangeRate ->id ?? null,
                    'price' => $independent->price,
                    'subtotal' => $independent->subtotal,
                ];
            foreach ($proposal->providers as $provider)
                $providers[] = [
                    'id' => $provider->id,
                    'profile' => $provider->profile->name,
                    'detail' => $provider->detail,
                    'currency' => $provider->currency->code,
                    'rate_value' => $provider->exchangeRate ->value ?? 1,
                    'rate_date' => $provider->exchangeRate ->date ?? null,
                    'rate_id' => $provider->exchangeRate ->id ?? null,
                    'price' => $provider->price,
                    'subtotal' => $provider->subtotal,
                ];
            foreach ($proposal->sellers as $seller)
                $sellers[] = [
                    'id' => $seller->id,
                    'user' => $seller->user->fullname,
                    'code' => $seller->user->code,
                    'detail' => $seller->detail,
                    'commission' => $seller->user->commission,
                ];
            session([
                'employees' => $employees, 
                'independents' => $independents,
                'providers' => $providers, 
                'sellers' => $sellers,
            ]);
        }
        return view('proposals.edit', compact('proposal','employees','independents','providers','sellers'));
    }

    /**
     * Update the specified employee in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'visit_id' => 'nullable|int|min:1',
            'code' => 'required|string|unique:proposals,code,'.$id.',id,deleted_at,NULL|regex:/[A-Za-z0-9]{15}/',
            'happen_at' => 'required|date_format:Y-m-d',
            'customer_id' => 'required|int|min:1',
            'user_id' => 'required|int|min:1',
            'project_type_id' => 'required|int|min:1',
            'name' => 'required|string|max:200', 
            'pay_curr_id' => 'required|int|min:1',
            'pay_mode_id' => 'required|int|min:1',
            'pay_type_id' => 'required|int|min:1',
            'term_weeks' => 'required|int|min:0',
            'serv_order' => 'nullable|string|max:50',
        ], $this->validationErrorMessages());

        $proposal = Proposal::find($id);

        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRO)->withInput();

        if ($proposal->status !== 'P')
            return Redirect::back()->with('error', str_replace('value', $proposal->status === 'A' ? 'APROBADO' : 'RECHAZADO', self::MSG_NOT_EDITAB))->withInput();

        if ($request->visit_id) {
            $visit = Visit::find($request->visit_id);

            if (!$visit)
                return Redirect::back()->with('error', self::MSG_NOT_FNDVST)->withInput();
            
            if (count($visit->proposals->where('id','!=',$id)))
                return Redirect::back()->with('error', self::MSG_ERR_CNTPRO)->withInput();

            if ($visit->customer_id != $request->customer_id)
                return Redirect::back()->with('error', self::MSG_ERR_DIFCST)->withInput();
            
            /*if (Carbon::parse($visit->happen_at)->gt(Carbon::parse($request->happen_at)))
                return Redirect::back()->with('error', self::MSG_ERR_GTDATE)->withInput();*/

            if (!$visit->update(['code' => $request->code]))
                return Redirect::back()->with('error', self::MSG_ERR_UPDVST)->withInput();
        }

        if (!$proposal->update($request->all()))
            return Redirect::back()->with('error', self::MSG_ERR_UPDPRO)->withInput();
        
        /* Actualización de los perfiles de colaborador asociados */
        $employees = session('employees', []);
        foreach ($proposal->employees as $employee) {
            if (!self::inArray($employee->id, $employees))
                $employee->delete();
        }
        foreach ($employees as $employee) {
            if ($employee['id']) { //Dependiente actualmente registrado
                if (!Employee::find($employee['id'])->update([
                    'profile_id' => Profile::where('name',$employee['profile'])->get()->first()->id,
                    'detail' => $employee['detail'],
                    'hourly_rate' => $employee['hourly_rate'],
                    'num_hours' => $employee['num_hours'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDRSC)->withInput();
            }
            else { //Dependiente sin registrar
                if (!Employee::create([
                    'profile_id' => Profile::where('name',$employee['profile'])->get()->first()->id,
                    'detail' => $employee['detail'],
                    'hourly_rate' => $employee['hourly_rate'],
                    'num_hours' => $employee['num_hours'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
            }
        }
        /* Actualización de los perfiles de independiente asociados */
        $independents = session('independents', []);
        foreach ($proposal->independents as $independent) {
            if (!self::inArray($independent->id, $independents))
                $independent->delete();
        }
        foreach ($independents as $independent) {
            if ($independent['id']) { //Independiente actualmente registrado
                if (!Independent::find($independent['id'])->update([
                    'profile_id' => Profile::where('name',$independent['profile'])->get()->first()->id,
                    'detail' => $independent['detail'],
                    'currency_id' => Currency::where('code',$independent['currency'])->get()->first()->id,
                    'exchange_rate_id' => $independent['rate_id'],
                    'price' => $independent['price'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDRSC)->withInput();
            }
            else { //Independiente sin registrar
                if (!Independent::create([
                    'profile_id' => Profile::where('name',$independent['profile'])->get()->first()->id,
                    'detail' => $independent['detail'],
                    'currency_id' => Currency::where('code',$independent['currency'])->get()->first()->id,
                    'exchange_rate_id' => $independent['rate_id'],
                    'price' => $independent['price'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
            }
        }
        /* Actualización de los perfiles de proveedor asociados */
        $providers = session('providers', []);
        foreach ($proposal->providers as $provider) {
            if (!self::inArray($provider->id, $providers))
                $provider->delete();
        }
        foreach ($providers as $provider) {
            if ($provider['id']) { //Proveedor actualmente registrado
                if (!Provider::find($provider['id'])->update([
                    'profile_id' => Profile::where('name',$provider['profile'])->get()->first()->id,
                    'detail' => $provider['detail'],
                    'currency_id' => Currency::where('code',$provider['currency'])->get()->first()->id,
                    'exchange_rate_id' => $provider['rate_id'],
                    'price' => $provider['price'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDRSC)->withInput();
            }
            else { //Proveedor sin registrar
                if (!Provider::create([
                    'profile_id' => Profile::where('name',$provider['profile'])->get()->first()->id,
                    'detail' => $provider['detail'],
                    'currency_id' => Currency::where('code',$provider['currency'])->get()->first()->id,
                    'exchange_rate_id' => $provider['rate_id'],
                    'price' => $provider['price'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
            }
        }
        /* Actualización de los vendedores asociados */
        $sellers = session('sellers', []);
        foreach ($proposal->sellers as $seller) {
            if (!self::inArray($seller->id, $sellers))
                $seller->delete();
        }
        foreach ($sellers as $seller) {
            if ($seller['id']) { //Vendedor actualmente registrado
                if (!Seller::find($seller['id'])->update([
                    'user_id' => User::where('code',$seller['code'])->get()->first()->id,
                    'detail' => $seller['detail'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDRSC)->withInput();
            }
            else { //Vendedor sin registrar
                if (!Seller::create([
                    'user_id' => User::where('code',$seller['code'])->get()->first()->id,
                    'detail' => $seller['detail'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
            }
        }
        session()->forget('employees','independents','providers','sellers');
        return Redirect::route('proposals.index')->with('success', str_replace('value', $proposal->code, self::MSG_SCS_UPDPRO));
    }

    /**
     * Remove the specified employee from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {     
        $proposal = Proposal::find($id);

        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRO);
        
        if ($proposal->status !== 'P')
            return Redirect::back()->with('error', str_replace('value', $proposal->status === 'A' ? 'APROBADO' : 'RECHAZADO', self::MSG_NOT_DELETE));
        
        foreach ($proposal->employees as $employee)
            if (!$employee->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DLTRSC);
        
        foreach ($proposal->independents as $independent)
            if (!$independent->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DLTRSC);
        
        foreach ($proposal->providers as $provider)
            if (!$provider->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DLTRSC);
        
        foreach ($proposal->sellers as $seller)
            if (!$seller->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DLTRSC);

        if (!$proposal->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DLTPRO);
        
        return Redirect::route('proposals.index')->with('success', str_replace('value', $proposal->code, self::MSG_SCS_DLTPRO));
    }

    public function approve(Request $request, $id)
    {
        $this->validate($request, [
            'changed_at' => 'required|date_format:Y-m-d|before_or_equal:today',            
        ], $this->validationErrorMessages());

        $proposal = Proposal::find($id);

        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRO);
            
        if ($proposal->status !== 'P')
            return Redirect::back()->with('error', str_replace('value', $proposal->status === 'A' ? 'APROBADO' : 'RECHAZADO', self::MSG_NOT_EDITAB));

        if (!$proposal->update(['status' => 'A', 'changed_at' => $request->changed_at]))
            return Redirect::back()->with('error', self::MSG_ERR_STATUS);

        return Redirect::route('proposals.index')->with('success', str_replace('value', $proposal->code, self::MSG_SCS_APPROV));
    }
    
    public function reject(Request $request, $id)
    {
        $this->validate($request, [
            'changed_at' => 'required|date_format:Y-m-d|before_or_equal:today',            
        ], $this->validationErrorMessages());

        $proposal = Proposal::find($id);

        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRO);

        if ($proposal->status !== 'P')
            return Redirect::back()->with('error', str_replace('value', $proposal->status === 'A' ? 'APROBADO' : 'RECHAZADO', self::MSG_NOT_EDITAB));

        if (!$proposal->update(['status' => 'R', 'changed_at' => $request->changed_at]))
            return Redirect::back()->with('error', self::MSG_ERR_STATUS);

        return Redirect::route('proposals.index')->with('success', str_replace('value', $proposal->code, self::MSG_SCS_REJECT));
    }

    public function createVersion($id)
    {
        $proposal = Proposal::find($id);

        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRO);
        
        if ($proposal->status !== 'R')
            return Redirect::back()->with('error', self::MSG_NOT_APBRCH);
        
        if (Proposal::where('code',$proposal->code)->whereIn('status',['A','P'])->count())
            return Redirect::back()->with('error', self::MSG_HAY_PENDIE);

        if (session()->has('errors')) {
            $employees = session('employees', []);
            $independents = session('independents', []);
            $providers = session('providers', []);
            $sellers = session('sellers', []);
        }
        else {
            $employees = $independents = $providers = $sellers = [];
            foreach ($proposal->employees as $employee)
                $employees[] = [
                    'id' => $employee->id,
                    'profile' => $employee->profile->name,
                    'detail' => $employee->detail,
                    'hourly_rate' => $employee->hourly_rate,
                    'num_hours' => $employee->num_hours,
                    'subtotal' => $employee->subtotal,
                ];
            foreach ($proposal->independents as $independent)
                $independents[] = [
                    'id' => $independent->id,
                    'profile' => $independent->profile->name,
                    'detail' => $independent->detail,
                    'currency' => $independent->currency->code,
                    'rate_value' => $independent->exchangeRate ->value ?? 1,
                    'rate_date' => $independent->exchangeRate ->date ?? null,
                    'rate_id' => $independent->exchangeRate ->id ?? null,
                    'price' => $independent->price,
                    'subtotal' => $independent->subtotal,
                ];
            foreach ($proposal->providers as $provider)
                $providers[] = [
                    'id' => $provider->id,
                    'profile' => $provider->profile->name,
                    'detail' => $provider->detail,
                    'currency' => $provider->currency->code,
                    'rate_value' => $provider->exchangeRate ->value ?? 1,
                    'rate_date' => $provider->exchangeRate ->date ?? null,
                    'rate_id' => $provider->exchangeRate ->id ?? null,
                    'price' => $provider->price,
                    'subtotal' => $provider->subtotal,
                ];
            foreach ($proposal->sellers as $seller)
                $sellers[] = [
                    'id' => $seller->id,
                    'user' => $seller->user->fullname,
                    'code' => $seller->user->code,
                    'detail' => $seller->detail,
                    'commission' => $seller->user->commission,
                ];
            session([
                'employees' => $employees, 
                'independents' => $independents,
                'providers' => $providers, 
                'sellers' => $sellers,
            ]);
        }
        $version = Proposal::where('code',$proposal->code)->count() + 1;
        
        return view('proposals.versions.create', compact('proposal','employees','independents','providers','sellers','version'));
    }
    
    public function editVersion($id)
    {
        $proposal = Proposal::find($id);

        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRO);
        
        if ($proposal->status !== 'P')
            return Redirect::back()->with('error', str_replace('value', $proposal->status === 'A' ? 'APROBADO' : 'RECHAZADO', self::MSG_NOT_EDITAB));

        if (session()->has('errors')) {
            $employees = session('employees', []);
            $independents = session('independents', []);
            $providers = session('providers', []);
            $sellers = session('sellers', []);
        }
        else {
            $employees = $independents = $providers = $sellers = [];
            foreach ($proposal->employees as $employee)
                $employees[] = [
                    'id' => $employee->id,
                    'profile' => $employee->profile->name,
                    'detail' => $employee->detail,
                    'hourly_rate' => $employee->hourly_rate,
                    'num_hours' => $employee->num_hours,
                    'subtotal' => $employee->subtotal,
                ];
            foreach ($proposal->independents as $independent)
                $independents[] = [
                    'id' => $independent->id,
                    'profile' => $independent->profile->name,
                    'detail' => $independent->detail,
                    'currency' => $independent->currency->code,
                    'rate_value' => $independent->exchangeRate->value ?? 1,
                    'rate_date' => $independent->exchangeRate->date ?? null,
                    'rate_id' => $independent->exchangeRate->id ?? null,
                    'price' => $independent->price,
                    'subtotal' => $independent->subtotal,
                ];
            foreach ($proposal->providers as $provider)
                $providers[] = [
                    'id' => $provider->id,
                    'profile' => $provider->profile->name,
                    'detail' => $provider->detail,
                    'currency' => $provider->currency->code,
                    'rate_value' => $provider->exchangeRate->value ?? 1,
                    'rate_date' => $provider->exchangeRate->date ?? null,
                    'rate_id' => $provider->exchangeRate->id ?? null,
                    'price' => $provider->price,
                    'subtotal' => $provider->subtotal,
                ];
            foreach ($proposal->sellers as $seller)
                $sellers[] = [
                    'id' => $seller->id,
                    'user' => $seller->user->fullname,
                    'code' => $seller->user->code,
                    'detail' => $seller->detail,
                    'commission' => $seller->user->commission,
                ];
            session([
                'employees' => $employees, 
                'independents' => $independents,
                'providers' => $providers, 
                'sellers' => $sellers,
            ]);
        }
        return view('proposals.versions.edit', compact('proposal','employees','independents','providers','sellers'));
    }

    public function storeVersion(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required|int|min:1',
            'pay_curr_id' => 'required|int|min:1',
            'pay_mode_id' => 'required|int|min:1',
            'pay_type_id' => 'required|int|min:1',
            'term_weeks' => 'required|int|min:0',
            'serv_order' => 'nullable|string|max:50',
            'perc_fit' => 'nullable|numeric|between:0,100',
        ], $this->validationErrorMessages());
        
        $proposal = Proposal::find($id);

        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRO)->withInput();

        $version = Proposal::where('code',$proposal->code)->count() + 1;

        $proposal->status = 'P';
        $proposal->version = $version;
        $proposal->user_id = $request->user_id;
        $proposal->pay_curr_id = $request->pay_curr_id;
        $proposal->pay_mode_id = $request->pay_mode_id;
        $proposal->pay_type_id = $request->pay_type_id;
        $proposal->term_weeks = $request->term_weeks;
        $proposal->serv_order = $request->serv_order;
        $proposal->perc_fit = $request->perc_fit;

        $new = $proposal->replicate();

        if (!$new->save())
            return Redirect::back()->with('error', self::MSG_ERR_CRTVRS)->withInput();
        
        /* Registro de los perfiles de colaborador asociados */
        $employees = session('employees', []);
        foreach ($employees as $employee) {
            if (!Employee::create([
                'profile_id' => Profile::where('name',$employee['profile'])->get()->first()->id,
                'detail' => $employee['detail'],
                'hourly_rate' => $employee['hourly_rate'],
                'num_hours' => $employee['num_hours'],
                'proposal_id' => $new->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
        }
        /* Registro de los perfiles de independiente asociados */
        $independents = session('independents', []);
        foreach ($independents as $independent) {
            if (!Independent::create([
                'profile_id' => Profile::where('name',$independent['profile'])->get()->first()->id,
                'detail' => $independent['detail'],
                'currency_id' => Currency::where('code',$independent['currency'])->get()->first()->id,
                'exchange_rate_id' => $independent['rate_id'],
                'price' => $independent['price'],
                'proposal_id' => $new->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
        }
        /* Registro de los perfiles de proveedor asociados */
        $providers = session('providers', []);
        foreach ($providers as $provider) {
            if (!Provider::create([
                'profile_id' => Profile::where('name',$provider['profile'])->get()->first()->id,
                'detail' => $provider['detail'],
                'currency_id' => Currency::where('code',$provider['currency'])->get()->first()->id,
                'exchange_rate_id' => $provider['rate_id'],
                'price' => $provider['price'],
                'proposal_id' => $new->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
        }
        /* Registro de los vendedores asociados */
        $sellers = session('sellers', []);
        foreach ($sellers as $seller) {
            if (!Seller::create([
                'user_id' => User::where('code',$seller['code'])->get()->first()->id,
                'detail' => $seller['detail'],
                'proposal_id' => $new->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
        }
        session()->forget('employees','independents','providers','sellers');
        return Redirect::route('proposals.index')->with('success', str_replace('value', $new->code, self::MSG_SCS_CRTVRS));
    }

    public function updateVersion(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required|int|min:1',
            'pay_curr_id' => 'required|int|min:1',
            'pay_mode_id' => 'required|int|min:1',
            'pay_type_id' => 'required|int|min:1',
            'term_weeks' => 'required|int|min:0',
            'serv_order' => 'nullable|string|max:50',
            'perc_fit' => 'nullable|numeric|between:0,100',
        ], $this->validationErrorMessages());
        
        $proposal = Proposal::find($id);
        
        if (!$proposal)
            return Redirect::back()->with('error', self::MSG_NOT_FNDPRO)->withInput();

        if ($proposal->status !== 'P')
            return Redirect::back()->with('error', str_replace('value', $proposal->status === 'A' ? 'APROBADO' : 'RECHAZADO', self::MSG_NOT_EDITAB))->withInput();

        $proposal->user_id = $request->user_id;
        $proposal->pay_curr_id = $request->pay_curr_id;
        $proposal->pay_mode_id = $request->pay_mode_id;
        $proposal->pay_type_id = $request->pay_type_id;
        $proposal->term_weeks = $request->term_weeks;
        $proposal->serv_order = $request->serv_order;
        $proposal->perc_fit = $request->perc_fit;
        
        if (!$proposal->save())
            return Redirect::back()->with('error', self::MSG_ERR_UPDVRS)->withInput();

        /* Actualización de los perfiles de colaborador asociados */
        $employees = session('employees', []);
        foreach ($proposal->employees as $employee) {
            if (!self::inArray($employee->id, $employees))
                $employee->delete();
        }
        foreach ($employees as $employee) {
            if ($employee['id']) { //Dependiente actualmente registrado
                if (!Employee::find($employee['id'])->update([
                    'profile_id' => Profile::where('name',$employee['profile'])->get()->first()->id,
                    'detail' => $employee['detail'],
                    'hourly_rate' => $employee['hourly_rate'],
                    'num_hours' => $employee['num_hours'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDRSC)->withInput();
            }
            else { //Dependiente sin registrar
                if (!Employee::create([
                    'profile_id' => Profile::where('name',$employee['profile'])->get()->first()->id,
                    'detail' => $employee['detail'],
                    'hourly_rate' => $employee['hourly_rate'],
                    'num_hours' => $employee['num_hours'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
            }
        }
        /* Actualización de los perfiles de independiente asociados */
        $independents = session('independents', []);
        foreach ($proposal->independents as $independent) {
            if (!self::inArray($independent->id, $independents))
                $independent->delete();
        }
        foreach ($independents as $independent) {
            if ($independent['id']) { //Independiente actualmente registrado
                if (!Independent::find($independent['id'])->update([
                    'profile_id' => Profile::where('name',$independent['profile'])->get()->first()->id,
                    'detail' => $independent['detail'],
                    'currency_id' => Currency::where('code',$independent['currency'])->get()->first()->id,
                    'exchange_rate_id' => $independent['rate_id'],
                    'price' => $independent['price'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDRSC)->withInput();
            }
            else { //Independiente sin registrar
                if (!Independent::create([
                    'profile_id' => Profile::where('name',$independent['profile'])->get()->first()->id,
                    'detail' => $independent['detail'],
                    'currency_id' => Currency::where('code',$independent['currency'])->get()->first()->id,
                    'exchange_rate_id' => $independent['rate_id'],
                    'price' => $independent['price'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
            }
        }
        /* Actualización de los perfiles de proveedor asociados */
        $providers = session('providers', []);
        foreach ($proposal->providers as $provider) {
            if (!self::inArray($provider->id, $providers))
                $provider->delete();
        }
        foreach ($providers as $provider) {
            if ($provider['id']) { //Proveedor actualmente registrado
                if (!Provider::find($provider['id'])->update([
                    'profile_id' => Profile::where('name',$provider['profile'])->get()->first()->id,
                    'detail' => $provider['detail'],
                    'currency_id' => Currency::where('code',$provider['currency'])->get()->first()->id,
                    'exchange_rate_id' => $provider['rate_id'],
                    'price' => $provider['price'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDRSC)->withInput();
            }
            else { //Proveedor sin registrar
                if (!Provider::create([
                    'profile_id' => Profile::where('name',$provider['profile'])->get()->first()->id,
                    'detail' => $provider['detail'],
                    'currency_id' => Currency::where('code',$provider['currency'])->get()->first()->id,
                    'exchange_rate_id' => $provider['rate_id'],
                    'price' => $provider['price'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
            }
        }
        /* Actualización de los vendedores asociados */
        $sellers = session('sellers', []);
        foreach ($proposal->sellers as $seller) {
            if (!self::inArray($seller->id, $sellers))
                $seller->delete();
        }
        foreach ($sellers as $seller) {
            if ($seller['id']) { //Vendedor actualmente registrado
                if (!Seller::find($seller['id'])->update([
                    'user_id' => User::where('code',$seller['code'])->get()->first()->id,
                    'detail' => $seller['detail'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDRSC)->withInput();
            }
            else { //Vendedor sin registrar
                if (!Seller::create([
                    'user_id' => User::where('code',$seller['code'])->get()->first()->id,
                    'detail' => $seller['detail'],
                    'proposal_id' => $proposal->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_CRTRSC)->withInput();
            }
        }
        session()->forget('employees','independents','providers','sellers');
        return Redirect::route('proposals.index')->with('success', str_replace('value', $proposal->code, self::MSG_SCS_UPDVRS));
    }

    public function searchByFilter(Request $request) {
        $code = $request->prop_cod;
        $name = $request->prop_name;
        $user_name = $request->prop_user_name;
        $happen_at = $request->prop_happen_at;
        $proj_type_id = $request->prop_proj_type_id;
        $cust_id = $request->prop_cust_id;

        $proposals = Proposal::select([
            DB::raw('proposals.id as proposal_id'),
            DB::raw('proposals.user_id as user_id'),
            DB::raw('proposals.project_type_id as project_type_id'),
            DB::raw('proposals.code as code'),
            DB::raw('proposals.name as name'),
            DB::raw('proposals.version as version'),
            DB::raw('date_format(proposals.happen_at,"%Y-%m-%d") as happen_at'),
            DB::raw('users.code as user_code'),
            DB::raw('users.document as user_document'),
            DB::raw('concat(users.name," ",users.lastname) as user_name'),
            DB::raw('project_types.name as project_type_name')
        ])
        ->leftJoin('users','users.id','proposals.user_id')
        ->leftJoin('projects','projects.proposal_id','proposals.id')
        ->leftJoin('project_types','project_types.id','proposals.project_type_id')
        ->where(DB::raw('ifnull(proposals.status,"")'),'A')
        ->where(DB::raw('ifnull(proposals.code,"")'),'like','%'.$code.'%')
        ->where(DB::raw('ifnull(proposals.name,"")'),'like','%'.$name.'%')
        ->where(function ($query) use ($user_name) {
            $query->where(DB::raw('ifnull(users.name,"")'),'like','%'.$user_name.'%')
                ->orWhere(DB::raw('ifnull(users.lastname,"")'),'like','%'.$user_name.'%')
                ->orWhere(DB::raw('ifnull(users.code,"")'),'like','%'.$user_name.'%')
                ->orWhere(DB::raw('ifnull(users.document,"")'),'like','%'.$user_name.'%');
        })
        ->where(function ($query) use ($happen_at) {
            if ($happen_at)
                $query->where(DB::raw('date_format(proposals.happen_at,"%Y-%m-%d")'),$happen_at);
            return $query;
        })
        ->where(function ($query) use ($proj_type_id) {
            if ($proj_type_id)
                $query->where('proposals.project_type_id',$proj_type_id);
            return $query;
        })
        ->where(function ($query) use ($cust_id) {
            if ($cust_id)
                $query->where('proposals.customer_id',$cust_id);
            return $query;
        })
        ->groupBy([
            DB::raw('proposals.id'),
            DB::raw('proposals.user_id'),
            DB::raw('proposals.project_type_id'),
            DB::raw('proposals.code'),
            DB::raw('proposals.name'),
            DB::raw('proposals.version'),
            DB::raw('date_format(proposals.happen_at,"%Y-%m-%d")'),
            DB::raw('users.code'),
            DB::raw('users.document'),
            DB::raw('concat(users.name," ",users.lastname)'),
            DB::raw('project_types.name')
        ])
        ->having(DB::raw('count(projects.id)'),0)
        ->get();

        return json_encode($proposals);
    }
    
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'visit_id.int' => 'El ID de la visita seleccionada no tiene un formato válido.',
            'visit_id.min' => 'El ID de la visita seleccionada es inválido.',

            'code.required' => 'Debes ingresar obligatoriamente un código de propuesta.',
            'code.unique' => 'El código de propuesta ingresado ya existe en el sistema.',
            'code.regex' => 'El código de propuesta debe estar compuesto por quince (15) caracteres alfanuméricos.',

            'happen_at.required' => 'Debes ingresar obligatoriamente una fecha de propuesta.',
            'happen_at.date_format' => 'La fecha de propuesta ingresada no tiene un formato válido.',

            'customer_id.required' => 'Debes seleccionar obligatoriamente un cliente.',
            'customer_id.int' => 'El ID del cliente seleccionado no tiene un formato válido.',
            'customer_id.min' => 'El ID del cliente seleccionado es inválido.',
            
            'user_id.required' => 'Debes seleccionar obligatoriamente un responsable.',
            'user_id.int' => 'El ID del responsable seleccionado no tiene un formato válido.',
            'user_id.min' => 'El ID del responsable seleccionado es inválido.',

            'project_type_id.required' => 'Debes seleccionar obligatoriamente un tipo de proyecto.',
            'project_type_id.int' => 'El ID del tipo de proyecto seleccionado no tiene un formato válido.',
            'project_type_id.min' => 'El ID del tipo de proyecto seleccionado es inválido.',
            
            'name.required' => 'Debes ingresar obligatoriamente un nombre de propuesta.',
            'name.max' => 'El nombre de la propuesta debe tener un máximo de doscientos (200) caracteres.',

            'pay_curr_id.required' => 'Debes seleccionar obligatoriamente una moneda.',
            'pay_curr_id.int' => 'El ID de la moneda seleccionada no tiene un formato válido.',
            'pay_curr_id.min' => 'El ID de la moneda seleccionada es inválido.',
            
            'pay_mode_id.required' => 'Debes seleccionar obligatoriamente una modalidad de pago.',
            'pay_mode_id.int' => 'El ID de la modalidad de pago seleccionada no tiene un formato válido.',
            'pay_mode_id.min' => 'El ID de la modalidad de pago seleccionada es inválido.',

            'pay_type_id.required' => 'Debes seleccionar obligatoriamente un tipo de pago.',
            'pay_type_id.int' => 'El ID del tipo de pago seleccionado no tiene un formato válido.',
            'pay_type_id.min' => 'El ID del tipo de pago seleccionado es inválido.',

            'term_weeks.required' => 'Debes seleccionar obligatoriamente un plazo de pago.',
            'term_weeks.int' => 'El plazo de pago ingresado no tiene un formato válido.',
            'term_weeks.min' => 'El plazo de pago ingresado es inválido.',
        
            'serv_order.max' => 'El N° Orden de servicio debe tener un máximo de cincuenta (50) caracteres.',

            'perc_fit.numeric' => 'El ajuste ingresado no tiene un formato válido.',
            'perc_fit.between' => 'El ajuste debe estar comprendido entre cero (0) y cien (100).',

            'changed_at.required' => 'Debes ingresar obligatoriamente una fecha de cambio de estado.',
            'changed_at.date_format' => 'La fecha de cambio de estado ingresada no tiene un formato válido.',
            'changed_at.before_or_equal' => 'La fecha de cambio de estado no puede ser posterior a la fecha actual.', 
        ];
    }
}
