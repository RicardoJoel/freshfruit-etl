<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consolidado;
use Carbon\Carbon;
use DB;
/* Export data */
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    
    public function index()
    {
        return view('reports.index');
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
            'empresa', 'nave',
        ])
        ->orderByRaw(
            'tipo_man', 'manifiesto',
            DB::raw('date_format(fecha_salida,"%d/%m/%Y")'), 
            'empresa', 'nave',
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
        
        ini_set('memory_limit','1G');

        $start_at = Carbon::parse($request->start_at);
        $end_at = Carbon::parse($request->end_at);
        //$title = 'Reporte de manifiestos con fecha'.($start_at == $end_at ? $start_at->format('d/m/Y') : 'entre el '.$start_at->format('d/m/Y').' y el '.$end_at->format('d/m/Y'));

        $items = Consolidado::select([
            'tipo_man', 'manifiesto', 'nave', 'empresa', 'num_detalles', 
            DB::raw('date_format(fecha_salida,"%d/%m/%Y") as fecha_salida'), 
            'conocimiento', 'detalle_con', 'puerto', 'peso_man', 'bultos_man', 
            'consignatario_con', 'embarcador_con', 
            DB::raw('date_format(fecha_transm,"%d/%m/%Y") as fecha_transm'), 
            'num_bultos', 'peso_bruto', 'consignatario_det', 'embarcador_det', 
            'marcas_numeros', 'descripcion', 
            'numero', 'tamanio', 'condicion', 'tipo_cont', 'operador', 'tara'

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
        //->orderByRaw('tipo_man','manifiesto','conocimiento','detalle_con','fecha_salida','nave','empresa')
        ->get();
        
        $export = new InvoicesExport($items->toArray()/*, $title*/);
        return Excel::download($export,'FreshfruitReport del '.$start_at->format('d-m-Y').' al '.$end_at->format('d-m-Y').'.xlsx');
    }

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
}
