@extends("yonetim.layouts.master")
@section("content")

<h1 class="page-header">Ürün Yönetimi</h1>
<h3 class="sub-header">
    Ürünleri Listele
</h3>

<div class="row" style="background-color:#eee;padding:20px; border-radius:20px;margin-bottom:10px;">

    <form method="post" action="{{route("yonetim.urunler.arama")}}">

        <div class="col-md-7">
            <div class="form-group">
                <label for="">Kullanici Arama</label>
                @csrf
                <input type="text" value="{{old("arama")}}" name="arama" id="" class="form-control" placeholder=""
                    aria-describedby="helpId">
                <input name="ara" type="submit" id="" value="Ara" class="btn btn-primary" />
            </div>
        </div>
    </form>
    <div class="btn-group pull-right" role="group" aria-label="Basic example">
        <a href="{{route("yonetim.urunler.yeni")}}" class="btn btn-primary">Yeni Kayıt</a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Slug</th>
                <th>Ürün Adı</th>
                <th>Fiyatı</th>
                <th>Kayıt Tarihi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $entry)
            <tr>
                <td>{{$entry->id}}</td>
                <td>{{$entry->slug}}</td>

                <td>{{$entry->urun_adi}}</td>
                <td>{{$entry->fiyati}} ₺</td>
                <td>{{$entry->created_at}}</td>
                <td style="width: 100px">
                    <a href="{{route("yonetim.urunler.duzenle",$entry->id)}}" class="btn btn-xs btn-success"
                        data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route("yonetim.urunler.sil",$entry->id)}}" class="btn btn-xs btn-danger"
                        data-toggle="tooltip" data-placement="top" title="Tooltip on top"
                        onclick="return confirm('Are you sure?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$list->appends("arama",old("arama"))->links()}}
</div>
@endsection