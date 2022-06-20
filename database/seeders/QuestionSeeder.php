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
        Question::create([
            'id'               => 1,
            'quiz_id'                  => '1',
            'text'                  => 'Le langage utilisé véhicule-t-il des stéréotypes sexistes ?',
            'image'                 => '/storage/image/question/raimbow.json',
            'is_sexist'             => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'               => 2,
            'quiz_id'                  => '1',
            'text'                  => 'Des stéréotypes sexistes ou les violences faites aux femmes sont-ils/
            elles abordé.e.s sous l’angle de l’humour ou du second degré ?',
            'image'                 => '/storage/image/question/electric.json',
            'is_sexist'             => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
