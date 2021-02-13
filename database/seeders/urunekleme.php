<?php

namespace Database\Seeders;

use App\Models\Urun;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Str;

class urunekleme extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $urun_adi = $faker->streetName;
            $urun = Urun::create([
                'urun_adi' => $urun_adi,
                'slug' => STR::slug($urun_adi),
                'aciklama' => $faker->paragraph(250),
                'fiyati' => $faker->randomFloat(3,1,20)
            ]);
                
            $detay = $urun->detay()->create([
                'goster_slider' => rand(0,1),
                'goster_gunun_firsati' => rand(0,1),
                'goster_one_cikan' => rand(0,1),
                'goster_cok_satan' => rand(0,1),
                'goster_indirimli' => rand(0,1)
            ]);
        }

    }
}
