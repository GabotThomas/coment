<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id'               => 1,
            'name'                  => 'Admin',
            'lastname'=> 'Admin',
            'email'                 => 'admin@mail.fr',
            'role'                  => 'admin',
            'password'              => Hash::make('adminadmin'),
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
