<?php

namespace Database\Factories;

use App\Models\Urun;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UrunFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Urun::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $urunAdi = $this->faker->name;
        return [
            'urun_adi' => $urunAdi,
            'slug' =>  STR::slug($urunAdi),
            'aciklama' => $this->faker->sentence,
            'fiyati' => $this->faker->randomFloat(3, 0, 1000),
        ];
    }
}
