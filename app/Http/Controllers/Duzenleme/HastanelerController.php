<?php

namespace App\Http\Controllers\Duzenleme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HastanelerController extends Controller
{
    public function index(){
        $hastaneler = \App\Hastane::orderBy('adi')->get();
        return view('backend.duzenleme.hastaneler',compact('hastaneler'));
    }

    public function ekle(Request $request){
        $this->validate(\request(),[
            'isim'=>'required|string|max:191',
            'enlem_boylam'=>'required|string|max:191',
        ]);

        if(isset($request->isim,$request->enlem_boylam)){
            $hastane = new \App\Hastane();
            $hastane->adi = $request->isim;
            $hastane->lat_long = $request->enlem_boylam;
            $hastane->save();
            return redirect()->back();
        }return redirect('/home');
    }

    public function sil($id){
        if(isset($id)){
            $sonuc = \App\Hastane::where('id',$id)->delete();
            return redirect()->back();
        }return redirect('/home');
    }

    public function ajax_hastane_bilgisini_ver(Request $request){
        if(isset($request->hastane_id)){
            $hastane = \App\Hastane::where('id',$request->hastane_id)->first();
            if (isset($hastane)){
                return '
                        <div style="width: 400px;height:auto; margin:0 auto;">
                            <b>Hastane Adı : </b>'.$hastane->adi.'<br>
                            <b>Hastane Enlem Ve Boyu : </b>'.$hastane->lat_long.'
                        </div>
                ';
            }
        }return "hata";
    }
}
