<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::factory(3)->create();
        $this->call([
            AdminSeed::class,
            CategorySeed::class
        ]);

        DB::table('attributes')->insert([
            ['name' => 'Color (Product Color)'],
            ['name' => 'Size'],
            ['name' => 'Material'],
            ['name' => 'Pattern'],
            ['name' => 'Weight'],
            ['name' => 'Finish'],
            ['name' => 'Style'],
            ['name' => 'Origin'],
        ]);
        User::insert([
            [
                'name' => 'Nesma Wafay',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
                'role' => 'client',
                'slug' => 'nesma-wafay',
                'username' => 'nesma-wafay',
            ],
            [
                'name' => 'Nesma artisan',
                'email' => 'artisan@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'craftsmen',
                'slug' => 'nesmaartisan',
                'username' => 'nesmaartisan',
            ]

        ]);
    }
}
