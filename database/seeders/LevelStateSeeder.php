<?php

namespace Database\Seeders;

use App\Models\LevelState;
use Illuminate\Database\Seeder;

class LevelStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LevelState::create([
            'id'               => 1,
            'level'                  => '1',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        LevelState::create([
            'id'               => 2,
            'level'                  => '2',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
