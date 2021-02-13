@extends("layout.master")
@section("title",$kategori->kategori_adi)
@section("content")

<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{route("anasayfa")}}">Anasayfa</a></li>
        <li><a href="{{ $kategori->slug }}">{{ $kategori->kategori_adi}}</a></li>

    </ol>
    <div class="row">
        @if(count($urunler) != 0 )

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $kategori->kategori_adi}}</div>
                <div class="panel-body">
                    <h3>Alt Kategoriler</h3>
                    <div class="list-group categories">

                        @foreach ($alt_kategori as $altKategori)
                        <a href="{{route('kategori',$altKategori->slug) }}" class="list-group-item"><i
                                class="fa fa-circle-o"></i>{{ $altKategori->kategori_adi}}</a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="products bg-content">
                Sırala
                <a href="?order=coksatan" class="btn btn-default">Çok Satanlar</a>
                <a href="?order=yeniurun" class="btn btn-default">Yeni Ürünler</a>
                <hr>
                <div class="row">

                    @foreach($urunler as $urun)
                    <div class="col-md-3 product">
                        <a href="{{route('urun',$urun->slug)}}"><img
                                src="https://picsum.photos/seed/picsum/400/400"></a>
                        <p><a href="{{route('urun',$urun->slug)}}">{{$urun->urun_adi}}</a></p>
                        <p class="price">{{$urun->fiyati}} ₺</p>
                        <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                    </div>
                    @endforeach
                </div>
            </div>
            {{$urunler->links()}}
            @else
            <div class="w-100 p-3 alert alert-danger text-center h5" role="alert">
                <strong>Bu kategoriya daha ürün eklenmemiştir</strong>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection