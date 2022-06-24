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

        Level::create([
            'id'                    => 2,
            'level_state_id'        => 1,
            'name'                  => 'Second',
            'image'                  => '/storage/image/level/flash',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Level::create([
            'id'                    => 3,
            'level_state_id'        => 1,
            'name'                  => 'Third',
            'image'                  => '/storage/image/level/flower',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Level::create([
            'id'                    => 4,
            'level_state_id'        => 1,
            'name'                  => 'Fourth',
            'image'                  => '/storage/image/level/star',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Level::create([
            'id'                    => 5,
            'level_state_id'        => 1,
            'name'                  => 'Fifth',
            'image'                  => '/storage/image/level/etoile',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);









        Level::create([
            'id'                    => 6,
            'level_state_id'        => 2,
            'name'                  => 'Six',
            'image'                  => '/storage/image/level/rainbow',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Level::create([
            'id'                    => 7,
            'level_state_id'        => 2,
            'name'                  => 'Seven',
            'image'                  => '/storage/image/level/flash',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Level::create([
            'id'                    => 8,
            'level_state_id'        => 2,
            'name'                  => 'Heigth',
            'image'                  => '/storage/image/level/flower',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Level::create([
            'id'                    => 9,
            'level_state_id'        => 2,
            'name'                  => 'Nine',
            'image'                  => '/storage/image/level/star',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Level::create([
            'id'                    => 10,
            'level_state_id'        => 2,
            'name'                  => 'Ten',
            'image'                  => '/storage/image/level/etoile',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
