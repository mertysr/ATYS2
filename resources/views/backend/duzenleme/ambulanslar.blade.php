@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <center>
                <form method="POST" action="/home/duzenleme/ambulanslar/ekle" class="form-inline">
                    @csrf
                    <div class="form-group" style="margin-right:20px;">
                        <span>Ambulans İsmi</span>
                        <input name="ambulans_isim" type="text" class="form-control">
                    </div>
                    <div class="form-group" style="margin-right:20px;">
                        <span>İstasyonlar</span>
                        <select name="istasyon" class="form-control secili_istasyon">
                            @foreach($istasyonlar as $key_istasyon => $istasyon)
                                <option value="{{$istasyon->id}}">{{$istasyon->adi}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin-right:20px;">
                        <span>Ambulans Numarası</span>
                        <input name="ambulans_numarasi" type="text" style="width: 100px;" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ekle</button>
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
                    <h2><strong>Ambulanslar</strong> </h2>
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
                                <th><center>Adı</center></th>
                                <th><center>İstasyon Adı</center></th>
                                <th><center>Numarası</center></th>
                                <th data-sortable="false"><center>Ayar</center></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($ambulanslar as $key_ambulans => $ambulans)
                                    <tr>
                                        <input type="hidden" class="satir_amb_id" value="{{$ambulans->id}}">
                                        <td class="satir_ambulans_adi"><center>{{$ambulans->adi}}</center></td>
                                        <?php $istasyon = \App\Istasyon::where('id',$ambulans->istasyon_id)->first(); ?>
                                        @if(isset($istasyon))
                                            <input type="hidden" class="satir_ist_id" value="{{$istasyon->id}}">
                                            <td class="satir_istasyon_adi"><center>{{$istasyon->adi}}</center></td>
                                        @else
                                            <input type="hidden" class="satir_ist_id" value="0">
                                            <td class="satir_istasyon_adi"><center>Ambulansın İstasyonu Bulunamadı !</center></td>
                                        @endif
                                        <td class="satir_ambulans_numarasi"><center>{{$ambulans->numarasi}}</center></td>
                                        <td>
                                            <center>
                                                <div class="btn-group btn-group-xs">
                                                    <a onclick="satir_guncellemek_icin_modal_ac(this)" class = "btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg" data-toggle="tooltip" style="margin-right:2px;" title="Düzenle" ><i class="fa fa-edit"></i></a>
                                                    <a href="/home/duzenleme/ambulanslar/sil/{{$ambulans->id}}" data-toggle="tooltip" title="Sil" class="btn btn-default"><i class="fa fa-eraser"></i></a>
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
    <script>
        function satir_guncellemek_icin_modal_ac(event) {
            var tr = $(event).parent().parent().parent().parent();
            console.log(tr);
            var ambulans_adi = $(tr).find('.satir_ambulans_adi').find('center').html();
            var ambulans_numarasi = $(tr).find('.satir_ambulans_numarasi').find('center').html();
            var ist_id = $(tr).find('.satir_ist_id').val();
            var amb_id = $(tr).find('.satir_amb_id').val();
            $('#guncellenecek_isim').val(ambulans_adi);
            $('#guncellenecek_istasyon').val(ist_id);
            $('#guncellenecek_id').val(amb_id);
            $('#guncellenecek_numara').val(ambulans_numarasi);
        }
    </script>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <center>
                        <form class="form-inline">
                            <input type="hidden" id="guncellenecek_id">
                            <div class="form-group" style="margin-right:20px;">
                                <span>Ambulans İsmi</span>
                                <input id="guncellenecek_isim" type="text" class="form-control">
                            </div>
                            <div class="form-group" style="margin-right:20px;">
                                <span>İstasyonlar</span>
                                <select id="guncellenecek_istasyon" class="form-control secili_istasyon">
                                    @foreach($istasyonlar as $key_istasyon => $istasyon)
                                        <option value="{{$istasyon->id}}">{{$istasyon->adi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-right:20px;">
                                <span>Ambulans Numarası</span>
                                <input id="guncellenecek_numara" type="text" style="width: 100px;" class="form-control">
                            </div>
                            <div class="form-group">
                                <span onclick="modaldaki_veriyi_guncelle()" type="submit" class="btn btn-primary">Güncelle</span>
                            </div>
                        </form>
                    </center>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        function modaldaki_veriyi_guncelle() {
            $.ajax({
                type:"post",
                url:"/home/duzenleme/ambulanslar/guncelle",
                data:{
                    _token:"{{csrf_token()}}",
                    id:$('#guncellenecek_id').val(),
                    istasyon_id:$('#guncellenecek_istasyon').val(),
                    adi:$('#guncellenecek_isim').val(),
                    numarasi:$('#guncellenecek_numara').val()
                },
                success:function (result) {
                    if(result=="ok"){
                        location.reload();
                    }else{
                        alert("veriler güncellenemedi !");
                    }
                }
            });
        }
    </script>


    <script>$(document).ready(function () {$('.open-left').click();});</script>
@endsection
