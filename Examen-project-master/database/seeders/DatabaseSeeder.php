<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Category;
use \App\Models\Post;
use App\Models\User;
use App\Models\employer;
class DatabaseSeeder extends Seeder
{
    /**
     *  Dit bestand is verantwoordelijk voor het seeden van de database.
     */
    public function run(): void
    {


        $user = User::factory()->create([
            'name' => 'John Doe'
        ]);

        Post::factory(5)->create([
            'user_id' => $user->id
        ]);
    }
}
