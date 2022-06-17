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
            'id'                    => 1,
            'quiz_id'               => '1',
            'text'                  => 'Le rôle, l’activité ou le comportement assigné.e.s aux femmes
            véhicule.nt-il.s/elle.s un ou plusieurs stéréotypes sexistes ?',
            'answer'                => '<p><span>Sont concernés les textes écrits, signatures, dialogues, voix off, chansons, etc.<br><br></span><span style="color: #FED320">Exemples</span><span> : « Mademoiselle » ; « Madame le Directeur » ; un produit fait pour « la » femme.<br>Indicateur </span><span style="color: #FED320">sémantique</span></p>',
            'is_sexist'             => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 2,
            'quiz_id'               => '1',
            'text'                  => 'Les métiers assignés aux personnages véhiculent-ils
            des stéréotypes sexistes ?',
            'answer'                => '<p><span style="color: #FED320">Exemples</span><span> : « Faites-lui en voir de toutes les couleurs » ; « Nous louons aussi aux femmes » ; « Face à la technologie, on est tous un peu blonde » ; une automobile comparée au corps<br>féminin : « Les françaises aussi ont de belles carrosseries ». </span><span style="color: #FED320">Indicateur de tonalité</span></p>',
            'is_sexist'             => true,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}
