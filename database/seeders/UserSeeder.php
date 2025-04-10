<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(9)->create();

        User::factory()->create([
            'name' => 'Admin Resti',
            'email' => 'nuresti.aurelia@gmail.com',
            'password' => Hash::make('admin123'),
            'phone' => '081254782365',
            'roles' => 'ADMIN',
        ]);
    }
}
