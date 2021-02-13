<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Süt ve kahvaltı
        $sutVeKahvaltiId = DB::table('kategori')->insertGetId(['kategori_adi' => 'Süt ve Kahvaltı', 'slug' => 'sut-ve-kahvalti']);
        Db::table('kategori')->insert(["kategori_adi" => 'Süt', 'slug' => 'sut', 'ust_id' => $sutVeKahvaltiId]);
        Db::table('kategori')->insert(["kategori_adi" => 'Peynir', 'slug' => 'peynir', 'ust_id' => $sutVeKahvaltiId]);
        Db::table('kategori')->insert(["kategori_adi" => 'Yumurta', 'slug' => 'yumurta', 'ust_id' => $sutVeKahvaltiId]);
        Db::table('kategori')->insert(["kategori_adi" => 'Zeytin', 'slug' => 'zeytin', 'ust_id' => $sutVeKahvaltiId]);
        // Atıştırlmalık
        $atistirmalikId = DB::table('kategori')->insertGetId(['kategori_adi' => 'Atıştırlmalık', 'slug' => 'atistirmalik']);
        Db::table('kategori')->insert(["kategori_adi" => 'Çikolata', 'slug' => 'cikolata', 'ust_id' => $atistirmalikId]);
        Db::table('kategori')->insert(["kategori_adi" => 'Gofret', 'slug' => 'gofret', 'ust_id' => $atistirmalikId]);
        Db::table('kategori')->insert(["kategori_adi" => 'Patlamış Mısır', 'slug' => 'patlamis-misir', 'ust_id' => $atistirmalikId]);
        // Meyve Ve Sebze
        $meyveVeSebzeId = DB::table('kategori')->insertGetID(['kategori_adi' => 'Meyve Ve Sebze', 'slug' => 'meyve-ve-sebze']);
        Db::table('kategori')->insert(["kategori_adi" => 'Meyve', 'slug' => 'meyve', 'ust_id' => $meyveVeSebzeId]);
        Db::table('kategori')->insert(["kategori_adi" => 'Sebze', 'slug' => 'sebze', 'ust_id' => $meyveVeSebzeId]);
        Db::table('kategori')->insert(["kategori_adi" => 'Bebek', 'slug' => 'bebek']);

    }
}
