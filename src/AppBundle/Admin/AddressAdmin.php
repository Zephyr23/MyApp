<?php
// src/AppBundle/Admin/AddressAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AddressAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('streetName')
            ->addIdentifier('streetNumber')
            ->addIdentifier('postcode')
            ->addIdentifier('city')
            ->addIdentifier('district')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('streetName')
            ->add('streetNumber')
            ->add('postcode')
            ->add('city')
            ->add('district')
            ->end()
        ;
    }
}