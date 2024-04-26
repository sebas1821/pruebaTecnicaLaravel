<?php

namespace Database\Factories;

use App\Models\Municipio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MunicipioFactory extends Factory
{
    protected $model = Municipio::class;

    public function definition()
    {
        return [
			'id_municipio' => $this->faker->name,
			'municipio' => $this->faker->name,
			'estado' => $this->faker->name,
			'id_departamento' => $this->faker->name,
        ];
    }
}
