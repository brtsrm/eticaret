<div class="row">
    <div class="col-sm-3 col-md-3 col-lg-2 sidebar collapse" id="sidebar">
        <div class="list-group">
            <a href="{{route("yonetim.anasayfa")}}" class="list-group-item">
                <span class="fa fa-fw fa-dashboard"></span> Anasayfa</a>
            <a href="{{route("yonetim.urunler")}}" class="list-group-item">
                <span class="fa fa-fw fa-dashboard"></span> Ürünler
                <span class="badge badge-dark badge-pill pull-right">14</span>
            </a>
            <a href="#" class="list-group-item collapsed" data-target="#submenu1" data-toggle="collapse"
                data-parent="#sidebar"><span class="fa fa-fw fa-dashboard"></span> Kategori<span
                    class="caret arrow"></span></a>
            <div class="list-group collapse" id="submenu1">
                <a href="{{route("yonetim.kategori")}}" class="list-group-item">Kategoriler</a>
                <a href="#" class="list-group-item">Category</a>
            </div>
            <a href="{{route("yonetim.kullanici")}}" class="list-group-item">
                <span class="fa fa-fw fa-dashboard"></span> Kullanıclar
                <span class="badge badge-dark badge-pill pull-right">14</span>
            </a>
            <a href="{{route("yonetim.siparis")}}" class="list-group-item">
                <span class="fa fa-fw fa-dashboard"></span> Siparişler
                <span class="badge badge-dark badge-pill pull-right">14</span>
            </a>
        </div>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 main">