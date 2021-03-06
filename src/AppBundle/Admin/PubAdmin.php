<?php
// src/AppBundle/Admin/PubAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PubAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->with('General') // these fields from Users Entity
            ->add('name', 'text')
            ->add('ohoursWeekdaysFrom')
            ->add('ohoursWeekdaysTo')
            ->add('ohoursSaturdayFrom')
            ->add('ohoursSaturdayTo')
            ->add('ohoursSundayFrom')
            ->add('ohoursSundayTo')
            ->end()
            ->with('Address')
            ->add('address', 'sonata_type_admin', array( 'by_reference' => false, ), array( 'edit' => 'inline', 'inline' => 'table', ) )
            ->end()
            ->with('Beer')
            ->add('beers', 'sonata_type_model', array(
                'multiple' => true,
            ))
            ->end()
            ->with('Images')
            ->add('picture', 'sonata_type_model')
            ->add('gallery', 'sonata_type_model');

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name')
            ->add('address.streetName')
            ->add('address.streetNumber')
            ->add('address.postcode')
            ->add('address.city')
            ->add('address.district');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')
            ->addIdentifier('address.streetName')
            ->addIdentifier('address.streetNumber')
            ->addIdentifier('address.postcode')
            ->addIdentifier('address.city')
            ->addIdentifier('address.district');
    }
}