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
            'name' => 'Nesma Wafay',
            'username' => 'nesma-wafay',
            'email' => 'n.elsosey@gmail.com',
            'phone' => '201025371438',
            'password' => Hash::make('password'),
            'super_admin' => true,
            'status' => 'active',
        ]);
    }
}
