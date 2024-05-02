<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                Book::factory()->create([
                    "user_id" => $user->id,
                ]);
            }
            // Book::factory()->count(3)
            //     ->markedFavourite()
            //     ->for($user->id)
            //     ->create();

            // Book::factory()->count(2)
            //     ->markedUnFavourite()
            //     ->for($user->id)
            //     ->create();
        }
    }
}
