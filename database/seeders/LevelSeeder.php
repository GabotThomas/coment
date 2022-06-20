<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'id'                    => 1,
            'level_state_id'        => 1,
            'name'                  => 'Initial',
            'image'                  => '/storage/image/level/rainbow',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
