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

        Quiz::create([
            'id'                    => 3,
            'level_id'              => 2,
            'name'                  => 'Second-one',
            'is_initial'            => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Quiz::create([
            'id'                    => 4,
            'level_id'              => 2,
            'name'                  => 'Second-two',
            'is_initial'            => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Quiz::create([
            'id'                    => 5,
            'level_id'              => 3,
            'name'                  => 'Third-one',
            'is_initial'            => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Quiz::create([
            'id'                    => 6,
            'level_id'              => 3,
            'name'                  => 'third-two',
            'is_initial'            => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Quiz::create([
            'id'                    => 7,
            'level_id'              => 4,
            'name'                  => 'Fourth-one',
            'is_initial'            => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Quiz::create([
            'id'                    => 8,
            'level_id'              => 4,
            'name'                  => 'Fourth-two',
            'is_initial'            => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Quiz::create([
            'id'                    => 9,
            'level_id'              => 5,
            'name'                  => 'Fifth-one',
            'is_initial'            => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Quiz::create([
            'id'                    => 10,
            'level_id'              => 5,
            'name'                  => 'Fifth-two',
            'is_initial'            => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);






        Quiz::create([
            'id'                    => 11,
            'level_id'              => 6,
            'name'                  => 'Six-one',
            'is_initial'            => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Quiz::create([
            'id'                    => 12,
            'level_id'              => 6,
            'name'                  => 'Six-second',
            'is_initial'            => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Quiz::create([
            'id'                    => 13,
            'level_id'              => 7,
            'name'                  => 'Seven-one',
            'is_initial'            => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Quiz::create([
            'id'                    => 14,
            'level_id'              => 7,
            'name'                  => 'Seven-two',
            'is_initial'            => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Quiz::create([
            'id'                    => 15,
            'level_id'              => 8,
            'name'                  => 'Height-one',
            'is_initial'            => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Quiz::create([
            'id'                    => 16,
            'level_id'              => 8,
            'name'                  => 'Height-two',
            'is_initial'            => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Quiz::create([
            'id'                    => 17,
            'level_id'              => 9,
            'name'                  => 'Nine-one',
            'is_initial'            => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Quiz::create([
            'id'                    => 18,
            'level_id'              => 9,
            'name'                  => 'Nine-two',
            'is_initial'            => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        Quiz::create([
            'id'                    => 19,
            'level_id'              => 10,
            'name'                  => 'Ten-one',
            'is_initial'            => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Quiz::create([
            'id'                    => 20,
            'level_id'              => 10,
            'name'                  => 'Ten-two',
            'is_initial'            => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
