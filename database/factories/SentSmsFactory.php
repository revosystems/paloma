<?php

namespace Revo\Paloma\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SentSmsFactory extends Factory
{
    protected $model = SentSms::class;

    public function definition(): array
    {
        return [
            'phone'   => $this->faker->phoneNumber(),
            'service' => "sms service {$this->faker->word()}",
            'message' => "sms message {$this->faker->word()}",
        ];
    }
}
