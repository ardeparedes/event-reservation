<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateTime = $this->faker->dateTimeBetween('now', '+1 month');
        $deadline = $this->faker->dateTimeBetween($dateTime->format('Y-m-d H:i:s').' -1 weeks', $dateTime);

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'datetime' => $dateTime,
            'deadline' => $deadline,
            'location' => $this->faker->address,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'attendee_limit' => $this->faker->numberBetween(10, 100),
        ];
    }
}
