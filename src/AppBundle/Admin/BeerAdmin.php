<?php
// src/AppBundle/Admin/BeerAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BeerAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('type')
            ->addIdentifier('style')
            ->addIdentifier('manufacturer')
            ->addIdentifier('country')
            ->addIdentifier('ABV')
            ->addIdentifier('description')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('picture', 'sonata_type_model')
            ->add('type')
            ->add('style')
            ->add('manufacturer')
            ->add('country')
            ->add('ABV')
            ->add('description', 'textarea', array('required' => false))
            ->end()
        ;
    }
}