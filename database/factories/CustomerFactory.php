<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'first_name' => $this->faker->firstName($gender = 'male'|'female') ,
            'last_name' => $this->faker->lastName,
            'user_name' => $this->faker->userName,
            'c_id'=>$this->faker->unique()->numberBetween($min = 1000, $max = 20000),
            'email'=>$this->faker->email,
            'address'=>$this->faker->address,
            'image'=>$this->faker->imageUrl($width = 640, $height = 480),
            'contact_number'=>$this->faker->phoneNumber,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password


        ];
    }
}
