<?php

namespace Database\Seeders;

use App\Models\Result;
use App\Models\ResultPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Result::create([
            'id'                    => 1,
            'image'                 => '/storage/image/result/bad.png',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        ResultPage::create(
            [
                'id'                    => 1,
                'result_id'             => 1,
                'text'                  => "t'es mauvais",
                'created_at'            => now(),
                'updated_at'            => now(),
            ]
        );
        ResultPage::create([
            'id'                    => 2,
            'result_id'             => 1,
            'text'                  => "Tes vraiment relou",
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
