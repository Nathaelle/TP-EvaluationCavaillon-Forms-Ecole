<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionnaireRepository")
 */
class Questionnaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="questionnaire", orphanRemoval=true)
     */
    private $questions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Thematique", inversedBy="questionnaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $thematique;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserQuestionnaire", mappedBy="questionnaire", orphanRemoval=true)
     */
    private $userQuestionnaires;

    
    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->userQuestionnaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setQuestionnaire($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->contains($question)) {
            $this->questions->removeElement($question);
            // set the owning side to null (unless already changed)
            if ($question->getQuestionnaire() === $this) {
                $question->setQuestionnaire(null);
            }
        }

        return $this;
    }

    public function getThematique(): ?Thematique
    {
        return $this->thematique;
    }

    public function setThematique(?Thematique $thematique): self
    {
        $this->thematique = $thematique;

        return $this;
    }

    /**
     * @return Collection|UserQuestionnaire[]
     */
    public function getUserQuestionnaires(): Collection
    {
        return $this->userQuestionnaires;
    }

    public function addUserQuestionnaire(UserQuestionnaire $userQuestionnaire): self
    {
        if (!$this->userQuestionnaires->contains($userQuestionnaire)) {
            $this->userQuestionnaires[] = $userQuestionnaire;
            $userQuestionnaire->setQuestionnaire($this);
        }

        return $this;
    }

    public function removeUserQuestionnaire(UserQuestionnaire $userQuestionnaire): self
    {
        if ($this->userQuestionnaires->contains($userQuestionnaire)) {
            $this->userQuestionnaires->removeElement($userQuestionnaire);
            // set the owning side to null (unless already changed)
            if ($userQuestionnaire->getQuestionnaire() === $this) {
                $userQuestionnaire->setQuestionnaire(null);
            }
        }

        return $this;
    }

}
