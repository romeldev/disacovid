<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\Prueba;
use App\Distrito;
use App\Ficha;
use App\Http\Resources\PruebaResource;

class CommonController extends Controller
{
    public function index(Request $request)
    {
        switch($request->resource)
        {
            case 'get-historial': return $this->getHistorial( $request );

            case 'buscar-persona': return $this->buscarPersona( $request );

            case 'buscar-ficha-persona': return $this->buscarPersonaFicha( $request );

            case 'get-meta-form-ficha': return $this->getMetaFormFicha( $request );

            default: return null;
        }
    }

    private function getHistorial( $request )
    {
        return Ficha::where('persona_documento', $request->documento)->orderBy('fecha_recepcion', 'desc')->get();
    }

    private function buscarPersonaFicha( $request )
    {
        $request->validate([
            'by' => 'required',
            'word' => 'required',
        ]);

        $ficha = Ficha::where($request->by, 'like', "%$request->word%")
            ->orderBy('fecha_toma_muestra', 'desc')->first();

        return $ficha;
    }

    private function getMetaFormFicha( $request )
    {
        $data['pruebas'] = PruebaResource::collection( Prueba::all() );
        $data['distritos'] = Distrito::all();
        return response()->json( $data, 200);
    }

    private function buscarPersona($request)
    {
        if( $request->buscar_por === 'dni'){
            $request->validate([
                'dni'=>'required|numeric'
            ]);
        }else{
            $request->validate([
                'nombres'=>'required|string',
                'apaterno'=>'required|string',
                'amaterno'=>'required|string',
            ]);
        }

        if( $request->servicio==='eldni')
        {
            if( $request->buscar_por==='dni'){
                return Servicio::eldniBuscarPorDNI($request->dni);
            }else if ($request->buscar_por==='nombre'){
                return Servicio::eldniBuscarPorNombre($request->nombres, $request->apaterno, $request->amaterno);
            }
        }

        if( $request->servicio==='siscovid')
        {
            if( $request->buscar_por==='dni'){
                return Servicio::siscovidBuscarPorDNI($request->dni);
            }
        }

        if( $request->servicio==='local')
        {
            if( $request->buscar_por==='dni'){
                return Servicio::localBuscarPorDNI($request->dni);
            }else if ($request->buscar_por==='nombre'){
                return Servicio::localBuscarPorNombre($request->nombres, $request->apaterno, $request->amaterno);
            }
        }

        return false;
    }

    private function buscarPorDNI($request)
    {
        $request->validate(['dni'=>'required|numeric']);

        return Servicio::buscarPorDNI($request->dni);
    }

    private function buscarPorDNIFull($request)
    {
        $request->validate(['dni'=>'required|numeric']);
        return Servicio::buscarPorDNIFull($request->dni);
    }

    private function buscarPorNombre($request)
    {
        $request->validate([
            'nombres'=>'required|string',
            'apaterno'=>'required|string',
            'amaterno'=>'required|string',
        ]);
        return Servicio::buscarPorNombre($request->nombres, $request->apaterno, $request->amaterno);
    }
    
}
