<?php

namespace App\Http\Controllers\Duzenleme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmbulanslarController extends Controller
{
    public function index(){
        $istasyonlar = \App\Istasyon::orderBy('adi')->get();
        $ambulanslar = \App\Ambulans::orderBy('adi')->get();
        return view('backend.duzenleme.ambulanslar',compact('istasyonlar','ambulanslar'));
    }

    public function ekle(Request $request){
        $this->validate(\request(),[
            'istasyon'=>'required|integer',
            'ambulans_isim'=>'required|string|max:191',
            'ambulans_numarasi'=>'required|string|max:191',
        ]);

        if(isset($request->istasyon,$request->ambulans_isim,$request->ambulans_numarasi)){
            $ambulans = new \App\Ambulans();
            $ambulans->istasyon_id = $request->istasyon;
            $ambulans->adi = $request->ambulans_isim;
            $ambulans->numarasi = $request->ambulans_numarasi;
            $ambulans->save();
            return redirect()->back();
        }return redirect('/home');
    }

    public function guncelle(Request $request){
        if(isset($request->id,$request->istasyon_id,$request->adi,$request->numarasi)){
            $istasyon = \App\Istasyon::where('id',$request->istasyon_id)->first();
            $ambulans = \App\Ambulans::where('id',$request->id)->first();
            if (isset($istasyon,$ambulans)){
                $ambulans->fill($request->all());
                $ambulans->save();
                return "ok";
            }return "hata1";
        }return "hata2";
    }

    public function sil($id){
        if(isset($id)){
            $sonuc = \App\Ambulans::where('id',$id)->delete();
            return redirect()->back();
        }return redirect('/home');
    }

    public function ajax_ambulans_bilgisini_ver(Request $request){
        if(isset($request->ambulans_id)){
            $ambulans = \App\Ambulans::where('id',$request->ambulans_id)->first();
            if (isset($ambulans)){
                return '
                        <div style="width: 400px;height:auto; margin:0 auto;">
                            <b>Ambulansın Adı : </b>'.$ambulans->adi.'<br>
                            <b>Ambulansın Numarası : </b>'.$ambulans->numarasi.'
                        </div>
                ';
            }
        }return "hata";
    }
}
