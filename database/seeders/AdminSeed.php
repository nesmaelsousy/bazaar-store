<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin Bazaar',
            'username' => 'admin_bazaar',
            'email' => 'bazaar@gmail.com',
            'phone' => '059123456',
            'password' => Hash::make('password'),
            'super_admin' => true,
            'status' => 'active',
        ]);
    }
}
