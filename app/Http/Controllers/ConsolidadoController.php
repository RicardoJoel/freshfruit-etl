<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conocimiento;
use App\Consolidado;
use App\Contenedor;
use App\Detalle;
use App\Manifiesto;
use App\Presentacion;
use App\Producto;
use App\Variedad;
use Carbon\Carbon;
use DB;

class ConsolidadoController extends Controller
{
    protected const MSG_FND_RNGCNS = 'Se encontró count filas registradas entre el minDt y el maxDt. ¿Deseas sobreescribirlos?';
    protected const MSG_ERR_CRTCNS = 'Lo sentimos, ocurrió un error mientras se intentaba crear un registro del consolidado.';
    protected const MSG_ERR_DLTCNS = 'Lo sentimos, ocurrió un error mientras se intentaba eliminar un registro del consolidado.';

    /**
     * Load data from the html page creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadData(Request $request)
    {
        self::validate($request, [
            'con_rewrite' => 'required|bool',
            'con_fecIni' => 'required|date_format:Y-m-d|before_or_equal:con_fecFin',
            'con_fecFin' => 'required|date_format:Y-m-d|before:today',
        ], self::validationErrorMessages());

        //obtengo filtros
        $rewrite = $request->con_rewrite;
        $fecIni = $request->con_fecIni;
        $fecFin = $request->con_fecFin;

        //usuarios desea sobreescribir registros
        if (!$rewrite) {
            //obtengo coincidencias
            $manifests = Consolidado::whereBetween('fecha_salida',[$fecIni,$fecFin]);
            //preparo mensaje
            $minDt = Carbon::parse($manifests->min('fecha_salida'))->format('d/m/Y');
            $maxDt = Carbon::parse($manifests->max('fecha_salida'))->format('d/m/Y');
            $count = $manifests->count();
            //si hay coincidencias doy aviso
            if ($count)
                return response()->json(['success' => 'true', 'message' => str_replace('count', $count, str_replace('minDt', $minDt, str_replace('maxDt', $maxDt, self::MSG_FND_RNGCNS))), 'count' => $count], 200);
        }

        //incremento capacidad de memoria en el servidor
        ini_set('memory_limit','1G');

        //obtengo lista de detalles
        $details = Manifiesto::select([
            DB::raw('manifiesto.id as manifiesto_id'),
            DB::raw('conocimiento.id as conocimiento_id'),
            DB::raw('detalle.id as detalle_id'),
            DB::raw('manifiesto.tipo as tipo_man'),
            DB::raw('manifiesto.codigo as manifiesto'),
            DB::raw('manifiesto.nave as nave'),
            DB::raw('manifiesto.empresa as empresa'),
            DB::raw('manifiesto.nro_detalles as num_detalles'),
            DB::raw('manifiesto.fec_zarpe as fecha_salida'),
            DB::raw('conocimiento.codigo as conocimiento'),
            DB::raw('conocimiento.detalle as detalle_con'),
            DB::raw('conocimiento.puerto as puerto'),
            DB::raw('conocimiento.consignatario as consignatario_con'),
            DB::raw('conocimiento.embarcador as embarcador_con'),
            DB::raw('conocimiento.fec_trans as fecha_transm'),
            DB::raw('conocimiento.bulto_man as bultos_man'),
            DB::raw('conocimiento.peso_man as peso_man'),
            DB::raw('detalle.embarcador as embarcador_det'),
            DB::raw('detalle.consignatario as consignatario_det'),
            DB::raw('detalle.marcas_numeros as marcas_numeros'),
            DB::raw('detalle.descripcion as descripcion'),
            DB::raw('detalle.bultos as num_bultos'),
            DB::raw('detalle.peso_bruto as peso_bruto'),
        ])
        ->leftJoin('conocimiento','conocimiento.manifiesto_id','manifiesto.id')
        ->leftJoin('detalle','detalle.conocimiento_id','conocimiento.id')
        ->whereNotNull('detalle.id')
        ->where(function ($query) use ($fecIni) {
            if ($fecIni)
                $query->where('manifiesto.fec_zarpe','>=',$fecIni);
            return $query;
        })
        ->where(function ($query) use ($fecFin) {
            if ($fecFin)
                $query->where('manifiesto.fec_zarpe','<=',$fecFin);
            return $query;
        })
        //->orderByRaw('manifiesto.id','conocimiento.id','detalle.id')
        ->get();

        //obtengo lista de contenedores
        $containers = Manifiesto::select([
            DB::raw('manifiesto.id as manifiesto_id'),
            DB::raw('conocimiento.id as conocimiento_id'),
            DB::raw('contenedor.id as contenedor_id'),
            DB::raw('manifiesto.tipo as tipo_man'),
            DB::raw('manifiesto.codigo as manifiesto'),
            DB::raw('manifiesto.nave as nave'),
            DB::raw('manifiesto.empresa as empresa'),
            DB::raw('manifiesto.nro_detalles as num_detalles'),
            DB::raw('manifiesto.fec_zarpe as fecha_salida'),
            DB::raw('conocimiento.codigo as conocimiento'),
            DB::raw('conocimiento.detalle as detalle_con'),
            DB::raw('conocimiento.puerto as puerto'),
            DB::raw('conocimiento.consignatario as consignatario_con'),
            DB::raw('conocimiento.embarcador as embarcador_con'),
            DB::raw('conocimiento.fec_trans as fecha_transm'),
            DB::raw('conocimiento.bulto_man as bultos_man'),
            DB::raw('conocimiento.peso_man as peso_man'),
            DB::raw('contenedor.numero as numero'),
            DB::raw('contenedor.tamanio as tamanio'),
            DB::raw('contenedor.condicion as condicion'),
            DB::raw('contenedor.tipo as tipo_cont'),
            DB::raw('contenedor.operador as operador'),
            DB::raw('contenedor.tara as tara'),
        ])
        ->leftJoin('conocimiento','conocimiento.manifiesto_id','manifiesto.id')
        ->leftJoin('contenedor','contenedor.conocimiento_id','conocimiento.id')
        ->whereNotNull('contenedor.id')
        ->where(function ($query) use ($fecIni) {
            if ($fecIni)
                $query->where('manifiesto.fec_zarpe','>=',$fecIni);
            return $query;
        })
        ->where(function ($query) use ($fecFin) {
            if ($fecFin)
                $query->where('manifiesto.fec_zarpe','<=',$fecFin);
            return $query;
        })
        //->orderByRaw('manifiesto.id','conocimiento.id','contenedor.id')
        ->get();

        //obtengo lista de detalles
        $knowledges = Manifiesto::select([
            DB::raw('manifiesto.id as manifiesto_id'),
            DB::raw('conocimiento.id as conocimiento_id'),
            DB::raw('manifiesto.tipo as tipo_man'),
            DB::raw('manifiesto.codigo as manifiesto'),
            DB::raw('manifiesto.nave as nave'),
            DB::raw('manifiesto.empresa as empresa'),
            DB::raw('manifiesto.nro_detalles as detalle'),
            DB::raw('manifiesto.fec_zarpe as fecha_salida'),
            DB::raw('conocimiento.puerto as puerto'),
            DB::raw('conocimiento.consignatario as consignatario_con'),
            DB::raw('conocimiento.embarcador as embarcador_con'),
            DB::raw('conocimiento.fec_trans as fecha_transm'),
            DB::raw('conocimiento.bulto_man as bultos_man'),
            DB::raw('conocimiento.peso_man as peso_man'),
            DB::raw('null as detalle_id'),
            DB::raw('null as contenedor_id'),
            DB::raw('null as embarcador_det'),
            DB::raw('null as consignatario_det'),
            DB::raw('null as marcas_numeros'),
            DB::raw('null as descripcion'),
            DB::raw('null as numero'),
            DB::raw('null as tamanio'),
            DB::raw('null as condicion'),
            DB::raw('null as tipo_cont'),
            DB::raw('null as operador'),
            DB::raw('null as tara'),
            DB::raw('null as num_bultos'),
            DB::raw('null as peso_bruto'),
        ])
        ->leftJoin('conocimiento','conocimiento.manifiesto_id','manifiesto.id')
        ->leftJoin('contenedor','contenedor.conocimiento_id','conocimiento.id')
        ->leftJoin('detalle','detalle.conocimiento_id','conocimiento.id')
        ->whereNull('contenedor.id')
        ->whereNull('detalle.id')
        ->where(function ($query) use ($fecIni) {
            if ($fecIni)
                $query->where('manifiesto.fec_zarpe','>=',$fecIni);
            return $query;
        })
        ->where(function ($query) use ($fecFin) {
            if ($fecFin)
                $query->where('manifiesto.fec_zarpe','<=',$fecFin);
            return $query;
        })
        //->orderByRaw('manifiesto.id','conocimiento.id')
        ->get();

        $groupDet = $details->groupBy(function ($item, $key) {
            return $item['manifiesto_id'].'.'.$item['conocimiento_id'];
        });
        
        //voy llenando los manifiestos
        $manifests = [];
        foreach ($groupDet as $index => $grpDet) {
            //busco coincidencias
            $manifiesto_id = $grpDet[0]['manifiesto_id'];
            $conocimiento_id = $grpDet[0]['conocimiento_id'];
            $grpCnt = $containers->filter(function ($item) use ($manifiesto_id, $conocimiento_id) {
                return $item['manifiesto_id'] == $manifiesto_id && 
                       $item['conocimiento_id'] == $conocimiento_id;
            })->values();
            //obtengo valores generales de grupo
            $numDet = count($grpDet);
            $numCnt = count($grpCnt);
            $i = 0;
            //contenedores vacíos
            if ($grpDet[$i]['descripcion'] == 'EMPTY CONTAINERS') {
                $sum = 0;
                //suma de pesos bruto en detalle
                foreach ($grpDet as $det)
                    $sum += $det->peso_bruto;
                $grpDet[$i]['peso_bruto'] = $sum;
                $manifests[] = self::merge($grpDet[$i], $grpCnt[$i]);
            }
            //contenedores NO vacíos
            else {
                for (; $i<$numDet && $i<$numCnt; $i++) {
                    if ($grpDet[$i]['manifiesto_id'] == $grpCnt[$i]['manifiesto_id'] && 
                        $grpDet[$i]['conocimiento_id'] == $grpCnt[$i]['conocimiento_id']) {
                        $manifests[] = self::merge($grpDet[$i], $grpCnt[$i]);
                    }
                }
                if ($i < $numDet) {
                    for (; $i<$numDet; $i++)
                        $manifests[] = self::merge($grpDet[$i], []);
                }
                if ($i < $numCnt) {
                    for (; $i<$numCnt; $i++)
                        $manifests[] = self::merge([], $grpCnt[$i]);
                }
            }
        }
        //dd($manifests);
        $error = self::deleteData($fecIni, $fecFin);
        if ($error) return $error;
        return json_encode(self::insertData(array_merge($manifests, $knowledges->toArray()), $fecIni, $fecFin));
    }

    protected function merge($detail, $container) 
    {
        return [
            'manifiesto_id' => $detail['manifiesto_id'] ?? $container['manifiesto_id'],
            'conocimiento_id' => $detail['conocimiento_id'] ?? $container['conocimiento_id'],
            'detalle_id' => $detail['detalle_id'] ?? null,
            'contenedor_id' => $container['contenedor_id'] ?? null,
            'tipo_man' => $detail['tipo_man'] ?? $container['tipo_man'],
            'manifiesto' => $detail['manifiesto'] ?? $container['manifiesto'],
            'nave' => $detail['nave'] ?? $container['nave'],
            'empresa' => $detail['empresa'] ?? $container['empresa'],
            'num_detalles' => $detail['num_detalles'] ?? $container['num_detalles'],
            'fecha_salida' => $detail['fecha_salida'] ?? $container['fecha_salida'],
            'conocimiento' => $detail['conocimiento'] ?? $container['conocimiento'],
            'detalle_con' => $detail['detalle_con'] ?? $container['detalle_con'],
            'puerto' => $detail['puerto'] ?? $container['puerto'] ?? null,
            'consignatario_con' => $detail['consignatario_con'] ?? $container['consignatario_con'],
            'embarcador_con' => $detail['embarcador_con'] ?? $container['embarcador_con'],
            'fecha_transm' => $detail['fecha_transm'] ?? $container['fecha_transm'] ?? null,
            'embarcador_det' => $detail['embarcador_det'] ?? $container['embarcador_det'],
            'consignatario_det' => $detail['consignatario_det'] ?? $container['consignatario_det'],
            'marcas_numeros' => $detail['marcas_numeros'] ?? $container['marcas_numeros'],
            'descripcion' => $detail['descripcion'] ?? $container['descripcion'],
            'numero' => $container['numero'] ?? null,
            'tamanio' => $container['tamanio'] ?? null,
            'condicion' => $container['condicion'] ?? null,
            'tipo_cont' => $container['tipo_cont'] ?? null,
            'operador' => $container['operador'] ?? null,
            'tara' => $container['tara'] ?? null,
            'bultos_man' => $detail['bultos_man'] ?? $container['bultos_man'],
            'peso_man' => $detail['peso_man'] ?? $container['peso_man'],
            'num_bultos' => $detail['num_bultos'] ?? $container['num_bultos'],
            'peso_bruto' => $detail['peso_bruto'] ?? $container['peso_bruto']
        ];
    }

    protected function deleteData($fecIni, $fecFin)
    {
        $consolidados = Consolidado::whereBetween('fecha_salida',[$fecIni,$fecFin])->get();                      
        foreach ($consolidados as $cns) {
            if (!$cns->delete())
                return response()->json(['success' => 'false', 'message' => self::MSG_ERR_DLTCNS], 400);
        }
        return false;
    }

    protected function insertData($manifests, $fecIni, $fecFin) 
    {
        ini_set('max_execution_time', 3000);
        foreach ($manifests as $man) {
            //guardo el consolidado
            $consolidado = Consolidado::create($man + self::searchProduct($man['descripcion']));

            if (!$consolidado)
                return response()->json(['success' => 'false', 'message' => self::MSG_ERR_CRTCNS], 400);
        }
        //Arreglo para mostrar
        $result = Consolidado::select(
            'tipo_man',
            'manifiesto', 
            'fecha_salida', 
            'empresa',
            'nave', 
            DB::raw('count(distinct conocimiento_id) as nro_conocimientos'),
            DB::raw('count(distinct detalle_id) as nro_detalles')
        )
        ->whereBetween('fecha_salida',[$fecIni,$fecFin])
        ->groupBy(
            'tipo_man', 
            'manifiesto', 
            'fecha_salida', 
            'empresa', 
            'nave' 
        )
        ->orderByRaw(
            'tipo_man', 
            'manifiesto', 
            'fecha_salida', 
            'empresa', 
            'nave'
        )
        ->get();
        return $result;
    }

    protected function searchProduct($desc) 
    {
        $product = [
            'producto_id' => null,
            'variedad_id' => null,
            'presentacion_id' => null,
            'organico' => false
        ];

        foreach (Producto::orderByDesc(DB::raw('length(nombre)'),'nombre')->get() as $item) {
            if (self::contains($desc, $item->nombre)) { 
                $product['producto_id'] = $item->producto_id ?? $item->id;
                break;
            }
        }
    
        foreach (Variedad::where('producto_id',$product['producto_id'])->orderByDesc(DB::raw('length(nombre)'),'nombre')->get() as $item) {
            if (self::contains($desc, $item->nombre)) { 
                $product['variedad_id'] = $item->variedad_id ?? $item->id;
                break;
            }
        }

        foreach (Presentacion::orderByDesc(DB::raw('length(nombre)'),'nombre')->get() as $item) {
            if (self::contains($desc, $item->nombre)) { 
                $product['presentacion_id'] = $item->presentacion_id ?? $item->id;
                break;
            }
        }

        if (str_contains(strtoupper($desc), 'ORGANIC')) {
            $product['organico'] = true;
        }

        return $product;
    }

    protected function contains($desc, $name)
    {
        $symb = '[ .,:;()]';
        $desc = strtoupper($desc);
        $name = strtoupper($name);
        return  preg_match('/^'.$name.$symb.'/', $desc) || //inicia con...
                preg_match('/'.$symb.$name.'$/', $desc) || //termina con...
                preg_match('/'.$symb.$name.$symb.'/', $desc); //contiene...
    }

    protected static function validationErrorMessages()
    {
        return [
            'con_fecIni.required' => 'Debes ingresar obligatoriamente una fecha de inicio.',
            'con_fecIni.date_format' => 'La fecha de inicio ingresada no tiene un formato válido.',
            'con_fecIni.before_or_equal' => 'La fecha de inicio no puede ser posterior a la fecha de término.',

            'con_fecFin.required' => 'Debes ingresar obligatoriamente una fecha de término.',
            'con_fecFin.date_format' => 'La fecha de término ingresada no tiene un formato válido.',
            'con_fecFin.before' => 'La fecha de término debe ser anterior a la fecha actual.',
       ];
    }
}
