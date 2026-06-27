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
                'name' => 'Customer Bzaar',
                'email' => 'user@example.com',
                'address' => 'Gaza',
                'password' => bcrypt('password'),
                'role' => 'client',
                'slug' => 'nesma-wafay',
                'username' => 'nesma-wafay',
            ],
            [
                'name' => 'Artisan Bazaar',
                'email' => 'artisan@gmail.com',
                'address' => 'Gaza',
                'password' => bcrypt('password'),
                'role' => 'craftsmen',
                'slug' => 'nesmaartisan',
                'username' => 'nesmaartisan',
            ]

        ]);
    }
}
