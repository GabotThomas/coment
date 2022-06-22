<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Level - 1 //Quiz - 1
        Question::create([
            'id'                    => 1,
            'quiz_id'               => '1',
            'text'                  => 'Le langage utilisé véhicule-t-il des stéréotypes sexistes ?',
            'image'                 => '/storage/image/question/raimbow.json',
            'is_sexist'             => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 2,
            'quiz_id'               => '1',
            'text'                  => 'Des stéréotypes sexistes ou les violences faites aux femmes sont-ils/
            elles abordé.e.s sous l’angle de l’humour ou du second degré ?',
            'image'                 => '/storage/image/question/electric.json',
            'is_sexist'             => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        //Level - 1 //Quiz - 2
        Question::create([
            'id'                    => 3,
            'quiz_id'               => '2',
            'text'                  => 'Lorem ipsum dolor sit amet ?',
            'image'                 => '/storage/image/question/raimbow.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 4,
            'quiz_id'               => '2',
            'text'                  => 'Lorem ipsum dolor sit amet. Aut neque exercitationem modi ?',
            'image'                 => '/storage/image/question/electric.json',
            'is_sexist'             => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 5,
            'quiz_id'               => '2',
            'text'                  => 'Lorem ipsum dolor sit amet. Aut neque exercitationem modi ????',
            'image'                 => '/storage/image/question/messenger.json',
            'is_sexist'             => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        //Level - 2 //Quiz - 1
        Question::create([
            'quiz_id'               => '3',
            'text'                  => 'Lorem ipsum dolor sit amet ?',
            'image'                 => '/storage/image/question/raimbow.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'quiz_id'               => '3',
            'text'                  => 'Lorem ipsum dolor sit amet. Aut neque exercitationem modi ?',
            'image'                 => '/storage/image/question/electric.json',
            'is_sexist'             => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'quiz_id'               => '3',
            'text'                  => 'Lorem ipsum dolor sit amet. Aut neque exercitationem modi ????',
            'image'                 => '/storage/image/question/messenger.json',
            'is_sexist'             => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
