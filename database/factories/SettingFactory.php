<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender=['male','female'];
        $test_method=['testMethod1','testMethod2','testMethod3'];
        $store_unit=['store_unit1','store_unit2'];
        $measurement_unit=['measurement_unit1','measurement_unit2'];
        return [
            'gender'=>$gender,
            'test_method'=>$test_method,
            'store_unit'=>$store_unit,
            'measurement_unit'=>$measurement_unit,
        ];
    }
}
