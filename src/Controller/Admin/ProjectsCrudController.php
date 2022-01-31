<?php

namespace App\Controller\Admin;

use App\Entity\Projects;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Projects::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom du Projet'),
            TextEditorField::new('description')->setLabel('Description'),
            DateField::new('created_at')->setLabel('Crée le')->onlyOnIndex(),
            DateField::new('created_at')->setLabel('Crée le')->onlyWhenUpdating(),
            DateField::new('updated_at')->setLabel('Modifié le')->onlyOnIndex(),
            DateField::new('updated_at')->setLabel('Modifié le')->onlyWhenUpdating(),
            UrlField::new('url_web')->setLabel('Lien Web'),
            UrlField::new('url_git')->setLabel('Lien GitHub'),
            AssociationField::new('tags')->setLabel('Tag(s)')->hideOnIndex(),
            TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex()->setLabel('Ajouter une Image'),
            ImageField::new('file')->setBasePath('/uploads/projects/')->onlyOnIndex(),
            TextField::new('slug')->setLabel('Slug')->onlyOnIndex(),

        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDateFormat('long')
            ->setTimezone('Europe/Paris')
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->setPageTitle('index', 'Liste des Projets');
    }

}
