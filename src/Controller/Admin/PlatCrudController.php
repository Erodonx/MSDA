<?php

namespace App\Controller\Admin;

use App\Entity\Plat;
use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plat::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle'),
            TextEditorField::new('description'),
            BooleanField::new('isActive'),
            MoneyField::new('prix')->setCurrency('EUR'),
            ImageField::new('image')->setUploadDir('/public/images')
                                    ->setBasePath('/images'),
            AssociationField::new('categorie')->autocomplete()
            
        ];
    }

}
