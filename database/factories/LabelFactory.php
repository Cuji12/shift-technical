<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Label>
 */
class LabelFactory extends Factory
{
    private array $labels = [
        'Work',
        'Personal',
        'Technology',
        'News',
        'Family',
        'Money',
        'Sport',
        'Miscellaneous'
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => array_rand($this->labels)
        ];
    }
}
