@extends("yonetim.layouts.master")
@section('content')
<h1 class="page-header">Dashboard</h1>

<section class="row text-center placeholders">
    <div class="col-6 col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading">Bekleyen Sipariş</div>
            <div class="panel-body">
                <h4>{{$istatistikler["bekleyenSiparis"]}}</h4>
                <p>Toplam</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading">Tamamlanan Siparis</div>
            <div class="panel-body">
                <h4>{{$istatistikler["tamamlananSiparis"]}}</h4>
                <p>Toplam</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading">Ürün</div>
            <div class="panel-body">
                <h4>{{$istatistikler["toplamUrun"]}}</h4>
                <p>Toplam</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-heading">Kullanıcı</div>
            <div class="panel-body">
                <h4>{{$istatistikler["toplamKullanici"]}}</h4>
                <p>Toplam</p>
            </div>
        </div>
    </div>
</section>


<div class="col-6 col-sm-4">
    <div class="panel panel-primary">
        <div class="panel-heading">Çok Satan Ürünler</div>
        <div class="panel-body">
            <canvas id="coksatan" width="400" height="400"></canvas>
        </div>
    </div>
</div>
<div class="col-6 col-sm-4">
    <div class="panel panel-primary">
        <div class="panel-heading">Aylara Gore Ürünler</div>
        <div class="panel-body">
            <canvas id="aylaragore" width="400" height="400"></canvas>
        </div>
    </div>
</div>
@endsection

@section('footer_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


<script>
    @php
    $labels = "";
    $data = "";
    
    foreach ($cokSatanUrunler as $rapor){
    
    $labels .= "\"$rapor->urun_adi\",";
    $data .= $rapor->adet.",";
    
    }
    
    @endphp
    var ctx = document.getElementById('coksatan');
    var coksatan = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: [{!! $labels !!}],
            datasets: [{
                data: [{!! $data !!}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            }
        }
    });
    @php
    $labels = "";
    $data = "";
    
    foreach ($aylaraGore as $rapor){
    
    $labels .= "\"$rapor->ay\",";
    $data .= $rapor->adet.",";
    
    }
    
    @endphp
    var ctx2 = document.getElementById('aylaragore');
    var aylaragore = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: [{!! $labels !!}],
            datasets: [{
                data: [{!! $data !!}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        stepSize: 1
                    }
                }]
            }
        }
    });
</script>


@endsection