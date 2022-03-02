<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consolidado;
use Carbon\Carbon;
use DB;
/* Export data */
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class ManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manifests.index');
    }
    
    public function report()
    {
        $start_at = Carbon::today()->subMonth();
        $end_at = Carbon::today();
        $title = '';
        $items = [];

        return view('manifests.report', compact('items','title','start_at','end_at'));
    }

    public function generate(Request $request)
    {
        $this->validate($request, [
            'start_at' => 'required|date|before_or_equal:end_at',
            'end_at' => 'required|date|before_or_equal:today',
        ], $this->validationErrorMessages());
        
        ini_set('memory_limit','1G');
        ini_set('max_execution_time', 3000);
        
        $start_at = Carbon::parse($request->start_at);
        $end_at = Carbon::parse($request->end_at);
        $title = 'Reporte de manifiestos con fecha '.($start_at == $end_at ? $start_at->format('d/m/Y') : 'entre el '.$start_at->format('d/m/Y').' y el '.$end_at->format('d/m/Y'));

        $items = Consolidado::select([
            'tipo_man', 'manifiesto',
            DB::raw('date_format(fecha_salida,"%d/%m/%Y") as fecha_salida'), 
            'empresa', 'nave',
            DB::raw('count(distinct conocimiento_id) as tot_conoc'),
            DB::raw('count(distinct detalle_id) as tot_detal'),
            DB::raw('count(distinct contenedor_id) as tot_conte'),
        ])
        ->where(function ($query) use ($start_at) {
            if ($start_at)
                $query->where('fecha_salida','>=',$start_at);
            return $query;
        })
        ->where(function ($query) use ($end_at) {
            if ($end_at)
                $query->where('fecha_salida','<=',$end_at->tomorrow());
            return $query;
        })
        ->groupBy([
            'tipo_man', 'manifiesto',
            DB::raw('date_format(fecha_salida,"%d/%m/%Y")'), 
            'empresa', 'nave'
        ])
        ->orderByRaw(
            'tipo_man', 'manifiesto',
            DB::raw('date_format(fecha_salida,"%d/%m/%Y")'), 
            'empresa', 'nave'
        )
        ->get();
        
        return view('manifests.report', compact('items','title','start_at','end_at'));
    }

    public function download(Request $request)
    {
        $this->validate($request, [
            'start_at' => 'required|date|before_or_equal:end_at',
            'end_at' => 'required|date|before_or_equal:today',
        ], $this->validationErrorMessages());
        
        ini_set('memory_limit','2G');
        ini_set('max_execution_time', 3000);

        $start_at = Carbon::parse($request->start_at);
        $end_at = Carbon::parse($request->end_at);
        //$title = 'Reporte de manifiestos con fecha'.($start_at == $end_at ? $start_at->format('d/m/Y') : 'entre el '.$start_at->format('d/m/Y').' y el '.$end_at->format('d/m/Y'));

        /*$success = Consolidado::select([
            'tipo_man', 'manifiesto', 'nave', 'empresa', 'num_detalles', 
            DB::raw('date_format(fecha_salida,"%d/%m/%Y") as fecha_salida'), 
            'conocimiento', 'detalle_con', 'puerto', 'peso_man', 'bultos_man', 
            'consignatario_con', 'embarcador_con', 
            DB::raw('date_format(fecha_transm,"%d/%m/%Y") as fecha_transm'), 
            'num_bultos', 'peso_bruto', 'consignatario_det', 'embarcador_det', //'clientes.ruc',
            'marcas_numeros', 'descripcion', DB::raw('1 as conteo_cont'),
            //DB::raw('if(convert(SUBSTRING_INDEX(descripcion," ",1),UNSIGNED INTEGER)>=40,40,20) as tam_cont'), 
            DB::raw('productos.nombre as producto'), 
            DB::raw('variedades.nombre as variedad'), 
            DB::raw('presentaciones.nombre as presentacion'), 
            DB::raw('if(organico,"ORGANICO","") as organico'), 
            'numero', 'tamanio', 'condicion', 'tipo_cont', 'operador', 'tara'
        ])
        ->leftJoin('productos','productos.id','consolidado.producto_id')
        ->leftJoin('variedades','variedades.id','consolidado.variedad_id')
        ->leftJoin('presentaciones','presentaciones.id','consolidado.presentacion_id')
        ->whereBetween('fecha_salida',[$start_at,$end_at])
        ->whereNotNull('consolidado.producto_id')
        ->where('consolidado.peso_man','>',0)
        ->whereNotNull('numero')
        //->orderByRaw('tipo_man','manifiesto','conocimiento','detalle_con','fecha_salida','nave','empresa')
        ->get();

        $failed = Consolidado::select([
            'tipo_man', 'manifiesto', 'nave', 'empresa', 'num_detalles', 
            DB::raw('date_format(fecha_salida,"%d/%m/%Y") as fecha_salida'), 
            'conocimiento', 'detalle_con', 'puerto', 'peso_man', 'bultos_man', 
            'consignatario_con', 'embarcador_con', 
            DB::raw('date_format(fecha_transm,"%d/%m/%Y") as fecha_transm'), 
            'num_bultos', 'peso_bruto', 'consignatario_det', 'embarcador_det', //'clientes.ruc',
            'marcas_numeros', 'descripcion', DB::raw('1 as conteo_cont'),
            //DB::raw('if(convert(SUBSTRING_INDEX(descripcion," ",1),UNSIGNED INTEGER)>=40,40,20) as tam_cont'), 
            DB::raw('"" as producto'), 
            DB::raw('"" as variedad'), 
            DB::raw('presentaciones.nombre as presentacion'), 
            DB::raw('if(organico,"ORGANICO","") as organico'), 
            'numero', 'tamanio', 'condicion', 'tipo_cont', 'operador', 'tara'
        ])
        ->leftJoin('presentaciones','presentaciones.id','consolidado.presentacion_id')
        ->whereBetween('fecha_salida',[$start_at,$end_at])
        ->whereNull('consolidado.producto_id')
        ->where('consolidado.peso_man','>',0)
        ->whereNotNull('numero')
        ->get();*/

        //Versión antigua
        $items = Consolidado::select([
            'tipo_man', 'manifiesto', 'nave', 'empresa', 'num_detalles', 
            DB::raw('date_format(fecha_salida,"%d/%m/%Y") as fecha_salida'), 
            'conocimiento', 'detalle_con', 'puerto', 'peso_man', 'bultos_man', 
            'consignatario_con', 'embarcador_con', 
            DB::raw('date_format(fecha_transm,"%d/%m/%Y") as fecha_transm'), 
            'num_bultos', 'peso_bruto', 'consignatario_det', 'embarcador_det', //'clientes.ruc',
            'marcas_numeros', 'descripcion', DB::raw('1 as conteo_cont'),
            //DB::raw('if(convert(SUBSTRING_INDEX(descripcion," ",1),UNSIGNED INTEGER)>=40,40,20) as tam_cont'), 
            DB::raw('productos.nombre as producto'), 
            DB::raw('variedades.nombre as variedad'), 
            DB::raw('presentaciones.nombre as presentacion'), 
            DB::raw('if(organico,"ORGANICO","") as organico'), 
            'numero', 'tamanio', 'condicion', 'tipo_cont', 'operador', 'tara'
        ])
        ->leftJoin('productos','productos.id','consolidado.producto_id')
        ->leftJoin('variedades','variedades.id','consolidado.variedad_id')
        ->leftJoin('presentaciones','presentaciones.id','consolidado.presentacion_id')
        ->whereBetween('fecha_salida',[$start_at,$end_at])
        //->whereNotNull('consolidado.producto_id')
        //->where('consolidado.peso_man','>',0)
        //->whereNotNull('numero')
        ->get();
        $export = new \App\Exports\InvoicesExportBackup($items->toArray());
        //Fin version antigua

        //$export = new InvoicesExport($success->toArray(), $failed->toArray());
        return Excel::download($export,'Freshfruit del '.$start_at->format('d-m-Y').' al '.$end_at->format('d-m-Y').'.xlsx');
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    public static function validationErrorMessages()
    {
        return [
            'start_at.required' => 'Debes ingresar obligatoriamente una fecha de inicio.',
            'start_at.date_format' => 'La fecha de inicio ingresada no tiene un formato válido.',

            'end_at.required' => 'Debes ingresar obligatoriamente una fecha de término.',
            'end_at.date_format' => 'La fecha de término ingresada no tiene un formato válido.',
            'end_at.after_or_equal' => 'La fecha de término no puede ser anterior a la fecha de inicio.',
        ];
    }
}
