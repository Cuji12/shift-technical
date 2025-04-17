<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use joshtronic\LoremIpsum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    private array $titles = [
        'Buy food for the week',
        'Call the dentist to reschedule appointment',
        'Clean out the shed',
        'Meal prep lunches for work',
        'Pay leccy',
        'Take the dog for a walk',
        'Water the plants',
        'Go for a run'
    ];

    private array $colours = [
        '#FFFACD',
        '#B3E5FC',
        '#E6FFCC',
        '#FFCCCC',
        '#D8BFD8',
        '#FFE5B4'
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => array_rand($this->titles),
            'content' => $this->loremText(rand(1,4)),
            'background_colour' => array_rand($this->colours)
        ];
    }

    private function loremText(int $numberOfParagraphs)
    {
        $lorem = new LoremIpsum();

        return $lorem->paragraph($numberOfParagraphs);
    }
}
