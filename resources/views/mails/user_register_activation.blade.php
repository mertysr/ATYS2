<h1>Merhaba, {{ $name }}</h1>
<p>Üyeliğinin aktif olması için linke tıklamalısın.</p>
<p><a href="{{URL::to('/mail/kullanici-aktif-et/'.$code)}}">Aktifleştir</a></p>