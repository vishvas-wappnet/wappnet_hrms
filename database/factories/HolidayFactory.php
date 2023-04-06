<?php

namespace Database\Factories;

use App\Http\Controllers\HolidayController;
use App\Models\Holiday;
use Illuminate\Database\Eloquent\Factories\Factory;

class HolidayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * 
     * 
     */

     protected $model = Holiday::class;
    public function definition()
    {
        return [
           
            'title' => $this->faker->sentence(),
            'day' => $this->faker->dateTimeThisMonth()->format('d'),
            'date' => $this->faker->dateTimeThisMonth()->format('Y-m-d'),
           
        ];
    }
}
