<?php

namespace App\Controller;

use App\Entity\Questionnaire;
use App\Entity\UserQuestionnaire;
use App\Repository\ReponseRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ResultController extends AbstractController
{
    /**
     * @Route("/result", name="result")
     */
    public function index(Request $request, ReponseRepository $repo, ObjectManager $manager) {

        $resultat = new UserQuestionnaire();

        $count = 0;
        $verif = null;

        foreach($request->request as $param) {
            $reponse = $repo->find($param);
            if($reponse->getValue()) {
                $count++;
            }
            $verif = $reponse->getQuestion()->getQuestionnaire();
        }

        $len = sizeof($verif->getQuestions());
        $note = (100 * $count)/$len;
        
        $resultat->setNote($note)
            ->setUser($this->getUser())
            ->setQuestionnaire($verif);
            
        $manager->persist($resultat);
        $manager->flush();

        return $this->redirectToRoute('perso_questionnaires', ['id' => $verif->getThematique()->getId()]);
    }
}
