<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*  User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@yopmail.com',
            'password' => Hash::make('Qwerty@123')
        ]); */
        User::factory()->create([
            'name' => 'Mandeep Singh',
            'email' => 'mandeep@yopmail.com',
            'password' => Hash::make('Qwerty@123'),
            'userType' => 'admin'
        ]);
        User::factory(4)->create();
        $this->call(BookSeeder::class);
        $this->call(NoteSeeder::class);
    }
}
