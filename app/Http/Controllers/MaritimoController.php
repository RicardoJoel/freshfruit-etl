<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Carbon\Carbon;
use App\Manifiesto;
use App\Conocimiento;
use App\Contenedor;
use App\Detalle;

class MaritimoController extends Controller
{
    protected const NUM_MNF_PAGINA = 10;
    protected const MSG_FND_RNGMNF = 'Se encontró count manifiestos registrados entre el minDt y el maxDt. ¿Deseas sobreescribirlos?';
    protected const MSG_ERR_CRTMNF = 'Lo sentimos, ocurrió un error mientras se intentaba crear un manifiesto.';
    protected const MSG_ERR_CRTCNM = 'Lo sentimos, ocurrió un error mientras se intentaba crear un conocimiento.';
    protected const MSG_ERR_CRTDTL = 'Lo sentimos, ocurrió un error mientras se intentaba crear un detalle.';
    protected const MSG_ERR_CRTCNT = 'Lo sentimos, ocurrió un error mientras se intentaba crear un contenedor.';
    protected const MSG_ERR_DLTMNF = 'Lo sentimos, ocurrió un error mientras se intentaba eliminar un manifiesto.';
    protected const MSG_ERR_DLTCNM = 'Lo sentimos, ocurrió un error mientras se intentaba eliminar un conocimiento.';
    protected const MSG_ERR_DLTDTL = 'Lo sentimos, ocurrió un error mientras se intentaba eliminar un detalle.';
    protected const MSG_ERR_DLTCNT = 'Lo sentimos, ocurrió un error mientras se intentaba eliminar un contenedor.';

    /**
     * Load data from the html page creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadData(Request $request)
    {
        self::validate($request, [
            'mar_rewrite' => 'required|bool',
            'mar_fecIni' => 'required|date_format:Y-m-d|before_or_equal:mar_fecFin',
            'mar_fecFin' => 'required|date_format:Y-m-d|before:today',
            'mar_nave' => 'nullable|string|max:100',
        ], self::validationErrorMessages());
        //obtengo filtros
        $rewrite = $request->mar_rewrite;
        $fecIni = Carbon::parse($request->mar_fecIni)->format('d/m/Y');
        $fecFin = Carbon::parse($request->mar_fecFin)->format('d/m/Y');
        $nave = $request->mar_nave;
        if (!$rewrite) {
            //obtengo coincidencias
            $manifests = Manifiesto::where('tipo','Marítimo')
                                ->whereBetween('fec_zarpe',[$request->mar_fecIni,$request->mar_fecFin])
                                ->where(function ($query) use ($nave) {
                                    if ($nave)
                                        $query->where('nave','like',"%$nave%");
                                    return $query;
                                });
            //preparo mensaje
            $minDt = Carbon::parse($manifests->min('fec_zarpe'))->format('d/m/Y');
            $maxDt = Carbon::parse($manifests->max('fec_zarpe'))->format('d/m/Y');
            $count = $manifests->count();
            //si hay coincidencias doy aviso
            if ($count)
                return response()->json(['success' => 'true', 'message' => str_replace('count', $count, str_replace('minDt', $minDt, str_replace('maxDt', $maxDt, self::MSG_FND_RNGMNF))), 'count' => $count], 200);
        } 
        //de lo contrario, sigo
        $client = new Client();
        $url = "http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultarManifiesto&fech_llega_ini=$fecIni&fech_llega_fin=$fecFin&matr_nave=$nave";
        $sitio = $client->request('GET', $url);
        //dd($sitio);
        
        $cont = sizeof($sitio->filter('.lnk7 a'));
        if($cont>0){
            /* Con paginado */
            $manifests = [];
            for ($i=0; $i<$cont; $i++) {
                $urls="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultarManifiesto&fech_llega_ini=$fecIni&fech_llega_fin=$fecFin&matr_nave=$nave&ConsultaManifExpMarFecha.jsp?accion=/cl-ad-itconsmanifiesto/ConsultaManifExpMarFecha.jsp&tamanioPagina=".self::NUM_MNF_PAGINA."&pagina=$i";
                //$urls="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/ConsultaManifExpMarFecha.jsp?accion=consultarManifiesto&tamanioPagina=8&pagina=0";
                $sitios = $client->request('GET', $urls);
                $manifests = array_merge($manifests, $sitios->filter('table.beta  tr.bg a')->each(function ($node) {
                    return [
                        'year' => '20'.substr($node->text(), 0, 2),
                        'code' => substr($node->text(), 3)
                    ];
                }));
            }
        }else{
                /* Sin paginado */
                $manifests = $sitio->filter('table.beta  tr.bg a')->each(function ($node) {
                return [
                    'year' => '20'.substr($node->text(), 0, 2),
                    'code' => substr($node->text(),3)
                ];
            });
        }
        /* Sin paginado */
        /*$manifests = $sitio->filter('table.beta  tr.bg a')->each(function ($node) {
            return [
                'year' => '20'.substr($node->text(), 0, 2),
                'code' => substr($node->text(),3)
            ];
        });*/
        /* Inserción de datos */ 
        $manifests = self::getData($manifests);
        /* echo('<pre>');
        dd($manifests);
        echo('</pre>'); */ 
        $error = self::deleteData($request->mar_fecIni, $request->mar_fecFin, $request->nave);
        if ($error) return $error;
        return json_encode(self::insertData($manifests));
    }

    protected function getData($manifests)
    {
        $array = [];
        foreach ($manifests as $man) {
            //'Me.SetProgressAvance()
            $array[] = self::getManifiesto($man);
            //If datManifiesto IsNot Nothing Then objManifiesto.insert_manifiesto(datManifiesto)
        }
        return $array;
    }

    protected function deleteData($fecIni, $fecFin, $nave)
    {
        $manifests = Manifiesto::where('tipo','Marítimo')
                                ->whereBetween('fec_zarpe',[$fecIni,$fecFin])
                                ->where(function ($query) use ($nave) {
                                    if ($nave)
                                        $query->where('nave','like',"%$nave%");
                                    return $query;
                                })
                                ->get();                      
        foreach ($manifests as $man) {
            /*foreach ($man->conocimientos as $con) {
                foreach ($con->detalles as $det)
                    if (!$det->delete())
                        return response()->json(['success' => 'false', 'message' => self::MSG_ERR_DLTDTL], 400);
                foreach ($con->contenedores as $cnt)
                    if (!$cnt->delete())
                        return response()->json(['success' => 'false', 'message' => self::MSG_ERR_DLTCNT], 400);
                if (!$con->delete())
                    return response()->json(['success' => 'false', 'message' => self::MSG_ERR_DLTCNM], 400);
            }*/
            if (!$man->delete())
                return response()->json(['success' => 'false', 'message' => self::MSG_ERR_DLTMNF], 400);
        }
        return false;
    }
    
    protected function getManifiesto($man)
    {
        $client = new Client();
        $year = $man['year'];
        $code = $man['code'];
        $url = "http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultarxNumeroManifiestoExportacion&CMc1_Anno=$year&CMc1_Numero=$code&CG_cadu=118&TipM=mx&CMc1_Terminal=&strMenu=-&strDepositoIn=&strDeposito=&strEmprTransporte=&strEmprTransporteIn=&strEmpresaMensa=";
        $sitio = $client->request('GET', $url);
        $iscon = false;
        $array = $sitio->filter('table')->each(function ($table) use (&$iscon, $man) {
            $item = [];
            $sub = $table->filter('tr')->each(function ($row) use (&$iscon, &$item, $man) {
                if ($iscon) $item = [];
                $row->filter('td')->each(function ($col) use (&$item) {
                    $item[] = $col->text();
                });
                if ($iscon) {//si es la tabla de conocimientos, retorno sus datos
                    $year = $man['year'];
                    $code = $man['code'];
                    $codCon = self::to_string($item[1]);
                    $codDet = self::to_string($item[3]);
                    $extInf = self::getConocimientoDetalle($year, $code, $codCon, $codDet);
                    return [
                        'puerto' => self::to_string($item[0]),
                        'codigo' => self::to_string($item[1]),
                        'master' => self::to_string($item[2]),
                        'detalle' => self::to_string($codDet),
                        'terminal' => self::to_string($item[4]),
                        'peso_org' => self::to_int($item[5]),
                        'bulto_org' => self::to_int($item[6]),
                        'peso_man' => self::to_int($item[7]),
                        'bulto_man' => self::to_int($item[8]),
                        'peso_rcb' => self::to_int($item[9]),
                        'bulto_rcb' => self::to_int($item[10]),
                        'consignatario' => self::to_string($item[11]),
                        'embarcador' => self::to_string($item[12]),
                        'fec_trans' => self::to_date($item[13]),
                        'detalles' => $extInf[0]['detalles'] ?? [],
                        'contenedores' => $extInf[1]['contenedores'] ?? [],
                    ];
                }
            });
            if ($iscon) { //si es tabla de conocimientos, retorno los conocimientos
                return $sub;
            }
            else { //de lo contrario, retorno del manifiesto
                $iscon = true;
                return [ 
                    'codigo' => self::to_string($item[1]),
                    'nro_bultos' => self::to_int($item[3]),
                    'fec_zarpe' => self::to_date($item[5]),
                    'fec_embarque' => self::to_date($item[7]),
                    'nave' => self::to_string($item[9]),
                    'nacionalidad' => self::to_string($item[11]),
                    'empresa' => self::to_string($item[13]),
                    'fec_aut_carga' => self::to_date($item[17]),
                    'fec_transmision' => self::to_date($item[19]),
                    'nro_detalles' => 0
                ];
            }
        });
        if (sizeof($array) > 1) { //tiene conocimientos
            unset($array[1][0]); //quitamos la cabecera
            $array[0]['nro_detalles'] = sizeof($array[1]); //actualizamos la cantidad de conocimientos
        }
        return $array;
    }

    protected function getConocimientoDetalle($year, $code, $codCon, $codDet)
    {
        $client = new Client();
        $url="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultarDetalleConocimientoEmbarqueExportacion&CMc2_Anno=$year&CMc2_Numero=$code&CMc2_NumDet=$codDet&CG_cadu=118&CMc2_TipM=mx&CMc2_numcon=$codCon";
        $sitio = $client->request('GET', $url);
        $iscon = false;
        return $sitio->filter('table')->each(function ($table) use (&$iscon) {
            $sub = $table->filter('tr')->each(function ($row) use ($iscon) {
                $item = [];
                $row->filter('td')->each(function ($col) use (&$item) {
                    $item[] = $col->text();
                });
                if ($iscon) return [
                    'numero' => self::to_string($item[0]),
                    'tamanio' => self::to_int($item[1]),
                    'condicion' => self::to_string($item[2]),
                    'tipo' => self::to_string($item[3]),
                    'operador' => self::to_string($item[4]),
                    'tara' => self::to_int($item[5]),
                ];
                else return [
                    'bultos' => self::to_int($item[0]),
                    'peso_bruto' => self::to_int($item[1]),
                    'empaques' => self::to_string($item[2]),
                    'embarcador' => self::to_string($item[3]),
                    'consignatario' => self::to_string($item[4]),
                    'marcas_numeros' => self::to_string(isset($item[6]) ? $item[5] : ''),
                    'descripcion' => self::to_string($item[6] ?? $item[5]),
                ];
            });
            unset($sub[0]); //quitamos la cabecera
            if ($iscon)
                return ['contenedores' => $sub];
            else {
                $iscon = true;
                return ['detalles' => $sub];
            }
        });
    }

    protected function insertData($manifests) 
    {
        ini_set('max_execution_time', 3000);
        $result = [];
        foreach ($manifests as $man) {
            /* inicializo contadores */
            $nro_conocim = $nro_detalle = $nro_contene = 0;
            /* guardo el manifiesto */
            $manifiesto = Manifiesto::create([
                'codigo' => $man[0]['codigo'],
                'nro_bultos' => $man[0]['nro_bultos'],
                'fec_zarpe' => $man[0]['fec_zarpe'],
                'fec_embarque' => $man[0]['fec_embarque'],
                'nave' => $man[0]['nave'],
                'nacionalidad' => $man[0]['nacionalidad'],
                'empresa' => $man[0]['empresa'],
                'fec_aut_carga' => $man[0]['fec_aut_carga'],
                'fec_transmision' => $man[0]['fec_transmision'],
                'nro_detalles' => $man[0]['nro_detalles'],
                'tipo' => 'Marítimo'
            ]);
            if (!$manifiesto)
                return response()->json(['success' => 'false', 'message' => self::MSG_ERR_CRTMNF], 400);

            if (sizeof($man) > 1) {
                foreach ($man[1] as $cnm) {
                    /* guardo los conocimientos */
                    $conocimiento = Conocimiento::create([
                        'codigo' => $cnm['codigo'],
                        'puerto' => $cnm['puerto'],
                        'master' => $cnm['master'],
                        'detalle' => $cnm['detalle'],
                        'terminal' => $cnm['terminal'],
                        'peso_org' => $cnm['peso_org'],
                        'bulto_org' => $cnm['bulto_org'],
                        'peso_man' => $cnm['peso_man'],
                        'bulto_man' => $cnm['bulto_man'],
                        'peso_rcb' => $cnm['peso_rcb'],
                        'bulto_rcb' => $cnm['bulto_rcb'],
                        'consignatario' => $cnm['consignatario'],
                        'embarcador' => $cnm['embarcador'],
                        'fec_trans' => $cnm['fec_trans'],
                        'manifiesto_id' => $manifiesto->id
                    ]);
                    if (!$conocimiento)
                        return response()->json(['success' => 'false', 'message' => self::MSG_ERR_CRTCNM], 400); 
                    $nro_conocim++;
                    /* guardo los detalles */
                    foreach ($cnm['detalles'] as $det) {
                        $detalle = Detalle::create([
                            'bultos' => $det['bultos'],
                            'peso_bruto' => $det['peso_bruto'],
                            'empaques' => $det['empaques'],
                            'embarcador' => $det['embarcador'],
                            'consignatario' => $det['consignatario'],
                            'marcas_numeros' => $det['marcas_numeros'],
                            'descripcion' => $det['descripcion'],
                            'conocimiento_id' => $conocimiento->id
                        ]);
                        if (!$detalle)
                            return response()->json(['success' => 'false', 'message' => self::MSG_ERR_CRTDTL], 400); 
                        $nro_detalle++; 
                    }
                    /* guardo los contenedores */
                    foreach ($cnm['contenedores'] as $cnt) {
                        $contenedor = Contenedor::create([
                            'numero' => $cnt['numero'],
                            'tamanio' => $cnt['tamanio'],
                            'condicion' => $cnt['condicion'],
                            'tipo' => $cnt['tipo'],
                            'operador' => $cnt['operador'],
                            'tara' => $cnt['tara'],
                            'conocimiento_id' => $conocimiento->id
                        ]);
                        if (!$contenedor)
                            return response()->json(['success' => 'false', 'message' => self::MSG_ERR_CRTCNT], 400); 
                        $nro_contene++;
                    }
                }
            }
            //Arreglo para mostrar
            $result[] = [
                'codigo' => $manifiesto->codigo,
                'fec_zarpe' => $manifiesto->fec_zarpe,
                'empresa' => $manifiesto->empresa,
                'nave' => $manifiesto->nave,
                'nro_conocimientos' => $nro_conocim,
                'nro_detalles' => $nro_detalle,
                'nro_contenedores' => $nro_contene,
            ];
        }
        return $result;
    }
    
    protected static function validationErrorMessages()
    {
        return [
            'mar_fecIni.required' => 'Debes ingresar obligatoriamente una fecha de inicio.',
            'mar_fecIni.date_format' => 'La fecha de inicio ingresada no tiene un formato válido.',
            'mar_fecIni.before_or_equal' => 'La fecha de inicio no puede ser posterior a la fecha de término.',

            'mar_fecFin.required' => 'Debes ingresar obligatoriamente una fecha de término.',
            'mar_fecFin.date_format' => 'La fecha de término ingresada no tiene un formato válido.',
            'mar_fecFin.before' => 'La fecha de término debe ser anterior a la fecha actual.',

            'mar_nave.max' => 'El nombre debe contener como máximo cincuenta (50) caracteres.',
        ];
    }
}
