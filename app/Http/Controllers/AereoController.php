<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Carbon\Carbon;
use App\Manifiesto;
use App\Conocimiento;
use App\Contenedor;
use App\Detalle;

class AereoController extends Controller
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
     * Load data from the html page
     *
     * @return \Illuminate\Http\Response
     */
    public function loadData(Request $request) {
        self::validate($request, [
            'aer_rewrite' => 'required|bool',
            'aer_fecIni' => 'required|date_format:Y-m-d|before_or_equal:aer_fecFin',
            'aer_fecFin' => 'required|date_format:Y-m-d|before:today',
        ], self::validationErrorMessages());
        //obtengo filtros
        $rewrite = $request->aer_rewrite;
        $fecIni = Carbon::parse($request->aer_fecIni)->format('d/m/Y');
        $fecFin = Carbon::parse($request->aer_fecFin)->format('d/m/Y');
        if (!$rewrite) {
            //obtengo coincidencias
            $manifests = Manifiesto::where('tipo','Aéreo')
                                ->whereBetween('fec_zarpe',[$request->aer_fecIni,$request->aer_fecFin]);
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
        $url="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultaManifiesto&fec_inicio=$fecIni&fec_fin=$fecFin&cod_terminal=0000";
        $sitio = $client->request('GET', $url);
    
        $cont = sizeof($sitio->filter('.lnk7 a'));
        if($cont>0){
            /* Con paginado */
            $manifests = [];
            //$num_dis = [];
            //$num_dis = $sitio->filter('table table td lnk7');
            //dd($num_dis);
            /* echo('<pre>');
            var_dump($num_dis);
            echo('</pre>'); */
            //$num_pagina= substr($num_dis,4,2);
            for ($i=0; $i<$cont; $i++) {
                $urls="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/ConsulManifExpAerFechList.jsp?accion=consultaManifiesto&tamanioPagina=".self::NUM_MNF_PAGINA."&pagina=$i";
                $sitio = $client->request('GET', $urls);
                $manifests = array_merge($manifests, $sitio->filter('table table table tr.bg a')->each(function ($node) {
                    return [
                        'year' => '20'.substr($node->text(), 0, 2),
                        'code' => substr($node->text(),3)
                    ];
                }));
            } 
        }else{
                /* Sin paginado */
                $manifests = $sitio->filter('table table table tr.bg a')->each(function ($node) {
                return [
                    'year' => '20'.substr($node->text(), 0, 2),
                    'code' => substr($node->text(),3)
                ];
            });
        }
        /* Inserción de datos */ 
        $manifests = self::getData($manifests);
        /*echo('<pre>');
        var_dump($manifests);
        echo('</pre>');*/
        $error = self::deleteData($request->aer_fecIni, $request->aer_fecFin);
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

    protected function deleteData($fecIni, $fecFin)
    {
        $manifests = Manifiesto::where('tipo','Aéreo')
                                ->whereBetween('fec_zarpe',[$fecIni,$fecFin])
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
        $url = "http://www.aduanet.gob.pe//cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultaManifiestoGuia&viat=4&CG_cadu=235&CMc1_Anno=$year&CMc1_Numero=$code&CMc1_Terminal=0000";
        $sitio = $client->request('GET', $url);
        $iscon = false;
        $array = [];
        // extracción de los conocimientos
        $sitio->filter('table table table')->each(function ($table) use (&$iscon, &$array) {
            if (!$iscon) {
                $iscon = true;
                $item = [];
                $table->filter('tr')->each(function ($row) use (&$item) {
                    $row->filter('td.gamma')->each(function ($col) use (&$item) {
                        $item[] = $col->text();
                    });
                });
                //retorno del manifiesto
                $array[] = [
                    'codigo' => self::to_string($item[1]),
                    'fec_zarpe' => self::to_onlydate($item[5]),
                    'peso_bruto' => self::to_int($item[7]),
                    'aerolinea' => self::to_string($item[9]),
                    'nacionalidad' => self::to_string($item[11]),
                    'nro_vuelo' => self::to_string($item[13]),
                    'nro_bultos' => self::to_int($item[15]),
                    'fec_embarque' => self::to_onlydate($item[17]),
                    'fec_aut_carga' => self::to_onlydate($item[19]),
                    'fec_transmision' => self::to_onlydate($item[21]),
                    'nro_detalles' => 0,              
                ];
            }
        });
        // extracción de los conocimientos
        $conoc = [];
        $sitio->filter('table table table')->each(function ($table) use (&$conoc, $year, $code) {
            $table->filter('tr.bg')->each(function ($row) use (&$conoc, $year, $code) {
                $item = [];
                $row->filter('td')->each(function ($col) use (&$item) {
                    $item[] = $col->text();
                });
                if (sizeof($item) > 2) {//evitamos la descripción
                    //$codGui = ctype_digit(substr($item[0],0,1)) ? $item[0] : '0'.$item[1];
                    $codGui = '0'.$item[1];
                    $codMst = $item[1];
                    $codDet = self::to_int($item[2]);
                    $extInf = self::getConocimientoDetalle($year, $code, $codGui, $codMst, $codDet);
                    $conoc[] = [
                        'codigo' => self::to_string($codGui),
                        'master' => self::to_string($codMst),
                        'detalle' => self::to_string($codDet),
                        'terminal' => self::to_string($item[3]),
                        'peso_org' => self::to_int($item[4]),
                        'bulto_org' => self::to_int($item[5]),
                        'peso_man' => self::to_int($item[6]),
                        'bulto_man' => self::to_int($item[7]),
                        'peso_rcb' => self::to_int($item[8]),
                        'bulto_rcb' => self::to_int($item[9]),
                        'consignatario' => self::to_string($item[10]),
                        'embarcador' => self::to_string($item[11]),
                        'fec_trans' => self::to_onlydate($item[12]),
                        'detalles' => $extInf,
                    ];
                }
            });
        });
        $array[0]['nro_detalles'] = sizeof($conoc); //actualizamos la cantidad de conocimientos
        $array[] = $conoc;
        return $array;
    }

    protected function getConocimientoDetalle($year, $code, $codGui, $codMaster, $codDet)
    {
        $client = new Client();
        $url="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultarDetalleConocimientoEmbarqueExportacion&CG_cadu=235&CMc2_Anno=$year&CMc2_Numero=$code&CMc2_numcon=$codGui&CMc2_numconm=$codMaster&CMc2_NumDet=$codDet&CMc2_TipM=";
        $sitio = $client->request('GET', $url);
        $detalles = [];
        $sitio->filter('table table table tr.bg')->each(function ($row) use (&$detalles) {
            $item = [];
            $row->filter('td')->each(function ($col) use (&$item) {
                $item[] = $col->text();
            });
            if ($item[0] && $item[1] && $item[2] && $item[3] && $item[4] && $item[5] && $item[6]) {
                $detalles[] = [
                    'bultos' => self::to_int($item[0]),
                    'peso_bruto' => self::to_int($item[1]),
                    'empaques' => self::to_string($item[2]),
                    'embarcador' => self::to_string($item[3]),
                    'consignatario' => self::to_string($item[4]),
                    'marcas_numeros' => self::to_string(isset($item[6]) ? $item[5] : ''),
                    'descripcion' => self::to_string($item[6] ?? $item[5]),
                ];
            }
        });
        return $detalles;
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
                'fec_zarpe' => $man[0]['fec_zarpe'],
                'peso_bruto' => $man[0]['peso_bruto'],
                'empresa' => $man[0]['aerolinea'],
                'nacionalidad' => $man[0]['nacionalidad'],
                'nave' => $man[0]['nro_vuelo'],
                'nro_bultos' => $man[0]['nro_bultos'],
                'fec_embarque' => $man[0]['fec_embarque'],
                'fec_aut_carga' => $man[0]['fec_aut_carga'],
                'fec_transmision' => $man[0]['fec_transmision'],
                'nro_detalles' => $man[0]['nro_detalles'],
                'tipo' => 'Aéreo'
            ]);
            if (!$manifiesto)
                return response()->json(['success' => 'false', 'message' => self::MSG_ERR_CRTMNF], 400);

            if (sizeof($man) > 1) {
                foreach ($man[1] as $cnm) {
                    /* guardo los conocimientos */
                    $conocimiento = Conocimiento::create([
                        'codigo' => $cnm['codigo'],
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
                }
            }
            //Arreglo para mostrar
            $result[] = [
                'codigo' => $manifiesto->codigo,
                'fec_zarpe' => $manifiesto->fec_zarpe,
                'aerolinea' => $manifiesto->empresa,
                'nro_vuelo' => $manifiesto->nave,
                'nro_conocimientos' => $nro_conocim,
                'nro_detalles' => $nro_detalle,
            ];
        }
        return $result;
    }

    protected static function validationErrorMessages()
    {
        return [
            'aer_fecIni.required' => 'Debes ingresar obligatoriamente una fecha de inicio.',
            'aer_fecIni.date_format' => 'La fecha de inicio ingresada no tiene un formato válido.',
            'aer_fecIni.before_or_equal' => 'La fecha de inicio no puede ser posterior a la fecha de término.',

            'aer_fecFin.required' => 'Debes ingresar obligatoriamente una fecha de término.',
            'aer_fecFin.date_format' => 'La fecha de término ingresada no tiene un formato válido.',
            'aer_fecFin.before' => 'La fecha de término debe ser anterior a la fecha actual.',
        ];
    }
}