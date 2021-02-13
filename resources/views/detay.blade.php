@extends("layout.master")
@section('title','Siparişler')
@section('content')

<div class="container">
    <div class="bg-content">
        <h2>Sipariş (SP-{{$siparis->id}})</h2>
        <table class="table table-bordererd table-hover">
            <tr>
                <th colspan="2">Ürün</th>
                <th>Tutar</th>
                <th>Adet</th>
                <th>Ara Toplam</th>
                <th>Durum</th>
            </tr>
            @foreach($siparis->sepet->sepet_urunler as $sepet_urun)
            <tr>
                <td> <img src="http://lorempixel.com/120/100/food/2"> </td>
                <td>{{$sepet_urun->urun->urun_adi}}</td>
                <td>{{$sepet_urun->fiyati}}</td>
                <td>{{$sepet_urun->adet}}</td>
                <td>{{$sepet_urun->fiyati * $sepet_urun->adet}}</td>
                <td>{{$sepet_urun->durum}}</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="5" class="text-right">Toplam Tutar</th>
                <th>{{$siparis->siparis_tutari}}₺</th>
            </tr>
            <tr>
                <th colspan="5" class="text-right">Toplam Tutar (Kdv'li)</th>
                <th>{{$siparis->siparis_tutari*((100+config('cart.tax'))/100)}}₺</th>
            </tr>
            <tr>
                <th colspan="5" class="text-right">Sipariş Durum Bilgisi</th>
                <th>{{$siparis->siparis_durum}}</th>
            </tr>
        </table>
    </div>
</div>

@endsection