@extends("yonetim.layouts.master");
@section("content")
<h1 class="sub-header">{{$entry->id > 0 ? "Düzenle" : "Kaydet"}}</h1>
@include("layout.partials.error")
<form action="{{route("yonetim.urunler.kaydet",@$entry->id)}}" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Ad Soyad</label>
                <input type="text" name="adsoyad" class="form-control" value="{{old("adsoyad",$entry->adsoyad)}}"
                    id="exampleInputEmail1" placeholder="Email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Mail Adresi</label>
                <input type="email" name="email" class="form-control" value="{{old("email",$entry->email)}}"
                    id="exampleInputEmail1" placeholder="Email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputPassword1">Şifre</label>
                <input type="password" name="sifre" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputPassword1">Cep Telefon</label>
                <input type="text" name="ceptelefon" value="{{old("ceptelefon",$entry->detay->ceptelefon)}}"
                    class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputPassword1">Ev Telefon</label>
                <input type="text" name="telefon" value="{{old("telefon",$entry->detay->telefon)}}" class="form-control"
                    id="exampleInputPassword1" placeholder="Password">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="address">Adres</label>
                <input type="text" name="adres" class="form-control" value="{{old("adres",$entry->detay->adres)}}"
                    id="address" placeholder="Address">
            </div>
        </div>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="aktif_mi" {!! ($entry->aktif_mi == 1) ? 'checked' : '' !!}> Aktif mi
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="yoneticimi" {!! ($entry->yoneticimi == 1) ? 'checked' : '' !!} >
            Yönetici mi
        </label>
    </div>
    <button type="submit" class="btn btn-primary">{{$entry->id >0 ? "Güncelle" : "Kaydet "}}</button>
    @csrf
</form>
@endsection