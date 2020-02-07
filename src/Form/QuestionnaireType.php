<?php

namespace App\Form;

use App\Entity\Thematique;
use App\Entity\Questionnaire;
use App\Repository\ThematiqueRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QuestionnaireType extends AbstractType
{
    private $repo;

    public function __construct(ThematiqueRepository $repo) {
        $this->repo = $repo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add('titre', TextType::class, ['label' => 'Titre du nouveau questionnaire'])
            ->add('thematique', ChoiceType::class, [
                'label' => 'Sélectionner votre thématique :',
                'choices' => $this->repo->findAll(),
                'choice_label' => function(Thematique $theme, $key, $value) {
                    return strtoupper($theme->getNom());
                },
                'choice_attr' => function(Thematique $theme, $key, $value) {
                    return ['class' => 'category_'.strtolower($theme->getNom())];
                },
                'choice_value' => function (?Thematique $theme) {
                    return $theme ? $theme->getId() : '';
                }
            ])
            ->add('creer', SubmitType::class, ['label' => 'Créer le questionnaire'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Questionnaire::class,
        ]);
    }
}
