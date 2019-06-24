<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\User;
use App\Activation;

class MailController extends Controller
{
    public function kullaniciKayitActivationMail($adi,$mail,$kod){//mail e html gömmek ister isek
        $data = array('code'=>$kod,'name'=>$adi);
        Mail::send('mails.user_register_activation', $data, function($message) use ($adi,$mail) {
            $message->to($mail, $adi)->subject
            ('ATYS mail aktifleştirmek');
            $message->from('ytmproje@yandex.com','ATYS');
        });
        return redirect('/');
    }

    public function mailKullaniciAktifEt($kod){
        $activation = Activation::where('hash',$kod)->first();
        if(isset($activation)){
            User::where('id',$activation->users_id)->update(['active'=>true]);
            return redirect('/home');
        }else{
            echo "bu aktifleştirme kodu bulunamadı.";
        }
    }
}
