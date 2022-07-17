<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
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
            'title' =>$this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'size' =>$this->faker->numberBetween($min = 10, $max = 30),
            'capacity' =>$this->faker->numberBetween($min = 1, $max = 5),
            'bed_types' =>$this->faker->text($maxNbChars = 10),
            'bed_count' =>$this->faker->numberBetween($min = 1, $max = 5),
            'room_number' =>$this->faker->unique()->numberBetween($min = 1000, $max = 9000),
            'price' =>$this->faker->randomFloat($nbMaxDecimals = NULL, $min = 1000, $max = 10000),
            'category_id' =>$this->faker->randomDigitNotNull,
            'description' =>$this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'facilities' =>$this->faker->text($maxNbChars = 200), 
            'room_image' =>$this->faker->imageUrl($width = 640, $height = 480)
        ];
    }
}
