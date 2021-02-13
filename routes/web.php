<?php

use App\Http\Controllers\AnasayfaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KullanicilarController;
use App\Http\Controllers\OdemeController;
use App\Http\Controllers\SepetController;
use App\Http\Controllers\SiparislerController;
use App\Http\Controllers\UrunController;
use App\Http\Controllers\Yonetim\AnasayfaController as YonetimAnasayfaController;
use App\Http\Controllers\yonetim\KategoriController as YonetimKategoriController;
use App\Http\Controllers\Yonetim\KullaniciController;
use App\Http\Controllers\Yonetim\SiparisController;
use App\Http\Controllers\Yonetim\UrunlerController as YonetimUrunController;
use Illuminate\Support\Facades\Route;

Route::prefix("yonetim")->group(function () {
    Route::redirect("/", "/yonetim/oturumac");
    Route::post('/oturumac', [KullaniciController::class, 'oturumacform'])->name("yonetim.oturumacform");
    Route::get('/oturumac', [KullaniciController::class, 'oturumac'])->name("yonetim.oturumac");
    Route::get('/oturumukapat', [KullaniciController::class, 'oturumukapat'])->name("yonetim.oturumukapat");
    Route::group(["middleware" => "yoneticiMiddleware"], function () {
        Route::get('/anasayfa', [YonetimAnasayfaController::class, 'index'])->name("yonetim.anasayfa");

        Route::prefix('kullanici')->group(function () {
            Route::get("/", [KullaniciController::class, "index"])->name("yonetim.kullanici");
            Route::post("/", [KullaniciController::class, "arama"])->name("yonetim.kullanici.arama");
            Route::get("/yenxi", [KullaniciController::class, "form"])->name("yonetim.kullanici.yeni");
            Route::get("/duzenle/{id}", [KullaniciController::class, "form"])->name("yonetim.kullanici.duzenle");
            Route::post("/kaydet/{id?}", [KullaniciController::class, "kaydet"])->name("yonetim.kullanici.kaydet");
            Route::get("/sil/{id}", [KullaniciController::class, "sil"])->name("yonetim.kullanici.sil");
        });
        Route::prefix('kategori')->group(function () {
            Route::get("/", [YonetimKategoriController::class, "index"])->name("yonetim.kategori");
            Route::post("/", [YonetimKategoriController::class, "arama"])->name("yonetim.kategori.arama");
            Route::get("/yeni", [YonetimKategoriController::class, "form"])->name("yonetim.kategori.yeni");
            Route::get("/duzenle/{id}", [YonetimKategoriController::class, "form"])->name("yonetim.kategori.duzenle");
            Route::post("/kaydet/{id?}", [YonetimKategoriController::class, "kaydet"])->name("yonetim.kategori.kaydet");
            Route::get("/sil/{id}", [YonetimKategoriController::class, "sil"])->name("yonetim.kategori.sil");
        });
        Route::prefix('urunler')->group(function () {
            Route::get("/", [YonetimUrunController::class, "index"])->name("yonetim.urunler");
            Route::post("/", [YonetimUrunController::class, "arama"])->name("yonetim.urunler.arama");
            Route::get("/yeni", [YonetimUrunController::class, "form"])->name("yonetim.urunler.yeni");
            Route::get("/duzenle/{id}", [YonetimUrunController::class, "form"])->name("yonetim.urunler.duzenle");
            Route::post("/kaydet/{id?}", [YonetimUrunController::class, "kaydet"])->name("yonetim.urunler.kaydet");
            Route::get("/sil/{id}", [YonetimUrunController::class, "sil"])->name("yonetim.urunler.sil");
        });
        Route::prefix('siparis')->group(function () {
            Route::get("/", [SiparisController::class, "index"])->name("yonetim.siparis");
            Route::post("/", [SiparisController::class, "arama"])->name("yonetim.siparis.arama");
            Route::get("/yeni", [SiparisController::class, "form"])->name("yonetim.siparis.yeni");
            Route::get("/duzenle/{id}", [SiparisController::class, "form"])->name("yonetim.siparis.duzenle");
            Route::post("/kaydet/{id?}", [SiparisController::class, "kaydet"])->name("yonetim.siparis.kaydet");
            Route::get("/sil/{id}", [SiparisController::class, "sil"])->name("yonetim.siparis.sil");
        });
    });
});
Route::get('/', [AnasayfaController::class, "index"])->name("anasayfa");
Route::get('/kategori/{slug_kategori}', [KategoriController::class, 'index'])->name('kategori');
Route::get('/urun/{slug_urun_adi}', [UrunController::class, 'index'])->name('urun');
Route::post('/ara', [UrunController::class, 'urun_ara'])->name("urun_ara");
Route::get('/ara', [UrunController::class, 'urun_ara'])->name("urun_ara");
Route::group(["middleware" => "auth"], function () {
    Route::get('/siparisler', [SiparislerController::class, 'index'])->name("siparisler");
    Route::get('/siparisler/{id}', [SiparislerController::class, 'detay'])->name("detay");
});
Route::prefix("odeme")->name("odeme.")->group(function () {
    Route::get('/', [OdemeController::class, 'index'])->name("anasayfa");
    Route::post('/yap', [OdemeController::class, 'odemeyap'])->name("yap");
});
Route::prefix("sepet")->group(function () {
    Route::get('/', [SepetController::class, 'index'])->name('sepet');
    Route::post('/ekle', [SepetController::class, 'ekle'])->name('sepet.ekle');
    Route::delete('/kaldir/{rowId}', [SepetController::class, 'kaldir'])->name('sepet.kaldir');
    Route::delete('/bosalt', [SepetController::class, 'bosalt'])->name('sepet.bosalt');
    Route::put('/guncelle', [SepetController::class, 'guncelle']);
});

Route::prefix("kullanici")->group(function () {
    Route::get('/oturumac', [KullanicilarController::class, "giris_form"])->name("oturumac");
    Route::post('/giris', [KullanicilarController::class, "giris"])->name("giris");
    Route::get('/kaydol', [KullanicilarController::class, "kaydol_form"])->name('kaydol');
    Route::post('/kaydol', [KullanicilarController::class, "kaydol"]);
    Route::get('/cikis', [KullanicilarController::class, "cikis"])->name("cikis");
    Route::get('/aktiflestir/{anahtar}', [KullanicilarController::class, "aktiflestir"])->name("aktiflestir");
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'yoneticiMiddleware']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
