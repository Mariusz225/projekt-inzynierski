<?php

namespace App\Controller\Admin;

use App\Entity\DateAvailability;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class DateAvailabilityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DateAvailability::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('date'),
            AssociationField::new('shop'),
            NumberField::new('quantity'),
        ];
    }
}
