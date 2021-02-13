@extends("yonetim.layouts.master");
@section("content")
<h1 class="sub-header">{{$entry->id > 0 ? "Düzenle" : "Kaydet"}}</h1>
@include("layout.partials.error")
@include("layout.partials.alert")
<form action="{{route("yonetim.kategori.kaydet",@$entry->id)}}" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Kategori Adi</label>
                <input type="text" name="kategori_adi" class="form-control"
                    value="{{old("kategori_adi",$entry->kategori_adi)}}" id="exampleInputEmail1" placeholder="Kategori Adı">
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
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Üst Kategori</label>
                <select name="ust_id" class="form-control">
                    <option value="">Ana Kategori Ekle</option>
                    <optgroup label="Ana Kategori">
                        @foreach ($kategoriler as $kategori)
                        @if($kategori->ust_id == null)
                        <option>{{$kategori->kategori_adi}}</option>
                        @endif
                        @endforeach
                    </optgroup>
                    <optgroup label="Alt Kategori">
                        @foreach ($kategoriler as $kategori)
                        @if($kategori->ust_id != null)
                        <option>{{$kategori->kategori_adi}}</option>
                        @endif
                        @endforeach
                    </optgroup>
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{$entry->id >0 ? "Güncelle" : "Kaydet "}}</button>
    @csrf
</form>
@endsection