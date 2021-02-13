@extends("yonetim.layouts.master");
@section("content")
<h1 class="sub-header">{{$entry->id > 0 ? "Düzenle" : "Kaydet"}}</h1>
@include("layout.partials.error")
@include("layout.partials.alert")


@section('header_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection


<form action="{{route("yonetim.siparis.kaydet",@$entry->id)}}" enctype="multipart/form-data" method="post">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Ad Soyad</label>
                <input type="text" name="adsoyad" class="form-control" value="{{old("adsoyad",$entry->adsoyad)}}"
                    id="exampleInputEmail1" placeholder="Ad Soyad">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Telefon</label>
                <input type="text" name="telefon" class="form-control" value="{{old("telefon",$entry->telefon)}}"
                    id="exampleInputEmail1" placeholder="Ürün Fiyat">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Cep Telefon</label>
                <input type="text" name="ceptelefon" class="form-control"
                    value="{{old("ceptelefon",$entry->ceptelefon)}}" id="exampleInputEmail1" placeholder="Cep Telefon">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group ">
                <label for="exampleInputEmail1">Açıklama</label>
                <input type="text" name="adres" class="form-control" value="{{old("adres",$entry->adres)}}"
                    id="exampleInputEmail1" placeholder="Cep Telefon">
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Durum</label>
                <select name="durum" id="durum" class="form-control">
                    <option 
                        {{old("durum",$entry->durum) == 'Sipariş Alındı' ? 'selected' : ''}}>Sipariş Alındı</option>
                    <option 
                        {{old("durum",$entry->durum) == 'Ödeme Onaylandı' ? 'selected' : ''}}>Ödeme Onaylandı</option>
                    <option 
                        {{old("durum",$entry->durum) == 'Kargoya Verildi' ? 'selected' : ''}}>Kargoya Verildi</option>
                    <option 
                        {{old("durum",$entry->durum) == 'Sipariş Tamamlandı' ? 'selected' : ''}}>Sipariş Tamamlandı
                    </option>

                </select>
            </div>
        </div>

        <h2>Sipariş (SP-{{$entry->id}})</h2>
        <table class="table table-bordererd table-hover">
            <tr>
                <th colspan="2">Ürün</th>
                <th>Tutar</th>
                <th>Adet</th>
                <th>Ara Toplam</th>
                <th>Durum</th>
            </tr>
            @foreach($entry->sepet->sepet_urunler as $sepet_urun)
            <tr>
                <td> <img style="width:200px;height:200px"
                        src="{{ $sepet_urun->urun->detay->urun_resim != null ? asset("/uploads/urunler/".$sepet_urun->urun->detay->urun_resim) : "https://migros-dali-storage-prod.global.ssl.fastly.net/sanalmarket/product/10019038/yardimci-edirne-tam-yagli-beyaz-peynir-kg-b388ea.jpg" }}">
                </td>
                <td>{{$sepet_urun->urun->urun_adi}}</td>
                <td>{{$sepet_urun->fiyati}}</td>
                <td>{{$sepet_urun->adet}}</td>
                <td>{{$sepet_urun->fiyati * $sepet_urun->adet}}</td>
                <td>{{$sepet_urun->durum}}</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="5" class="text-right">Toplam Tutar</th>
                <th>{{$entry->siparis_tutari}}₺</th>
            </tr>
            <tr>
                <th colspan="5" class="text-right">Toplam Tutar (Kdv'li)</th>
                <th>{{$entry->siparis_tutari*((100+config('cart.tax'))/100)}}₺</th>
            </tr>
            <tr>
                <th colspan="5" class="text-right">Sipariş Durum Bilgisi</th>
                <th>{{$entry->siparis_durum}}</th>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary">{{$entry->id >0 ? "Güncelle" : "Kaydet "}}</button>
        @csrf
    </div>
</form>
@endsection