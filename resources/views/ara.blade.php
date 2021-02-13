@extends("layout.master")
@section("title","Aradığınız kelime : ".old("ara")." - Toplamda bulunan kayıt sayısı : ".count($itemsSearch))
@section("content")
<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route("anasayfa")}}">Anasayfa</a></li>
        <li class="breadcrumb-item active">Ara</li>
    </ol>
    <div class="products bg-content">
        <div class="row">
            @if(count($itemsSearch) == 0)
            <div class="col-md-12">
                Aradığınız ürün bulunamadı
            </div>
            @else
            @foreach($itemsSearch as $itemSearch)
            <div class="col-md-3 product border">
                <a href="{{route("urun",$itemSearch->slug)}}"><img
                        src="https://migros-dali-storage-prod.global.ssl.fastly.net/sanalmarket/product/10019038/yardimci-edirne-tam-yagli-beyaz-peynir-kg-b388ea.jpg">
                    <p>{{$itemSearch->urun_adi}}</p>
                    <p class="price">{{$itemSearch->fiyati}}₺</p>
                </a>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    {{$itemsSearch->appends(["ara" => old("ara")])->links()}}
</div>
@endsection