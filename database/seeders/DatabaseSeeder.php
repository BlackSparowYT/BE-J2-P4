<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {

        \App\Models\Item::factory(30)->create();
        \App\Models\Category::factory(3)->create();

        if(env('SETTING_DEFAULT_ACCOUNTS')) {
            \App\Models\User::factory()->create(array(
                'name' =>'admin',
                'email' => 'admin@app.com',
                'password' => Hash::make('password'),
                'blocked' => false,
                'verified' => true,
                'admin' => true,
                'permissions' => null,
            ));

            \App\Models\User::factory()->create(array(
                'name' =>'user',
                'email' => 'user@app.com',
                'password' => Hash::make('password'),
                'blocked' => false,
                'verified' => true,
                'admin' => false,
                'permissions' => null,
            ));
        }

        \App\Models\User::factory(3)->create();

    }
}
