<?php

namespace App\Http\Controllers\Duzenleme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IstasyonlarController extends Controller
{
    public function index(){
        $istasyonlar = \App\Istasyon::orderBy('adi')->get();
        return view('backend.duzenleme.istasyonlar',compact('istasyonlar'));
    }

    public function ekle(Request $request){
        $this->validate(\request(),[
            'isim'=>'required|string|max:191',
            'enlem_boylam'=>'required|string|max:191',
        ]);

        if(isset($request->isim,$request->enlem_boylam)){
            $hastane = new \App\Istasyon();
            $hastane->adi = $request->isim;
            $hastane->lat_long = $request->enlem_boylam;
            $hastane->save();
            return redirect()->back();
        }return redirect('/home');
    }

    public function sil($id){
        if(isset($id)){
            $sonuc = \App\Istasyon::where('id',$id)->delete();
            return redirect()->back();
        }return redirect('/home');
    }
}
