<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all(); //7 users
        foreach ($users as $user) {
            $books = Book::where("user_id", $user->id)->get();
            foreach ($books as $book) {
                for ($i = 0; $i < 5; $i++) {
                    Note::factory()->create(['user_id' => $user->id, 'book_id' => $book->id]);
                }
            }
        }
    }
}
