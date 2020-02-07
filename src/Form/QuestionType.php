<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule', TextType::class, ['label' => 'Intitulé de la question'])
            ->add('reponse1', TextType::class, ['mapped' => false, 'label' => '1.'])
            ->add('value1', CheckboxType::class, [
                'label'    => 'Bonne réponse',
                'required' => false,
                'mapped' => false
            ])
            ->add('reponse2', TextType::class, ['mapped' => false, 'label' => '2.'])
            ->add('value2', CheckboxType::class, [
                'label'    => 'Bonne réponse',
                'required' => false,
                'mapped' => false
            ])
            ->add('reponse3', TextType::class, ['mapped' => false, 'label' => '3.'])
            ->add('value3', CheckboxType::class, [
                'label'    => 'Bonne réponse',
                'required' => false,
                'mapped' => false
            ])
            ->add('reponse4', TextType::class, ['mapped' => false, 'label' => '4.'])
            ->add('value4', CheckboxType::class, [
                'label'    => 'Bonne réponse',
                'required' => false,
                'mapped' => false
            ])
            ->add('creer', SubmitType::class, ['label' => 'Ajouter la question'])
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
