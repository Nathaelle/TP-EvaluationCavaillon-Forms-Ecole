<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Reponse;
use App\Entity\Question;
use App\Entity\Thematique;
use Faker\Factory as Faker;
use App\Entity\Questionnaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $manager) {
        $faker = Faker::create('fr_FR');
        
        for($i = 0; $i < 6; $i++) {
            $thematique = new Thematique();
            $thematique->setNom($faker->sentence(1));
            $manager->persist($thematique);

            for($j = 0; $j < 5; $j++) {
                $questionnaire = new Questionnaire();
                $questionnaire->setTitre($faker->sentence(10))
                            ->setThematique($thematique);
                $manager->persist($questionnaire);

                for($k = 0; $k < 10; $k++) {
                    $question = new Question();
                    $question->setIntitule($faker->sentence(10))
                            ->setQuestionnaire($questionnaire);
                    $manager->persist($question);

                    for($l = 0; $l < 4; $l++) {
                        $reponse = new Reponse();
                        $reponse->setLibelle($faker->sentence(3))
                            ->setValue(false)
                            ->setQuestion($question);
                        $manager->persist($reponse);
                    }
                }
            }
        }


        for($i = 0; $i < 4; $i++) {

            $user = new User();
            $user->setPseudo($faker->userName)
                ->setPassword($this->encoder->encodePassword($user, 'test'))
                ->setRoles(['ROLE_USER']);
            $manager->persist($user);

        }
        
        $manager->flush();
    }
}
