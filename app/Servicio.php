<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client as GuzzleClient;
use Goutte\Client as GouteClient;

class Servicio extends Model
{
    public static function siscovidBuscarPorDNI( $dni )
    {
        $guzzleClient = new GuzzleClient();

        $res = $guzzleClient->request('GET', "https://siscovid.minsa.gob.pe/ficha/api/buscar-documento/01/$dni/");

        $data = (string) $res->getBody();

        $data = (array) json_decode($data)->datos->data;

        $items = [];
        if( count($data) ){
            $item = [];
            $item['dni'] = $data['numero_documento'];
            $item['nombres'] = $data['nombres'];
            $item['apellidos'] = $data['apellido_paterno'].' '.$data['apellido_materno'];
            $item['edad'] = isset($data['edad_anios'])? $data['edad_anios']: '';
            $items[] = $item;
        }
        return $items;
    }

    public static function eldniBuscarPorDNI( $dni )
    {
        $gouteClient = new GouteClient();
        // $guzzleClient = new GuzzleClient(['base_uri'=> 'https://eldni.com']);
        // $gouteClient->setClient($guzzleClient);

        $crawler = $gouteClient->request('GET', 'https://eldni.com/buscar-por-dni');
        $form = $crawler->filter('form')->form();
        $form->setValues(['dni'=>$dni]);
        $crawler = $gouteClient->submit( $form );
        $tr = $crawler->filter('tbody > tr');


        $items = [];
        if( $tr->count() ){
            $item = [];
            $columns = $tr->filter('td');
            $item['dni'] = $dni;
            $item['nombres'] = trim($columns->eq(0)->html());
            $item['apellidos'] = trim($columns->eq(1)->html()) . ' ' . trim($columns->eq(2)->html());
            $item['edad'] = '';
            $items[] = $item;
        }
        return $items;
    }

    public static function eldniBuscarPorNombre( $nombres, $apaterno, $amaterno )
    {
        $gouteClient = new GouteClient();
        $crawler = $gouteClient->request('GET', 'https://eldni.com/buscar-por-nombres');
        $form = $crawler->filter('form')->form();
        $form->setValues([ 'nombres'=>$nombres, 'apellido_p'=>$apaterno, 'apellido_m'=>$amaterno ]);
        $crawler = $gouteClient->submit( $form );
        $rows = $crawler->filter('tbody > tr');
        $amount = $rows->count() - 1;
        $items = [];
        if( $amount > 0 ){
            for ($i=0; $i < $amount ; $i++) {
                $item = [];
                $columns = $rows->eq($i)->children();
                if( $columns->count()===4){
                    $item['dni'] = trim($columns->eq(0)->html());
                    $item['nombres'] = $columns->eq(1)->html();
                    $item['apellidos'] = trim($columns->eq(2)->html()) .' '. trim($columns->eq(3)->html());
                    $item['edad'] = '';
                    $items[] = $item;
                }
            }
        }
        return $items;
    }

    public static function localBuscarPorDNI( $dni )
    {
        return [];
    }

    public static function localBuscarPorNombre( $nombres, $apaterno, $amaterno )
    {
        return [];
    }
}
