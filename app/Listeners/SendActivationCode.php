<?php

namespace App\Listeners;

use App\Activation;
use App\Events\UserRegistered;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendActivationCode
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $users_id = User::where('username',$event->user->username)->first()->id;
        $hash=str_replace('/', '-', Hash::make($event->user->username.(string)(10*$users_id+5)));
        Activation::create([
            'users_id' =>$users_id,
            'hash'=>$hash
        ]);
        app('App\Http\Controllers\MailController')->kullaniciKayitActivationMail($event->user->name,$event->user->email,$hash);
    }
}
