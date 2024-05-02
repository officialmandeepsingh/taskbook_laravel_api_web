<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'note' => fake()->paragraph(10),

            "isFavourite" => fake()->boolean()
        ];
    }

    public function markedFavoutite()
    {
        return $this->state(function (array $attributes) {
            return [
                "isFavourite" => "true"
            ];
        });
    }

    public function markedUnFavoutite()
    {
        return $this->state(function (array $attributes) {
            return [
                "isFavourite" => "false"
            ];
        });
    }
}
