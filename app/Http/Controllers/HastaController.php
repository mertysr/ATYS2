<?php

namespace App\Http\Controllers;

use App\Ambulans;
use Illuminate\Http\Request;

class HastaController extends Controller
{
    public function sil($id){
        if (isset($id)){
            $hasta = \App\Hasta::where('id',$id)->first();
            if (isset($hasta)){
                $ambulans = \App\Ambulans::where('id',$hasta->ambulans_id)->first();
                if (isset($ambulans)){
                    $ambulans->dolu_mu=0;
                    $ambulans->save();
                }
                \App\Hasta::where('id',$id)->delete();
                return redirect()->back();
            }
        }return redirect('/home');
    }

    public function ajax_yeni_hasta_ekle(Request $request){
        /*
        $request->isim
        $request->risk
        $request->adres_enlem
        $request->adres_boylam
        */
        if(isset($request->isim,$request->risk,$request->adres_enlem,$request->adres_boylam)){
            $istasyonlar = \App\Istasyon::all();
            $istasyon_farklar = [];
            foreach ($istasyonlar as $key_istasyon => $istasyon){
                $enlem_ist = explode(",",$istasyon->lat_long)[0];
                $boylam_ist = explode(",",$istasyon->lat_long)[1];
                $fark = sqrt(pow($enlem_ist-$request->adres_enlem,2)+pow($boylam_ist-$request->adres_boylam,2));
                $istasyon_farklar[]=[$fark,$istasyon->id];
            }
            $hastaneler = \App\Hastane::all();
            $hastane_farklar = [];
            foreach ($hastaneler as $key_hastane => $hastane){
                $enlem_ist = explode(",",$hastane->lat_long)[0];
                $boylam_ist = explode(",",$hastane->lat_long)[1];
                $fark = sqrt(pow($enlem_ist-$request->adres_enlem,2)+pow($boylam_ist-$request->adres_boylam,2));
                $hastane_farklar[]=[$fark,$hastane->id];
            }
            $en_kucuk_istasyon = 100;
            $eklenecek_istasyon_id = 0;
            foreach ($istasyon_farklar as $fark){
                if($en_kucuk_istasyon > $fark[0]){
                    $en_kucuk_istasyon = $fark[0];
                    $eklenecek_istasyon_id = $fark[1];
                }
            }
            $en_kucuk_hastane = 100;
            $eklenecek_hastane_id = 0;
            foreach ($hastane_farklar as $fark){
                if($en_kucuk_hastane > $fark[0]){
                    $en_kucuk_hastane = $fark[0];
                    $eklenecek_hastane_id = $fark[1];
                }
            }
            $ambulans = \App\Ambulans::where('istasyon_id',$eklenecek_istasyon_id)->where('dolu_mu',0)->first();
            if(isset($ambulans)){
                $hasta = new \App\Hasta();
                $hasta->istasyon_id = $eklenecek_istasyon_id;
                $hasta->hastane_id = $eklenecek_hastane_id;
                $hasta->ambulans_id = $ambulans->id;
                $hasta->risk = $request->risk;
                $hasta->adi = $request->isim;
                $hasta->lat_long = $request->adres_enlem.",".$request->adres_boylam;
                $hasta->save();
                $ambulans->dolu_mu = 1;
                $ambulans->save();
                return "ok";
            }return "hata1";

        }return "hata2";
    }

    public function ajax_hastanin_gidecegi_yeri_getir(Request $request){
        if($request->hasta_id){
            $hasta = \App\Hasta::where('id',$request->hasta_id)->first();
            $istasyon = \App\Istasyon::where('id',$hasta->istasyon_id)->first();
            $hastane = \App\Hastane::where('id',$hasta->hastane_id)->first();
            if(isset($hasta,$istasyon,$hastane)){
                $result = [
                    [explode(",",$istasyon->lat_long)[0],explode(",",$istasyon->lat_long)[1]],
                    [explode(",",$hasta->lat_long)[0],explode(",",$hasta->lat_long)[1]],
                    [explode(",",$hastane->lat_long)[0],explode(",",$hastane->lat_long)[1]]
                ];
                return $result;
            }return "hata";
        }return "hata";
    }
}
