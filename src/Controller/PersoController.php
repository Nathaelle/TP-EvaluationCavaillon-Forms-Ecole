<?php

namespace App\Controller;

use App\Entity\Questionnaire;
use App\Entity\Thematique;
use App\Repository\QuestionnaireRepository;
use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;
use App\Repository\ThematiqueRepository;
use App\Repository\UserQuestionnaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersoController extends AbstractController
{
    /**
     * @Route("/perso", name="perso_themes")
     */
    public function showByThemes(ThematiqueRepository $repo) {

        $thematiques = $repo->findAll();

        return $this->render('perso/bythemes.html.twig', [
            'thematiques' => $thematiques
        ]);
    }

    /**
     * @Route("/perso/questionnaires-{id}", name="perso_questionnaires")
     */
    public function showByQuestionnaires(Thematique $theme, QuestionnaireRepository $repo, UserQuestionnaireRepository $noteRepo) {

        $questionnaires = $repo->findBy(['thematique' => $theme]);

        $notes = [];
        foreach($questionnaires as $quest) {
            $note = $noteRepo->find(['user' => $this->getUser(), 'questionnaire' => $quest]);
            if(!empty($note)) {
                $quest->setDisabled(true);
                $notes[$quest->getId()] = $note->getNote();
            }
        }

        return $this->render('perso/byquestionnaires.html.twig', [
            'questionnaires' => $questionnaires,
            'thematique' => $theme,
            'notes' => $notes
        ]);
    }

    /**
     * @Route("/perso/questionnaire-{id}", name="perso_questions")
     */
    public function showByOne(Questionnaire $questionnaire, QuestionRepository $repoQuest) {

        $questions = $repoQuest->findBy(['questionnaire' => $questionnaire]);

        return $this->render('perso/byone.html.twig', [
            'questions' => $questions,
            'questionnaire' => $questionnaire
        ]);
    }
}
