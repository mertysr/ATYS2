@extends('layouts.app')

@section('content')
    <style>
        .hasta_css tbody tr:hover{
            background-color:#eeeeee;
        }
    </style>
    @if(!\Auth::user()->hasRole('Ambulans Gorevlisi'))
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <center>
                    <form class="form-inline">
                        @csrf
                        <div class="form-group" style="margin-right:20px;">
                            <span>Hasta İsmi</span>
                            <input type="text" id="hastanin_ismi" name="isim" class="form-control">
                        </div>
                        <div class="form-group" style="margin-right:20px;">
                            <span>Hastanın Risk Durumu</span>
                            <select name="risk" id="hastanin_riski" class="form-control secili_istasyon">
                                <option value="1">Önemli</option>
                                <option value="2">Çok Önemli</option>
                                <option value="3">Riskli</option>
                                <option value="4">Çok Riskli</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <span type="submit" data-toggle="modal" data-target="#location_sec_modal" class="btn btn-primary"> Haritadan Adres Seç </span>
                        </div>
                        <div class="form-group">
                            <span onclick="hasta_ekle()" class="btn btn-primary"> Ekle </span>
                        </div>
                    </form>
                </center>
            </div>
            <div class="col-md-3"></div>
        </div><br>

        <script>
            function hasta_ekle(){
                var isim = $('#hastanin_ismi').val();
                var risk = $('#hastanin_riski').val();
                var adres_enlem = $('#location_enlem').val();
                var adres_boylam = $('#location_boylam').val();
                var adres_yer = $('#txt_location_secilen_yer').html();
                console.log(isim , risk , adres_enlem , adres_boylam , adres_yer);
                if(isim && risk && adres_enlem && adres_boylam && adres_yer){
                    $.ajax({
                        type:"post",
                        url:"/home/ajax_yeni_hasta_ekle",
                        data:{
                            _token:"{{csrf_token()}}",
                            isim:isim,
                            risk:risk,
                            adres_enlem:adres_enlem,
                            adres_boylam:adres_boylam
                        },
                        success:function(result) {
                            console.log(result);
                            if(result == "ok"){
                                location.reload();
                            }else if(result == "hata1"){
                                alert("Hasta için istasyondan kalkacak ambulans bulunamadı !");
                            }else{
                                alert("Hasta eklenemedi !");
                            }
                        }
                    });
                }else{
                    alert("Lütfen bütün alanları doldurunuz !");
                }
            }
        </script>
    @endif
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="widget">
                <div class="widget-header transparent">
                    @if(\Auth::user()->hasRole('Ambulans Gorevlisi'))
                        <h2><strong style="color:purple;">Hastalar</strong> </h2>
                    @else
                        <h2><strong>Hastalar</strong> </h2>
                    @endif
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table hasta_css">
                            <thead>
                            <tr>
                                <th><center>Adi</center></th>
                                <th><center>Risk Durumu</center></th>
                                <th><center>İstasyon</center></th>
                                <th><center>Ambulans</center></th>
                                <th><center>Hastane</center></th>
                                <th><center>Kayıt Zamanı</center></th>
                                <th data-sortable="false"><center>İzle</center></th>
                                @if(!\Auth::user()->hasRole('Gorevli') && !\Auth::user()->hasRole('Ambulans Gorevlisi') && !\Auth::user()->hasRole('Ziyaretci'))
                                    <th data-sortable="false"><center><span style="color:orange;">Ayar</span></center></th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($hastalar as $key_hasta => $hasta)
                                    <tr>
                                        <input type="hidden" class="hasta_id" value="{{$hasta->id}}">
                                        <td><center>{{$hasta->adi}}</center></td>
                                        <?php $risk = [1=>"Önemli",2=>"Çok Önemli",3=>"Riskli",4=>"Çok Riskli"]; ?>
                                        @if(key_exists($hasta->risk,$risk))
                                            <td><center>{{$risk[$hasta->risk]}}</center></td>
                                        @else
                                            <td><center>Belirsiz !</center></td>
                                        @endif
                                        <?php $istasyon = \App\Istasyon::where('id',$hasta->istasyon_id)->first(); ?>
                                        @if(isset($istasyon))
                                            <td><center>{{$istasyon->adi}}</center></td>
                                        @else
                                            <td><center>İstasyon Bulunamadı !</center></td>
                                        @endif
                                        <?php $ambulans = \App\Ambulans::where('id',$hasta->ambulans_id)->first(); ?>
                                        <input type="hidden" class="ambulans_id" value="{{$hasta->ambulans_id}}">
                                        @if(isset($ambulans))
                                            <td>
                                                <center>
                                                    <div class="btn-group btn-group-xs">
                                                        <a onclick="ambulans_hakkinda_detayli_bilgi(this)" data-toggle="modal" data-target=".bs-example-modal-lg" title="Ambulans Hakkında Detaylı Bilgi" class="btn btn-default">{{$ambulans->adi}}</a>
                                                    </div>
                                                </center>
                                            </td>
                                        @else
                                            <td><center>Ambulansın Adı Bulunamadı !</center></td>
                                        @endif
                                        <?php $hastane = \App\Hastane::where('id',$hasta->hastane_id)->first(); ?>
                                        <input type="hidden" class="hastane_id" value="{{$hasta->hastane_id}}">
                                        @if(isset($hastane))
                                            <td>
                                                <center>
                                                    <div class="btn-group btn-group-xs">
                                                        <a onclick="hastane_hakkinda_detayli_bilgi(this)" data-toggle="modal" data-target=".bs-example-modal-lg" title="Hastane Hakkında Detaylı Bilgi" class="btn btn-default">{{$hastane ->adi}}</a>
                                                    </div>
                                                </center>
                                            </td>
                                        @else
                                            <td><center>Hastanenin Adı Bulunamadı !</center></td>
                                        @endif
                                        <td><center>{{$hasta->created_at}}</center></td>
                                        <td>
                                            <center>
                                                <div class="btn-group btn-group-xs">
                                                    <a data-toggle="modal" data-target="#location_sec_modal2" title="İzle" class="btn btn-default hasta_takip_izle"><i class="fa fa-map-marker"></i></a>
                                                </div>
                                            </center>
                                        </td>
                                        @if(!\Auth::user()->hasRole('Gorevli')  && !\Auth::user()->hasRole('Ambulans Gorevlisi') && !\Auth::user()->hasRole('Ziyaretci'))
                                            <td>
                                                <center>
                                                    <div class="btn-group btn-group-xs">
                                                        <a href="/home/hasta/sil/{{$hasta->id}}" data-toggle="tooltip" title="Sil" class="btn btn-default"><i class="fa fa-eraser"></i></a>
                                                    </div>
                                                </center>
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

    <script>
        function ambulans_hakkinda_detayli_bilgi(event) {
            var ambulans_id= $(event).parent().parent().parent().parent().find('.ambulans_id').val();
            $.ajax({
                type:"get",
                url:"/home/ajax_ambulans_bilgisini_ver",
                data:{
                    ambulans_id:ambulans_id
                },
                success:function (result) {
                    $('.modal_ekrani').html(result);
                }
            });
        }
        function hastane_hakkinda_detayli_bilgi(event) {
            var hastane_id=$(event).parent().parent().parent().parent().find('.hastane_id').val();
            $.ajax({
                type:"get",
                url:"/home/ajax_hastane_bilgisini_ver",
                data:{
                    hastane_id:hastane_id
                },
                success:function (result) {
                    $('.modal_ekrani').html(result);
                }
            });
        }
    </script>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body modal_ekrani">
                    ...
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="form-group">
        <input id="location_enlem" name="location_enlem" type="hidden" value="" placeholder="enlem">
        <input id="location_boylam" name="location_boylam" type="hidden" value="" placeholder="boylam">
    </div>

    <div class="modal fade" id="location_sec_modal" tabindex="-1" role="dialog" aria-labelledby="location_sec_modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:850px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Harita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <span style="float: left; width:200px; min-height:50px; line-height: 50px; text-align:center; background-color:white; margin:20px 10px;" type="text" id="txt_location_secilen_yer"></span>
                    <form><input style="float: left; width:300px; height:50px; margin:20px 10px;" placeholder="Aranan Yer" type="text" id="txt_location_aranan"></form>
                    <div id="map_locations" style="width: 800px;height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="location_sec_modal2" tabindex="-1" role="dialog" aria-labelledby="location_sec_modal2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width:850px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Harita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div id="map_locations2" style="width: 800px;height: 500px;"></div>
                    <span id="gidisat"></span>
                </div>
            </div>
        </div>
    </div>


    <script>
        function getAddress(latLng) {
            geocoder.geocode( {'latLng': latLng},
                function(results, status) {
                    if(status == google.maps.GeocoderStatus.OK) {
                        if(results[0]) {
                            $('#txt_location_secilen_yer').html(results[0].formatted_address);
                        }
                        else {
                            $('#txt_location_secilen_yer').html("Bulunamadı !");
                        }
                    }
                    else {
                        $('#txt_location_secilen_yer').html(latLng.lat()+","+latLng.lng());
                    }
                }
            );
        }
        var geocoder;
        function calculateAndDisplayRoute(directionsService, directionsDisplay, locations) {
            var waypts = [];
            waypts.push({
                location: new google.maps.LatLng(locations[1][0], locations[1][1]),
                stopover: true
            });
            directionsService.route({
                origin: new google.maps.LatLng(locations[0][0], locations[0][1]),
                destination: new google.maps.LatLng(locations[2][0], locations[2][1]),
                waypoints: waypts,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    var route = response.routes[0];
                    var summaryPanel = document.getElementById('gidisat');
                    summaryPanel.innerHTML = '<br>';
                    // For each route, display summary information.
                    for (var i = 0; i < route.legs.length; i++) {
                        var routeSegment = i + 1;
                        summaryPanel.innerHTML += '<b>Yön: ' + routeSegment +
                            '</b><br>';
                        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
                        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                    }
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });

        }

        function initAutocomplete() {
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var map2 = new google.maps.Map(document.getElementById('map_locations2'), {
                zoom: 6,
                center: {lat: 41.85, lng: -87.65}
            });
            directionsDisplay.setMap(map2);
            $('.hasta_takip_izle').click(function () {
                var hasta_id = $(this).parent().parent().parent().parent().find('.hasta_id').val();
                $.ajax({
                    type:"get",
                    url:"/home/ajax_hastanin_gidecegi_yeri_getir",
                    data:{
                        hasta_id:hasta_id
                    },
                    success:function (result) {
                        if(result!="hata"){
                            calculateAndDisplayRoute(directionsService, directionsDisplay, result);
                        }else{
                            alert("Bu Hastanın Kaydı Hatalı !");
                        }
                    }
                });
            });


            var map = new google.maps.Map(document.getElementById('map_locations'), {
                center: {lat: 38.657416, lng: 39.220811},
                zoom: 13,
                mapTypeId: 'roadmap'
            });
            geocoder = new google.maps.Geocoder();
            var ctrlkey=false;
            google.maps.event.addDomListener(document, 'keydown', function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==17){//ctrl tuşu
                    ctrlkey=true;
                }
            });
            google.maps.event.addDomListener(document, 'keyup', function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==17){
                    ctrlkey=false;
                }
            });
            google.maps.event.addListener(map,'click',function(event) {
                if(ctrlkey){//hem ctrl tuşu hemde mouse tıklama ise
                    ctrlkey=false;
                    $('#location_enlem').val(event.latLng.lat());
                    $('#location_boylam').val(event.latLng.lng());
                    getAddress(event.latLng);
                }
            });

            var katalog_ismi = document.getElementById('txt_location_secilen_yer');
            var input = document.getElementById('txt_location_aranan');

            var searchBox = new google.maps.places.SearchBox(input);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(katalog_ismi);//inputu haritaya ekler
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });


            var markers = [];

            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    $('#location_enlem').val(place.geometry.location.lat());
                    $('#location_boylam').val(place.geometry.location.lng());
                    $('#txt_location_secilen_yer').html(place["formatted_address"]);

                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {

                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
    </script>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8xFuOVXdpcW0SydyIrFPw_9wZYbwvlm0&libraries=places&callback=initAutocomplete" async defer></script>


@endsection
