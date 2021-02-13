@extends('layout.master')
@section('title','Sepet')
@section('content')

<div class="container">
    <div class="bg-content">
        <h2>Sepet</h2>
        @if(count(Cart::content())>0)
        @include('layout.partials.alert')
        <table class="table table-bordererd table-hover text-center">
            <tr>
                <th colspan="2">Ürün</th>
                <th>Adet Fiyatı</th>
                <th>Adet</th>
                <th>Tutar</th>
            </tr>
            @foreach(Cart::content() as $urunCartItem)

            <tr>
                <td style="width:120px">
                    <img src="https://picsum.photos/seed/picsum/120/100"> </td>
                <td>

                    <a href='{{route('urun',$urunCartItem->options->urunslug)}}'>{{$urunCartItem->name}}</a>
                    <form action="{{route('sepet.kaldir',$urunCartItem->rowId)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger btn-sm" value="Kaldır">
                    </form>
                </td>
                <td>{{$urunCartItem->price}}₺</td>
                <td>
                    <a class="btn btn-xs btn-default urun_azalt" data-rowid="{{$urunCartItem->rowId}}"
                        data-adet="{{$urunCartItem->qty-1}}">-</a>
                    <span class="urunadet" style="padding: 10px 20px">{{$urunCartItem->qty}}</span>
                    <a class="btn btn-xs btn-default urun_arttir" data-rowid="{{$urunCartItem->rowId}}"
                        data-adet="{{$urunCartItem->qty+1}}">+</a>
                </td>
                <td>
                    {{$urunCartItem->subtotal}}
                </td>
            </tr>
            @endforeach
            <tr>
                <th colspan="1" class="text-right"></th>
                <th class="text-center">Toplam Adet Sayısı
                    <hr />{{Cart::count()}}
                </th>
                <th class="text-center">Alt Toplam (KDVsiz)
                    <hr />{{Cart::subtotal()}}</th>
                <th class="text-center">Toplam Tutar (KDV Dahil)
                    <hr />{{Cart::tax()}}</th>
                <th class="text-center">Toplam Tutar (KDV Dahil)
                    <hr />{{Cart::total()}}</th>
            </tr>
        </table>
        <div>
            <form action="{{route("sepet.bosalt")}}" method="post">
                @csrf
                @method("DELETE")
                <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt" />
            </form>
            <a href="{{route("odeme.anasayfa")}}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
        </div>
        @else
        <p class="text-center">Sepetinizde ürün yok</p>
        @endif
    </div>
</div>

@endsection