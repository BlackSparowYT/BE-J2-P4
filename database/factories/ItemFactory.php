<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ItemFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {

        $title = fake()->words(2, true);
        $slug = strtolower(str_replace(" ", "-", $title));


        return [
            'slug' => $slug,
            'title' => $title,
            'category_id' => random_int(1,3),
            'excerpt' => fake()->sentence(8)." ".fake()->sentence(8),
            'content' => fake()->paragraph(20) . "\n" . fake()->paragraph(20) . "\n" . fake()->paragraph(20),
        ];
    }
}
