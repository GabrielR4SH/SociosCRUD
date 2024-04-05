<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    protected $model = Partner::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'type' => $this->faker->randomElement(['gold', 'silver']),
            'cep' => $this->faker->postcode,
            'logradouro' => $this->faker->streetName,
            'complemento' => $this->faker->secondaryAddress,
            'bairro' => $this->faker->citySuffix,
            'localidade' => $this->faker->city,
            'uf' => $this->faker->stateAbbr,
        ];
    }
}
