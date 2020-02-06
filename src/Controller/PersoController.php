<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersoController extends AbstractController
{
    /**
     * @Route("/perso", name="perso_themes")
     */
    public function showByThemes()
    {
        return $this->render('perso/bythemes.html.twig', [
            'controller_name' => 'Themes',
        ]);
    }

    /**
     * @Route("/perso/questionnaires-", name="perso_questions")
     */
    public function showByQuestionnaires()
    {
        return $this->render('perso/byquestionnaires.html.twig', [
            'controller_name' => 'Questionnaires',
        ]);
    }

    /**
     * @Route("/perso/questionnaire-", name="perso_questionnaire")
     */
    public function showByOne()
    {
        return $this->render('perso/byone.html.twig', [
            'controller_name' => 'Questions',
        ]);
    }
}
