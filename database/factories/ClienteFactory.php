<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
			'fecha_creacion' => $this->faker->name,
			'nombre' => $this->faker->name,
			'apellido' => $this->faker->name,
			'cedula' => $this->faker->name,
			'departamento' => $this->faker->name,
			'ciudad' => $this->faker->name,
			'celular' => $this->faker->name,
			'correo' => $this->faker->name,
			'autorizo' => $this->faker->name,
        ];
    }
}
