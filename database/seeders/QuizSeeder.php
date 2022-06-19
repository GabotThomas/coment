<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::create([
            'id'                    => 1,
            'level_id'              => 1,
            'name'                  => 'Initial',
            'is_initial'            => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Quiz::create([
            'id'                    => 2,
            'level_id'              => 1,
            'name'                  => 'Initial-second',
            'is_initial'            => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
