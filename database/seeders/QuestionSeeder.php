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
            'text'                 => 'Le rôle, l’activité ou le comportement assigné.e.s aux femmes
            véhicule.nt-il.s/elle.s un ou plusieurs stéréotypes sexistes ?',
            'is_sexist'                  => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'               => 2,
            'quiz_id'                  => '1',
            'text'                 => 'Les métiers assignés aux personnages véhiculent-ils
            des stéréotypes sexistes ?',
            'is_sexist'                  => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
