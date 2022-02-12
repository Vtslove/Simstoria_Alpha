<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(Faker $faker)
    {
        return [

            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'profile_image' => 'https://via.placeholder.com/150*150',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }


        /**
         * Indicate that the model's email address should be unverified.
         *
         * @return \Illuminate\Database\Eloquent\Factories\Factory
         */
        public function unverified()
        {
            return $this->state(function (array $attributes) {
                return [
                    'email_verified_at' => null,a
                ];
            });


            $factory->define(App\Message::class, function (Faker $faker) {
                do {
                    $from = rand(1, 15);
                    $to = rand(1, 15);
                } while ($from === $to);
                return [
                    'from' => $from,
                    'to' => $to,
                    'text' => $faker->sentence,
                ];

            });
        }
   }
