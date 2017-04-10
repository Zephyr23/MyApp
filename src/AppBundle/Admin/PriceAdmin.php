<?php
// src/AppBundle/Admin/PriceAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\UnitOfWork;

class PriceAdmin extends Admin
{

    /*public function postUpdate($object)
    {
        $em = $this->getModelManager()->getEntityManager($this->getClass());
        $original =(object) $em->getUnitOfWork()->getOriginalEntityData($object);
        $beers = $original->beer;
        $pubs= $original->pub;
        foreach ($beers as $beer){
           $beerName = $beer;
            var_dump($beerName->getId());
        }
        foreach ($pubs as $pub){
            $pubName = $pub;
            var_dump($pubName->getId());

        }
        $entity = $em
            ->getRepository('AppBundle:Price')
            ->createQueryBuilder('e')
            ->leftJoin('AppBundle:Beer', 'beer', 'WITH', 'beer.id = e.id')
            ->leftJoin('AppBundle:Pub', 'pub', 'WITH', 'pub.id = e.id')
            ->where('beer.id = :group OR pub.id = :group')
            ->setParameter('group', $beerName->getId())
            ->getQuery()
            ->getResult();

        var_dump($entity);die;

        $obj = $em->getRepository('AppBundle:Price')->findOneBy(array('id' => $original->id, 'price'=>$original->price,
            'beer' => $beerName->getId()));
        var_dump($obj);die;
           // $em->remove($obj);
            //$em->flush();


    }*/

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC', // sort direction
        '_sort_by' => 'pub.name' // field name
    );

    protected function configureListFields(ListMapper $listMapper)
    {
       // var_dump();die;
        $listMapper
            ->addIdentifier('pricelist')
            ->addIdentifier('beer')
            ->addIdentifier('price')
        ;

    }


    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper->add('pricelist.name');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('price', 'text')
            ->add('beer', 'sonata_type_model' ,array(
                    'multiple' => true,
                ))
            ->add('pricelist', 'sonata_type_model',array(
                'multiple' => true,
            ))
            ->end()
        ;
    }
}