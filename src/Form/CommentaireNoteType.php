<?php

namespace App\Form;

use App\Entity\Note;
use App\Entity\User;
use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentaireNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('publishedAt', null, [
                'widget' => 'single_text',
            ])
            // Ajout du champ note : association avec l'entité Note
            ->add('note', ChoiceType::class, [
            'choices' => [
                '1 étoile' => 1,
                '2 étoiles' => 2,
                '3 étoiles' => 3,
                '4 étoiles' => 4,
                '5 étoiles' => 5,
            ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Votre note (de 1 à 5)',
                'mapped' => false,
            ])
            ->add('Envoyer', SubmitType::class, [
                'label' => 'Envoyer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
