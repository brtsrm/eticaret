@if(session()->has("mesaj"))
<div class="alert alert-{{session("mesaj_tur")}}" role="alert">
    <strong>{{session("mesaj")}}</strong>
</div>
@endif