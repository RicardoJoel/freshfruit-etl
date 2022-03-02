<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Carbon\Carbon;
use App\Manifiesto;
use App\Conocimiento;
use App\Contenedor;
use App\Detalle;

class ProvinciaController extends Controller
{
    protected const NUM_DIS = 0;
    protected const NUM_INTENTOS = 10;
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
    public function loadData(Request $request) 
    {
        self::validate($request, [
            'pro_rewrite' => 'required|bool',
            'pro_anio' => 'required|date_format:Y',
            'pro_numManifest' => 'nullable|string|max:10'
        ], self::validationErrorMessages());

        //obtengo filtros
        $rewrite = $request->pro_rewrite;
        $year = $request->pro_anio;
        $code = $request->pro_numManifest;
        $aduana = $request->pro_codAduana;

        if ($code) {
            //usuarios desea sobreescribir registros
            if (!$rewrite) {
                //obtengo coincidencias
                $manifests = Manifiesto::where('tipo','Provincia')->where('codigo','like','%'.$year.' - '.$code);
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
            $url="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultaManifExpProvincia&salidaPro=YES&strMenu=-&strDepositoIn=&strDeposito=&strEmprTransporte=&strEmprTransporteIn=&strEmpresaMensa=&strEmpTransTerrestre=-&CMc1_Anno=$year&CMc1_Numero=$code&CG_cadu=$aduana&viat=1";
            //Extracción de datos
            $sitio = $client->request('GET', $url);
            if (str_contains($sitio->text(), "No se Encuentra');")) return [];
            $manifest = self::getData($sitio, $year, $code, $aduana);
            if (!$manifest) return [];
            $error = self::deleteData($year, $code);
            if ($error) return $error;
            return [self::insertData($manifest)];
        }
        else {
            $max = Manifiesto::where('tipo','Provincia')->max(\DB::raw('substr(codigo,14,3)'));
            $retorno = [];
            for ($i=1; $i<=self::NUM_INTENTOS; $i++) {
                $code = $max + $i;
                //usuarios desea sobreescribir registros
                if (!$rewrite) {
                    //obtengo coincidencias
                    $manifests = Manifiesto::where('tipo','Provincia')->where('codigo','like','%'.$year.' - '.$code);
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
                $url="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultaManifExpProvincia&salidaPro=YES&strMenu=-&strDepositoIn=&strDeposito=&strEmprTransporte=&strEmprTransporteIn=&strEmpresaMensa=&strEmpTransTerrestre=-&CMc1_Anno=$year&CMc1_Numero=$code&CG_cadu=$aduana&viat=1";
                //Extracción de datos
                $sitio = $client->request('GET', $url);
                if (str_contains($sitio->text(), "No se Encuentra');")) continue;
                $manifest = self::getData($sitio, $year, $code, $aduana);
                if (!$manifest) continue;
                $error = self::deleteData($year, $code);
                if ($error) return $error;
                $retorno[] = self::insertData($manifest);
            }
            return $retorno;
        }
    }  

    protected function processData($rewrite, $year, $code, $aduana)
    {
        
    }

    protected function getData($sitio, $year, $code, $aduana)
    {
        $client = new Client();
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
                    'nro_bultos' => self::to_int($item[3]),
                    'fec_zarpe' => self::to_date($item[5]),
                    'nave' => self::to_string($item[7]),
                    'nacionalidad' => self::to_string($item[9]),
                    'empresa' => self::to_string($item[11]),
                    'nro_detalles' => 0
                ];
            }
        });
        
        $cont = sizeof($sitio->filter('.lnk7 a'));
        $block = [];
        if ($cont>0) {
            /* Con paginado */
            // extracción de los conocimientos
            for ($i=0; $i<$cont; $i++) {
                $urls ="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultaManifExpProvincia&salidaPro=YES&strMenu=-&strDepositoIn=&strDeposito=&strEmprTransporte=&strEmprTransporteIn=&strEmpresaMensa=&strEmpTransTerrestre=-&CMc1_Anno=$year&CMc1_Numero=$code&CG_cadu=$aduana&viat=1&ListManifExpPro.jsp?accion=/cl-ad-itconsmanifiesto/ListManifExpPro.jsp?&tamanioPagina=".self::NUM_MNF_PAGINA."&pagina=$i";
                $sitio = $client->request('GET', $urls);
                /*$iscon = false;
                $block = $sitio->filter('table table table')->each(function ($table) use ($year, $code, $sitio, $aduana, &$iscon) {
                    if ($iscon) {*/
                $page = $sitio->filter('table table table tr.bg')->each(function ($row) use ($year, $code, $aduana) {
                    $item = [];
                    $row->filter('td')->each(function ($col) use (&$item) {
                        $item[] = $col->text();
                    });
                    if (sizeof($item) > 0) {//si es la tabla de conocimientos, retorno sus datos
                        $codCon = $item[1];
                        $codDet = $item[3];
                        $extInf = self::getConocimientoDetalle($year, $code, $aduana, $codCon, $codDet);
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
                            'detalles' => $extInf[0]['detalles'] ?? [],
                            'contenedores' => $extInf[1]['contenedores'] ?? [],
                        ];
                    }
                });
                //unset($page[0]); //quitamos la cabecera
                //return $page;
                /*}
                else {
                    $iscon = true;
                }
                });*/
                /*echo('<pre>');
                dd($block);
                echo('</pre>');*/
                /*unset($block[0]); //quitamos la cabecera*/
                $block = array_merge($block, $page);
                //}
            }
        } 
        else {
            /* Sin paginado */
            // extracción de los conocimientos
            /*for ($i=0; $i<$cont; $i++) {
            $urls ="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultaManifExpProvincia&salidaPro=YES&strMenu=-&strDepositoIn=&strDeposito=&strEmprTransporte=&strEmprTransporteIn=&strEmpresaMensa=&strEmpTransTerrestre=-&CMc1_Anno=$year&CMc1_Numero=$code&CG_cadu=046&viat=1&ListManifExpPro.jsp?accion=/cl-ad-itconsmanifiesto/ListManifExpPro.jsp?&tamanioPagina=".self::NUM_MNF_PAGINA."&pagina=$i";
            $sitio = $client->request('GET', $urls);*/
            //$iscon = false;
            //$block = $sitio->filter('table table table')->each(function ($table) use ($year, $code) {
            //if ($iscon) {
            $block = $sitio->filter('table table table tr.bg')->each(function ($row) use ($year, $code, $aduana) {
                $item = [];
                $row->filter('td')->each(function ($col) use (&$item) {
                    $item[] = $col->text();
                });
                if (sizeof($item) > 1) {//si es la tabla de conocimientos, retorno sus datos
                    $codCon = $item[1];
                    $codDet = $item[3];
                    $extInf = self::getConocimientoDetalle($year, $code, $aduana, $codCon, $codDet);
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
                        'detalles' => $extInf[0]['detalles'] ?? [],
                        'contenedores' => $extInf[1]['contenedores'] ?? [],
                    ];
                }
            });
            //unset($page[0]); //quitamos la cabecera
            //return $page;
            /*}
            else {
                $iscon = true;
            }*/
            //});
            /*echo('<pre>');
            dd($block);
            echo('</pre>');*/
            /*unset($block[0]); //quitamos la cabecera
            $conoc = array_merge($conoc, $block[1]);
            }*/
        }
        
        $array[0]['nro_detalles'] = sizeof($block); //actualizamos la cantidad de conocimientos
        $array[] = $block;
        /*echo('<pre>');
        dd($array);
        echo('</pre>');*/
        return $array;
    }

    protected function getConocimientoDetalle($year, $code, $aduana, $codCon, $codDet)
    {
        $client = new Client();
        $url="http://www.aduanet.gob.pe/cl-ad-itconsmanifiesto/manifiestoITS01Alias?accion=consultaManifExpProvinciaDetalle&CMc2_Anno=$year&CMc2_Numero=$code&CG_cadu=$aduana&CMc2_viatra=1&CMc2_numcon=$codCon&CMc2_NumDet=$codDet";
        $sitio = $client->request('GET', $url);
        $iscon = false;
        $array = [];
        $sitio->filter('table table table')->each(function ($table) use (&$iscon, &$array) {
            $sub = $table->filter('tr.bg')->each(function ($row) use ($iscon) {
                $item = [];
                $row->filter('td')->each(function ($col) use (&$item) {
                    $item[] = $col->text();
                });
                if (sizeof($item) > 1) { //algunas tablas viene con un nunico registro "No hay información para mostrar"
                    if ($iscon) return [
                        'numero' => self::to_string($item[1]),
                        'tamanio' => self::to_int($item[2]),
                        'condicion' => self::to_string($item[3]),
                        'tipo' => self::to_string($item[4]),
                        'operador' => self::to_string($item[5]),
                        'tara' => self::to_int($item[6]),
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
                }
            });
            if (sizeof($sub) && $sub[0]) {
                if ($iscon) {
                    $array[] = ['contenedores' => $sub];
                }
                else {
                    $iscon = true;
                    $array[] = ['detalles' => $sub];
                }
            }
        });
        return $array;
    }

    protected function insertData($manif) 
    {
        ini_set('max_execution_time', 3000);
        $result = [];
        /* guardo el manifiesto */
        $manifiesto = Manifiesto::create([
            'codigo' => $manif[0]['codigo'],
            'nro_bultos' => $manif[0]['nro_bultos'],
            'fec_zarpe' => $manif[0]['fec_zarpe'],
            'nave' => $manif[0]['nave'],
            'nacionalidad' => $manif[0]['nacionalidad'],
            'empresa' => $manif[0]['empresa'],
            'nro_detalles' => $manif[0]['nro_detalles'],
            'tipo' => 'Provincia'
        ]);
        if (!$manifiesto)
            return response()->json(['success' => 'false', 'message' => self::MSG_ERR_CRTMNF], 400);
        
        /* inicializo contadores */
        $nro_conocim = $nro_detalle = $nro_contene = 0;
        foreach ($manif[1] as $cnm) {
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
                'manifiesto_id' => $manifiesto->id
            ]);
            if (!$conocimiento)
                return response()->json(['success' => 'false', 'message' => self::MSG_ERR_CRTCNM], 400);
            $nro_conocim++;

            /* guardo los detalles */
            if ($cnm['detalles'])
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
            if ($cnm['contenedores'])
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
            //Arreglo para mostrar
            /*$result[] = [
                'codigo' => $conocimiento->codigo,
                'nro_detalles' => $nro_detalle,
                'nro_contenedores' => $nro_contene,
            ];*/
        }     
        return [
            'manifiesto' => $manifiesto->codigo,
            'fec_zarpe' => $manifiesto->fec_zarpe,
            'empresa' => $manifiesto->empresa,
            'nave' => $manifiesto->nave,
            'nro_conocimientos' => $nro_conocim,
            //'conocimientos' => $result
            'nro_detalles' => $nro_detalle,
            'nro_contenedores' => $nro_contene,
        ];
    }

    //Se agregó el método deleteData
    protected function deleteData($year, $code)
    {
        $manifests = Manifiesto::where('tipo','Provincia')->where('codigo','like','%'.$year.' - '.$code)->get();
        foreach ($manifests as $man) {
            if (!$man->delete())
                return response()->json(['success' => 'false', 'message' => self::MSG_ERR_DLTMNF], 400);
        }
        return false;
    }

    protected static function validationErrorMessages()
    {
        return [
            'pro_anio.required' => 'Debes ingresar obligatoriamente un año.',
            'pro_anio.date_format' => 'El año ingresado no tiene un formato válido.',

            'pro_numManifest.required' => 'Debes ingresar obligatoriamente un manifiesto.',
            'pro_numManifest.max' => 'El tamaño del manifiesto no puede exceder los diez (10) caracteres.',
        ];
    }
}