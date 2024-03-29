<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class QuestionSeeder extends Seeder
{

    const images = [
        '/images/question/messengerflow.json',
        '/images/question/messengercon.json',
        '/images/question/diamond.json',
        '/images/question/electric.json',
        '/images/question/messenger.json',
    ];

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
            'text'                  => 'Le rôle, l’activité ou le comportement assigné.e.s aux femmes
            véhicule.nt-il.s/elle.s un ou plusieurs stéréotypes sexistes?',
            'answer'                => '<p><span style="color: #FED320">Exemples : </span><span>les femmes s’occupent systématiquement des enfants
            tandis que les hommes sont au travail; les femmes sont décrites
            comme dépensières ou inconstantes.<br></span><span style="color: #FED320">Indicateur de rôle social</span></p>',
            'image'                 => '/images/question/messengerflow.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 2,
            'quiz_id'               => '1',
            'text'                  => 'Les métiers assignés aux personnages véhiculent-ils
            des stéréotypes sexistes ?',
            'answer'                => '<p><span style="color: #FED320">Exemples : </span><span>les femmes sont mises en scène dans des postes
            subalternes tandis que les hommes sont représentés en tant
            que dirigeants ou experts.<br></span><span style="color: #FED320">Indicateur de position professionnelle</span></p>',
            'image'                 => '/images/question/messengercon.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 3,
            'quiz_id'               => '1',
            'text'                  => 'Un des deux sexes est-il numériquement plus représenté
            que l’autre et cette surreprésentation illustre-t-elle
            des stéréotypes sexistes ?',
            'answer'                => '<p><span style="color: #FED320">Exemples dans le cas d’une communication sexiste : </span><span>si dans une réunion, seuls des hommes sont représentés
            et la seule femme présente est la secrétaire prenant des notes.
            Si, au supermarché, les acheteuses de lessive sont toutes des
            femmes. Mais, si deux femmes testent une crème de soin
            « femme » ou deux hommes parlent d’un déodorant « homme »,
            ce sont des situations qui illustrent l’usage objectif du produit
            et ne sont donc pas à caractère sexiste.<br></span><span style="color: #FED320">Indicateur de présence</span></p>',
            'image'                 => '/images/question/diamond.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 4,
            'quiz_id'               => '1',
            'text'                  => 'La représentation de la parentalité renvoie-t-elle aux rôles
            traditionnellement assignés à chaque sexe?',
            'answer'                => '<p><span style="color: #FED320">Exemples : </span><span>une marque de petits pots pour enfants qui
            ne s’adresse qu’aux mères ; une publicité qui se moque
            des pères en insistant sur leur incompétence.<br></span><span style="color: #FED320">Indicateur de parentalité</span></p>',
            'image'                 => '/images/question/messengerflow.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 5,
            'quiz_id'               => '1',
            'text'                  => 'Les corps sont-ils « objétisés » et mis au service d’une
            représentation sexiste?',
            'answer'                => '<p><span style="color: #FED320">Exemples : </span><span>le corps des femmes est morcelé (femmes sans tête,
            sans regard), il est réduit à un objet esthétique ou sexuel; le
            corps des hommes est réduit à ce qu’il a de plus viril et
            dominant (muscles); les seins d’une femme servent de
            présentoir pour mettre en avant un produit.<br></span><span style="color: #FED320">Indicateur de représentation corporelle</span></p>',
            'image'                 => '/images/question/diamond.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 6,
            'quiz_id'               => '1',
            'text'                  => 'La place et l’attitude renvoient-elles à des stéréotypes sexistes ?',
            'answer'                => '<p><span style="color: #FED320">Exemples : </span><span>les femmes sont passives, représentées au second
            plan, dans des poses de soumission (alanguies, à quatre pattes…)
            propres à la vague du « porno chic »; les hommes sont
            représentés comme actifs, au premier plan, et occupent des
            positions assurées et dominatrices.<br></span><span style="color: #FED320">Indicateur de posture physique</span></p>',
            'image'                 => '/images/question/electric.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 7,
            'quiz_id'               => '1',
            'text'                  => 'Le langage utilisé véhicule-t-il des stéréotypes sexistes?
            Sont concernés les textes écrits, signatures, dialogues, voix off, chansons,
            etc',
            'answer'                => '<p><span style="color: #FED320">Exemples : </span><span>« Mademoiselle » ; « Madame le Directeur » ;
            un produit fait pour « la » femme.<br></span><span style="color: #FED320">Indicateur sémantique</span></p>',
            'image'                 => '/images/question/messengerflow.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 8,
            'quiz_id'               => '1',
            'text'                  => 'Des stéréotypes sexistes ou les violences faites aux femmes sont-ils/
            elles abordé.e.s sous l’angle de l’humour ou du second degré ?',
            'answer'                => '<p><span style="color: #FED320">Exemples : </span><span>« Faites-lui en voir de toutes les couleurs » ;
            « Nous louons aussi aux femmes » ; « Face à la technologie,
            on est tous un peu blonde » ; une automobile comparée au corps
            féminin : « Les françaises aussi ont de belles carrosseries ».<br></span><span style="color: #FED320">Indicateur de tonalité</span></p>',
            'image'                 => '/images/question/electric.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 9,
            'quiz_id'               => '1',
            'text'                  => 'Les lieux dans lesquels évolue chacun
            des personnages véhiculent-ils un ou plusieurs stéréotypes
            sexistes ?',
            'answer'                => '<p><span style="color: #FED320">Exemples : </span><span>les femmes évoluent dans la sphère domestique
            (ménage, shopping, supermarché…); les hommes investissent
            l’espace public (milieu professionnel, médias, bars...).<br></span><span style="color: #FED320">Indicateur scénographique</span></p>',
            'image'                 => '/images/question/electric.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
        Question::create([
            'id'                    => 10,
            'quiz_id'               => '1',
            'text'                  => 'L’image fait-elle référence à des stéréotypes sexistes ?',
            'answer'                => '<p><span style="color: #FED320">Exemples : </span><span> les femmes/filles sont systématiquement vêtues
            ou environnées de rose et de couleurs pastels tandis que
            les hommes/garçons sont vêtus ou environnés de bleu
            et de couleurs sombres, froides.<br></span><span style="color: #FED320">Indicateur chromatique</span></p>',
            'image'                 => '/images/question/messengercon.json',
            'is_sexist'             => false,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        for ($l = 0; $l < 20; $l = $l + 10) {
            for ($i = 1; $i < 10; $i = $i + 2) {
                for ($j = 0; $j < 2; $j++) {
                    if ($i == 1 && $j == 0 && $l == 0) {
                        $rand = 0;
                    } else {
                        $rand = rand(5, 7);
                    }

                    for ($n = 1; $n < $rand; $n++) {
                        Question::create([
                            'quiz_id'               => $i + $j + $l,
                            'text'                  => 'Lorem ipsum dolor sit amet ?',
                            //write answer wityh lorem ipsum
                            'answer'                => '<p>
                        <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl eget
                        ultricies aliquam, nunc nisl aliquet nunc, vitae aliquam nisl nunc eu nisl. Nulla
                        </span>
                        <span>facilisi. Nulla facilisi. Nulla facilisi. Nulla facilisi. Nulla facilisi. Nulla facilisi. Nulla
                        </span>
                        </p>
                        ',
                            'image'                 => self::images[rand(0, 4)],
                            'is_sexist'             => rand(0, 1) == 1 ? true : false,
                            'created_at'            => now(),
                            'updated_at'            => now(),
                        ]);
                    }
                }
            }
        }
    }
}
