<?php

namespace App\Controller\Admin;

use App\Entity\Film;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Component\DomCrawler\Image;

class FilmCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Film::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('titre'),
            DateField::new('dateSortie')
                ->setFormat('dd/MM/yyyy'),
            TimeField::new('duree')
                ->setFormat('HH:mm'),
            ImageField::new('affiche')
                ->setBasePath('uploads/affiche')
                ->setUploadDir('public/assets/uploads/affiche')
                ->setRequired(false)
                ->setFormTypeOptions([
                    'allow_file_upload' => true,
                    'mapped' => false,
                ]),
            TextareaField::new('synopsis')
                ->setFormTypeOptions([
                    'attr' => [
                        'rows' => 10,
                    ],
                ]),
            AssociationField::new('genre')
                ->setFormTypeOptions([
                    'multiple' => true,
                    'expanded' => true,
                ]),
            AssociationField::new('realisateur')
                ->setFormTypeOptions([
                    'multiple' => true,
                    'expanded' => true,
                ]),
            AssociationField::new('acteur')
                ->setFormTypeOptions([
                    'multiple' => true,
                    'expanded' => true,
                ]),
        ];
    }
   
}
