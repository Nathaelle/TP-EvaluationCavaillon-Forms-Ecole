<?php

namespace App\Controller;

use App\Entity\Thematique;
use App\Form\ThematiqueType;
use App\Entity\Questionnaire;
use App\Form\QuestionnaireType;
use App\Repository\QuestionnaireRepository;
use Doctrine\Persistence\ObjectManager;
use App\Repository\ThematiqueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController {

    /**
     * @Route("/admin", name="admin_home")
     */
    public function general() {

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/questionnaires", name="admin_questionnaires")
     */
    public function addQuestionnaire(Request $request, ObjectManager $manager, ThematiqueRepository $repo) {

        $theme = new Thematique();
        $themeForm = $this->createForm(ThematiqueType::class, $theme);
        $themeForm->handleRequest($request);

        if($themeForm->isSubmitted() && $themeForm-> isValid()) {
            $manager->persist($theme);
            $manager->flush();
            return $this->redirectToRoute('admin_questionnaires');
        }
        
        $questionnaire = new Questionnaire();
        $form = $this->createForm(QuestionnaireType::class, $questionnaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($questionnaire);
            $manager->flush();
            return $this->redirectToRoute('admin_questionnaires');
        }

        $themes = $repo->findAll();

        return $this->render('admin/forms/questionnaires.html.twig', [
            'form' => $form->createView(),
            'themeForm' => $themeForm->createView(),
            'thematiques' => $themes
        ]);
    }

    /**
     * @Route("/admin/questionnaire-{id}", name="admin_questions")
     */
    public function addQuestions() {

        return $this->render('admin/forms/questions.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function adduser() {

        return $this->render('admin/forms/users.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
