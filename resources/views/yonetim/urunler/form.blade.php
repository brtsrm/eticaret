@extends("yonetim.layouts.master");
@section("content")
<h1 class="sub-header">{{$entry->id > 0 ? "Düzenle" : "Kaydet"}}</h1>
@include("layout.partials.error")
@include("layout.partials.alert")


@section('header_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection


<form action="{{route("yonetim.urunler.kaydet",@$entry->id)}}" enctype="multipart/form-data" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Ürün Adı</label>
                <input type="text" name="urun_adi" class="form-control" value="{{old("kategori_adi",$entry->urun_adi)}}"
                    id="exampleInputEmail1" placeholder="Ürün Adı">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Ürün Fiyatı</label>
                <input type="text" name="fiyati" class="form-control" value="{{old("kategori_adi",$entry->fiyati)}}"
                    id="exampleInputEmail1" placeholder="Ürün Fiyat">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Slug</label>
                <input type="hidden" name="{{old("slug",$entry->slug)}}" name="orginial_slug" />
                <input type="text" name="slug" class="form-control" value="{{old("slug",$entry->slug)}}"
                    id="exampleInputEmail1" placeholder="Slug">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group ">
                <label for="exampleInputEmail1">Açıklama</label>
                <textarea type="text" name="aciklama" class="form-control" value="{{old("slug",$entry->aciklama)}}"
                    id="aciklama" placeholder="aciklama"></textarea>
            </div>
        </div>
    </div>

    <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="goster_slider" {!! ($entry->detay->goster_slider == 1) ? 'checked' :
            '' !!} >
            Slider Göster
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="goster_gunun_firsati" {!! ($entry->detay->goster_gunun_firsati == 1)
            ?
            'checked' : '' !!} >
            Günün Fırsatı
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="goster_one_cikan" {!! ($entry->detay->goster_one_cikan == 1) ?
            'checked' :
            '' !!} >
            Göster Öne Çıkan
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="goster_cok_satan" {!! ($entry->detay->goster_cok_satan == 1) ?
            'checked' :
            '' !!} >
            Çok Satan
        </label>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="1" name="goster_indirimli" {!! ($entry->detay->goster_indirimli == 1) ?
            'checked' :
            '' !!} >
            İndirimli
        </label>
    </div>

    <div class="col-md-12">
        <div class="form-group ">
            <label for="exampleInputEmail1">Kategoriler</label>

            <select name="kategoriler[]" id="kategoriler" class="form-control" multiple="multiple">

                @foreach($kategoriler as $kategori)
                <option value="{{$kategori->id}}" {{
                        collect(old('kategoriler',$urun_kategoriler))->contains($kategori->id)? 'selected' : ''
                    }}>
                    {{$kategori->kategori_adi}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        @if ($entry->detay->urun_resim!=null)
        <img src="/uploads/urunler/{{$entry->detay->urun_resim}}" alt="" class="img-thumbnail pull-left"
            style="width:200px;" />
        @endif
        <label for="urun_resim">Resim Yükle</label>
        <input type="file" class="form-control-file" name="urun_resim" />

    </div>
    <br />
    <br />
    <button type="submit" class="btn btn-primary">{{$entry->id >0 ? "Güncelle" : "Kaydet "}}</button>
    @csrf
</form>
@endsection

@section("footer_js")
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script>
    $(function(){
        $("#kategoriler").select2({});
        CKEDITOR.replace('aciklama',{
            uiColor: '#ffeeee',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        });
    })
</script>
@endsection