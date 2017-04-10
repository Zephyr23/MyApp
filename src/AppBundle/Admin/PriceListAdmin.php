<?php
// src/AppBundle/Admin/PriceListAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\UnitOfWork;

class PriceListAdmin extends Admin
{


    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
        ;

    }


    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('beerprice', 'sonata_type_model', array(
                'multiple'=>true,
            ))
            ->end()
        ;
    }
}