<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'set_phone'=>true,
            'set_whatsapp'=>true,
            'set_email'=>true,
            'set_address'=>true,
            'enabled'=>true,
        ];
    }
}
