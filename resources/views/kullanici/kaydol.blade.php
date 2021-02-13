@extends("layout.master")
@section("title","Kaydol")
@section("content")

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Kaydol</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{route('kaydol')}}">

                        <div class="form-group {{$errors->has("adsoyad") ? "has-error" : ""}}">
                            <label for="name" class="col-md-4 control-label">Ad Soyad</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="adsoyad" value="" required
                                    autofocus>
                                @if($errors->has("adsoyad"))
                                <span class="help-block">
                                    {{$errors->first("adsoyad")}}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has("adsoyad") ? "has-error" : ""}}">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="">
                                @if($errors->has("email"))
                                <span class="help-block">
                                    {{$errors->first("email")}}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Şifre</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="sifre" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Şifre (Tekrar)</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="sifre_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Kaydol
                                </button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection