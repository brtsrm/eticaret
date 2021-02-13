<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route("anasayfa")}}">
                <img src="{{asset("/")}}img/logo.png">
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <form class="navbar-form navbar-left" method="post" action="{{route("urun_ara")}}">
                <div class="input-group">
                    <input name="ara" type="text" value="{{old("ara")}}" id="navbar-search" class="form-control"
                        placeholder="Ara">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                @csrf
            </form>
            <ul class="form-inline list-unstyle navbar-nav navbar-right">
                <li><a href="{{route("sepet")}}"><i class="fa fa-shopping-cart"></i> Sepet <span class="badge badge-theme">{{Cart::count()}}</span></a>
                </li>
                @guest
                <li><a href="{{route("oturumac")}}">Oturum Aç</a></li>
                <li><a href="{{route("kaydol")}}">Kaydol</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false"> Profil </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('siparisler')}}">Siparişlerim</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route("cikis")}}">Çıkış</a></li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>