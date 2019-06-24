@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <center>
                <form class="form-inline" method="POST" action="/home/duzenleme/istasyonlar/ekle">
                    @csrf
                    <div class="form-group" style="margin-right:20px;">
                        <span>İstasyon İsmi</span>
                        <input type="text" name="isim" class="form-control">
                    </div>
                    <div class="form-group" style="margin-right:20px;">
                        <span>İstasyonun Enlem ve Boylamı</span>
                        <input data-toggle="modal" data-target="#location_sec_modal" type="text" name="enlem_boylam" class="form-control enlem_boylam">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"> Ekle </button>
                    </div>
                </form>
            </center>
        </div>
        <div class="col-md-3"></div>
    </div><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="widget">
                <div class="widget-header transparent">
                    <h2><strong>İstasyonlar</strong> </h2>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table" >
                            <thead>
                            <tr>
                                <th><center>Adi</center></th>
                                <th><center>Enlem ve Boylam</center></th>
                                <th data-sortable="false"><center>Ayar</center></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($istasyonlar as $key_istasyon => $istasyon)
                                    <tr>
                                        <td><center>{{$istasyon->adi}}</center></td>
                                        <td><center>{{$istasyon->lat_long}}</center></td>
                                        <td>
                                            <center>
                                                <div class="btn-group btn-group-xs">
                                                    <a href="/home/duzenleme/istasyonlar/sil/{{$istasyon->id}}" data-toggle="tooltip" title="Sil" class="btn btn-default"><i class="fa fa-eraser"></i></a>
                                                </div>
                                            </center>
                                        </td>
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
        function initAutocomplete() {
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
                    $('.enlem_boylam').val(event.latLng.lat()+","+event.latLng.lng());
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
                    $('.enlem_boylam').val(place.geometry.location.lat()+","+place.geometry.location.lng());
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

    <script>$(document).ready(function () {$('.open-left').click();});</script>
@endsection
