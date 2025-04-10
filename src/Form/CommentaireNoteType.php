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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentaireNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('publishedAt', HiddenType::class, [
                'data' => new \DateTimeImmutable()->format('Y-m-d H:i:s'), // ou à gérer dans le contrôleur
                'mapped' => false // si tu veux le gérer manuellement
            ])
            // Ajout du champ note : association avec l'entité Note
            ->add('note', HiddenType::class, [
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
