<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function basico($numero) {
        $valor = array ('uno','dos','tres','cuatro','cinco','seis','siete','ocho','nueve','diez',
            'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve',
            'veinte', 'veintiuno', 'veintidos', 'veintitres', 'veinticuatro', 'veinticinco', 'veintiséis','veintisiete','veintiocho','veintinueve');
        return $valor[$numero - 1];
    }

    private function decenas($n) {
        $decenas = array (30=>'treinta',40=>'cuarenta',50=>'cincuenta',60=>'sesenta',70=>'setenta',80=>'ochenta',90=>'noventa');
        if( $n <= 29) return $this->basico($n);
        $x = $n % 10;
        if ( $x == 0 ) {
            return $decenas[$n];
        } else
            return $decenas[$n - $x].' y '.$this->basico($x);
    }

    private function centenas($n) {
        $cientos = array (100 =>'cien',200 =>'doscientos',300=>'trecientos',
            400=>'cuatrocientos', 500=>'quinientos',600=>'seiscientos',
            700=>'setecientos',800=>'ochocientos', 900 =>'novecientos');
        if( $n >= 100) {
            if ( $n % 100 == 0 ) {
                return $cientos[$n];
            } else {
                $u = (int) substr($n,0,1);
                $d = (int) substr($n,1,2);
                return (($u == 1)?'ciento':$cientos[$u*100]).' '.$this->decenas($d);
            }
        } else
            return $this->decenas($n);
    }

    private function miles($n) {
        if($n > 999) {
            if( $n == 1000)
                return 'mil';
            else {
                $l = strlen($n);
                $c = (int)substr($n,0,$l-3);
                $x = (int)substr($n,-3);
                if($c == 1) {$cadena = 'mil '.$this->centenas($x);}
                else if($x != 0) {$cadena = $this->centenas($c).' mil '.$this->centenas($x);}
                else $cadena = $this->centenas($c). ' mil';
                return $cadena;
            }
        } else
            return $this->centenas($n);
    }

    private function millones($n) {
        if($n == 1000000) {return 'un millón';}
        else {
            $l = strlen($n);
            $c = (int)substr($n,0,$l-6);
            $x = (int)substr($n,-6);
            if($c == 1) {
                $cadena = ' millón ';
            } else {
                $cadena = ' millones ';
            }
            return $this->miles($c).$cadena.(($x > 0)?$this->miles($x):'');
        }
    }

    public function convertir($n) {
        switch (true) {
            case ( $n >= 1 && $n <= 29) : return $this->basico($n); break;
            case ( $n >= 30 && $n < 100) : return $this->decenas($n); break;
            case ( $n >= 100 && $n < 1000) : return $this->centenas($n); break;
            case ($n >= 1000 && $n <= 999999): return $this->miles($n); break;
            case ($n >= 1000000): return $this->millones($n);
        }
    }

    public function getAccessToken(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://accounts.zoho.com/oauth/v2/token?client_id=1000.9FGHBDOJ3Q930ODLM822GFHLWKQDEH&grant_type=refresh_token&client_secret=f2f909f0da7e6eecfd3ab1a9ea770f9e653c1b9dc9&refresh_token=1000.a6df690d348b2fdfe5362836776c5df0.d86740f8481b2498987919b140c2b5a8");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);

        $infoObj = json_decode($server_output);
        curl_close ($ch);
        if( isset($infoObj->access_token) ) {
            Request()->session()->put('access_token', $infoObj->access_token);
            return true;
        }
        return false;
    }

    public function getInvoiceList($oauth_token, $server_url, $page, $page_limit, $search_text){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$server_url."&page=".$page."&per_page=".$page_limit."&search_text=".$search_text);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Zoho-oauthtoken '.$oauth_token,
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8"'
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);

        return json_decode($server_output);
    }

    public function getInvoiceObj($oauth_token, $server_url, $creditnote_id){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$server_url.$creditnote_id."?organization_id=633541911");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Zoho-oauthtoken '.$oauth_token,
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8"'
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);

        return json_decode($server_output);
    }
}
