<?php

namespace App\Providers;

use App\Models\Kullanici;
use App\Models\Siparis;
use App\Models\Urun;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer(["yonetim.*"], function ($view) {
            
            $bitisZamani = now()->addMinutes(10);
            $istatistikler = Cache::remember('istatistikler', $bitisZamani, function () {
                return [
                    "bekleyenSiparis" => Siparis::where('durum', 'Siparişiniz alındı')->count(),
                    "tamamlananSiparis" => Siparis::where('durum', 'Sipariş Tamamlandı')->count(),
                    "toplamUrun" => Urun::count(),
                    "toplamKullanici" => Kullanici::count(),
                ];
            });
            $view->with('istatistikler', $istatistikler);
        });
    }
}
