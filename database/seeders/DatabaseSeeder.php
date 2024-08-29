<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'ahmed',
        //     'email' => 'ahmed@mail',
        // ]);

        \App\Models\Message::factory()->create([
            "sender" => 1,
            "reciever" => 2,
            "message" => 'hello user2',
        ]);
    }
}
