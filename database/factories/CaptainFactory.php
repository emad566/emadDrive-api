<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CaptainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        

        return [
            'register_step' => 1,
            'captain_code' => generateRandomCode('CPT'),
            'full_name' => 'name-'.generateRandomCode('CPT'),
            'mobile' => '010-'.generateRandomCode('CPT') ,
            'gender' => 'male',
            'avatar' => 'logo',
            'device_token' => 'token',
            'lang' => 'en',
            'password'=> '123',
        ];
    }
}
