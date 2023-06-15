<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::factory()->count(10)->create();

        $users = User::all();

        foreach ($events as $event) {
            $creator = $users->random();

            $event->createdBy()->associate($creator)->save();

            $reservingUsers = $users->where('id', '!=', $creator->id);

            $randomUsers = $reservingUsers->random(rand(1, 5));

            $event->reservations()->attach($randomUsers);
        }
    }
}
