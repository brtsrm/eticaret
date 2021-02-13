<h1>{{config('app.name')}}</h1>
<p>Başarılı</p>
<p>Kaydınızı aktifleştirme için 
    <a href='{{config("app.url")}}/kullanici/aktiflestir/{{$kullanici->aktivasyon_anahtari}}'>Tıklayın</a>
</p>