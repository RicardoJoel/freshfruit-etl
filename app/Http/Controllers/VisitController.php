<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use Redirect;
use DB;

class VisitController extends Controller
{
    protected const MSG_SCS_CREATE = 'Visita con código value registrada de manera exitosa.';
    protected const MSG_ERR_CREATE = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar la visita.';
    protected const MSG_SCS_UPDATE = 'Visita con código value actualizada de manera exitosa.';
    protected const MSG_ERR_UPDATE = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar la visita.';
    protected const MSG_SCS_DELETE = 'Visita con código value eliminada de manera exitosa.';
    protected const MSG_ERR_DELETE = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar la visita.';
    protected const MSG_NOT_FOUNDX = 'La visita solicitada no ha sido encontrada.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visits = Visit::orderBy('code')->paginate(1000000);
        return view('visits.index', compact('visits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visits.create');
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
            'project_type_id' => 'required|int|min:1',
            'customer_id' => 'required|int|min:1',
            'user_id' => 'required|int|min:1',
            'prop_code' => 'nullable|string|regex:/[A-Za-z0-9]{15}/',
            'happen_at' => 'required|date',
            'is_done' => 'nullable|boolean',
            'by_reference' => 'nullable|boolean',
            'observation' => 'nullable|string|max:500',
        ], $this->validationErrorMessages());
        
        if ($request->prop_code) {
            $pre = substr($request->prop_code,0,12);
            $max = Visit::where('prop_code','like',$pre.'%')->max(\DB::raw('substr(prop_code,13,3)'));
            $request['prop_code'] = $pre.str_pad(++$max,3,'0',STR_PAD_LEFT);
        }

        $visit = Visit::create($request->all());

        if (!$visit)
            return Redirect::back()->with('error', self::MSG_ERR_CREATE)->withInput();

        return Redirect::route('visits.index')->with('success', str_replace('value', $visit->code, self::MSG_SCS_CREATE));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visit = Visit::find($id);

        if (!$visit)
            return Redirect::back()->with('error', self::MSG_NOT_FOUNDX);
        
        return view('visits.show', compact('visit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visit = Visit::find($id);

        if (!$visit)
            return Redirect::back()->with('error', self::MSG_NOT_FOUNDX);
              
        return view('visits.edit', compact('visit'));
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
            'project_type_id' => 'required|int|min:1',
            'customer_id' => 'required|int|min:1',
            'user_id' => 'required|int|min:1',
            'prop_code' => 'nullable|string|regex:/[A-Za-z0-9]{15}/',
            'happen_at' => 'required|date',
            'is_done' => 'nullable|boolean',
            'by_reference' => 'nullable|boolean',
            'observation' => 'nullable|string|max:500',
        ], $this->validationErrorMessages());

        $visit = Visit::find($id);

        if (!$visit)
            return Redirect::back()->with('error', self::MSG_NOT_FOUNDX)->withInput();

        if (!$request->is_done)
            $request->merge(['is_done' => false]);

        if (!$request->by_reference)
            $request->merge(['by_reference' => false]);
            
        if ($request->prop_code && $request->prop_code != $visit->prop_code) {
            $pre = substr($request->prop_code,0,12);
            $max = Visit::where('prop_code','like',$pre.'%')->max(\DB::raw('substr(prop_code,13,3)'));
            $request['prop_code'] = $pre.str_pad(++$max,3,'0',STR_PAD_LEFT);
        }

        if (!$visit->update($request->all()))
            return Redirect::back()->with('error', self::MSG_ERR_UPDATE)->withInput();

        return Redirect::route('visits.index')->with('success', str_replace('value', $visit->code, self::MSG_SCS_UPDATE));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {     
        $visit = Visit::find($id);

        if (!$visit)
            return Redirect::back()->with('error', self::MSG_NOT_FOUNDX);
        
        if (!$visit->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELETE);

        return Redirect::route('visits.index')->with('success', str_replace('value', $visit->code, self::MSG_SCS_DELETE));
    }

    public function searchByFilter(Request $request) {
        $code = $request->visit_code;
        $prop_code = $request->visit_prop_code;
        $user_name = $request->visit_user_name;
        $happen_at = $request->visit_happen_at;
        $proj_type_id = $request->visit_proj_type_id;
        $cust_id = $request->visit_cust_id;

        $visits = Visit::select([
            DB::raw('visits.id as visit_id'),
            DB::raw('visits.user_id as user_id'),
            DB::raw('visits.project_type_id as project_type_id'),
            DB::raw('visits.code as code'),
            DB::raw('visits.prop_code as prop_code'),
            DB::raw('date_format(visits.happen_at,"%Y-%m-%d") as happen_at'),
            DB::raw('substr(visits.observation,1,50) as observation'),
            DB::raw('users.code as user_code'),
            DB::raw('users.document as user_document'),
            DB::raw('concat(users.name," ",users.lastname) as user_name'),
            DB::raw('project_types.name as project_type_name')
        ])
        ->leftJoin('users','users.id','visits.user_id')
        ->leftJoin('proposals','proposals.visit_id','visits.id')
        ->leftJoin('project_types','project_types.id','visits.project_type_id')
        ->where(DB::raw('ifnull(visits.code,"")'),'like','%'.$code.'%')
        ->where(DB::raw('ifnull(visits.prop_code,"")'),'like','%'.$prop_code.'%')
        ->where(function ($query) use ($user_name) {
            $query->where(DB::raw('ifnull(users.name,"")'),'like','%'.$user_name.'%')
                ->orWhere(DB::raw('ifnull(users.lastname,"")'),'like','%'.$user_name.'%')
                ->orWhere(DB::raw('ifnull(users.code,"")'),'like','%'.$user_name.'%')
                ->orWhere(DB::raw('ifnull(users.document,"")'),'like','%'.$user_name.'%');
        })
        ->where(function ($query) use ($happen_at) {
            if ($happen_at)
                $query->where(DB::raw('date_format(visits.happen_at,"%Y-%m-%d")'),$happen_at);
            return $query;
        })
        ->where(function ($query) use ($proj_type_id) {
            if ($proj_type_id)
                $query->where('visits.project_type_id',$proj_type_id);
            return $query;
        })
        ->where(function ($query) use ($cust_id) {
            if ($cust_id)
                $query->where('visits.customer_id',$cust_id);
            return $query;
        })
        ->groupBy([
            DB::raw('visits.id'),
            DB::raw('visits.user_id'),
            DB::raw('visits.project_type_id'),
            DB::raw('visits.code'),
            DB::raw('visits.prop_code'),
            DB::raw('date_format(visits.happen_at,"%Y-%m-%d")'),
            DB::raw('substr(visits.observation,1,50)'),
            DB::raw('users.code'),
            DB::raw('users.document'),
            DB::raw('concat(users.name," ",users.lastname)'),
            DB::raw('project_types.name')
        ])
        ->having(DB::raw('count(proposals.id)'),0)
        ->get();

        return json_encode($visits);
    }
    
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'project_type_id.required' => 'Debes seleccionar obligatoriamente un tipo de proyecto.',
            'project_type_id.int' => 'El ID del tipo de proyecto seleccionado no tiene un formato válido.',
            'project_type_id.min' => 'El ID del tipo de proyecto seleccionado es inválido.',

            'customer_id.required' => 'Debes seleccionar obligatoriamente un cliente.',
            'customer_id.int' => 'El ID del cliente seleccionado no tiene un formato válido.',
            'customer_id.min' => 'El ID del cliente seleccionado es inválido.',

            'user_id.required' => 'Debes seleccionar obligatoriamente un responsable.',
            'user_id.int' => 'El ID del responsable seleccionado no tiene un formato válido.',
            'user_id.min' => 'El ID del responsable seleccionado es inválido.',

            'prop_code.unique' => 'El código de propuesta ingresado ya existe en el sistema.',
            'prop_code.regex' => 'El código de propuesta debe estar compuesto por quince (15) caracteres alfanuméricos.',
            
            'happen_at.required' => 'Debes ingresar obligatoriamente una fecha de visita.',
            'happen_at.date' => 'La fecha de visita ingresada no tiene un formato válido.',
            
            'is_done.boolean' => 'El flag visita concretada no tiene un formato válido.',
            'by_reference.boolean' => 'El flag por referencia no tiene un formato válido.',
            'observation.max' => 'La observación debe tener un máximo de quinientos (500) caracteres.',
        ];
    }
}
