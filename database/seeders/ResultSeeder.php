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
            'image'                 => '/images/result/bad.svg',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        ResultPage::create(
            [
                'id'                    => 1,
                'result_id'             => 1,
                'text'                  => "Vous faites partie des personnes qui contribuent encore au sexisme en France, mais rien n’est perdu encore !",
                'created_at'            => now(),
                'updated_at'            => now(),
            ]
        );

        Result::create([
            'id'                    => 2,
            'image'                 => '/images/result/canBetter.svg',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        ResultPage::create(
            [
                'id'                    => 2,
                'result_id'             => 2,
                'text'                  => "Des progrès s’imposent, mais courage, le but est proche… Un « OUI » de moins, et votre
                communication sera progressiste !",
                'created_at'            => now(),
                'updated_at'            => now(),
            ]
        );

        Result::create([
            'id'                    => 3,
            'image'                 => '/images/result/good.svg',
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        ResultPage::create(
            [
                'id'                    => 3,
                'result_id'             => 3,
                'text'                  => "Bravo ! Vous êtes attentif.ve à l’information que vous véhiculez au travers de votre communication.",
                'created_at'            => now(),
                'updated_at'            => now(),
            ]
        );
    }
}
