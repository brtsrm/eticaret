@extends('layout.master')
@section('title',"Anasayfa")
@section('content')
@if(session()->has("mesaj"))
<div class="container">
    <div class="alert alert-{{session("mesaj_tur")}}" role="alert">
        <strong>{{session("mesaj")}}</strong>
    </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Kategoriler</div>
                <div class="list-group categories">
                    @foreach ($kategoriler as $kategori)
                    <a href="{{route('kategori',$kategori->slug )}}" class="list-group-item"><i
                            class="fa fa-arrow-circle-o-right"></i> {{$kategori->kategori_adi }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($urunler_slider as $urun_slider)
                    <div class="swiper-slide">
                        <img data-src="{{asset("/uploads/urunler/".$urun_slider->detay->urun_resim != null ? asset("/uploads/urunler/".$urun_slider->detay->urun_resim) : "https://migros-dali-storage-prod.global.ssl.fastly.net/sanalmarket/product/10019038/yardimci-edirne-tam-yagli-beyaz-peynir-kg-b388ea.jpg")}}"
                            class="swiper-lazy w-100">
                        <div class="swiper-lazy-preloader swiper-lazy-preloader-black"></div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination swiper-pagination-black"></div>
                <div class="swiper-button-next swiper-button-black"></div>
                <div class="swiper-button-prev swiper-button-black"></div>
            </div>

        </div>
        <div class="col-md-3">
            <div class="panel panel-default" id="sidebar-product">
                <div class="panel-heading">Günün Fırsatı</div>
                <div class="panel-body">
                    <a href="{{route('urun',$urun_gunun_firsati->slug)}}">
                        <img style="height:310px"
                            src="https://migros-dali-storage-prod.global.ssl.fastly.net/sanalmarket/product/10019038/yardimci-edirne-tam-yagli-beyaz-peynir-kg-b388ea.jpg"
                            class="img-responsive">
                        {{$urun_gunun_firsati->urun_adi}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="products">
        <div class="panel panel-theme">
            <div class="panel-heading">Öne Çıkan Ürünler</div>
            <div class="panel-body">
                <div class="row">
                    @foreach($goster_one_cikan as $urun)

                    <div class="col-md-3 product">
                        <a href="{{ route("urun",$urun->slug) }}"><img
                                src="{{ $urun->detay->urun_resim != null ? asset("/uploads/urunler/".$urun->detay->urun_resim) : "https://migros-dali-storage-prod.global.ssl.fastly.net/sanalmarket/product/10019038/yardimci-edirne-tam-yagli-beyaz-peynir-kg-b388ea.jpg"}}">
                            <p>{{$urun->urun_adi}}</p>
                            <p class="price">{{$urun->fiyati}}₺</p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="products">
        <div class="panel panel-theme">
            <div class="panel-heading">Çok Satan Ürünler</div>
            <div class="panel-body">
                <div class="row">
                    @foreach($goster_cok_satan as $urun)
                    <div class="col-md-3 product">
                        <a href="{{route('urun',$urun->slug)}}"><img
                                src="{{ $urun->detay->urun_resim != null ? asset("/uploads/urunler/".$urun->detay->urun_resim) : "https://migros-dali-storage-prod.global.ssl.fastly.net/sanalmarket/product/10019038/yardimci-edirne-tam-yagli-beyaz-peynir-kg-b388ea.jpg"}}">
                            <p class="price">{{$urun->fiyati}} ₺</p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="products">
        <div class="panel panel-theme">
            <div class="panel-heading">İndirimli Ürünler</div>
            <div class="panel-body">
                <div class="row">
                    @foreach($goster_indirimli as $urun)
                    <div class="col-md-3 product">
                        <a href="{{route('urun',$urun->slug)}}">
                            <img
                                src="{{ $urun->detay->urun_resim != null ? asset("/uploads/urunler/".$urun->detay->urun_resim) : "https://migros-dali-storage-prod.global.ssl.fastly.net/sanalmarket/product/10019038/yardimci-edirne-tam-yagli-beyaz-peynir-kg-b388ea.jpg" }}">
                            <p>{{$urun->urun_adi}}</p>
                            <p class="price">{{$urun->fiyati}} ₺</p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script>
    var swiper = new Swiper('.swiper-container', {
      // Enable lazy loading
      lazy: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

    });
</script>
@endsection