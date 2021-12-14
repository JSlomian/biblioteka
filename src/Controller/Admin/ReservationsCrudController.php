<?php

namespace App\Controller\Admin;

use App\Entity\Reservations;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ReservationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservations::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('bname'),
            CollectionField::new('uemail'),
            DateField::new('taken')
        ];
    }
}
