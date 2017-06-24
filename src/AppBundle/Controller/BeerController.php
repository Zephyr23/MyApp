<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Beer;
use stdClass;

/**
 * @Route("/beer")
 */

class BeerController extends Controller
{
    /**
     * @Route("/{name}",options={"expose"=true}, name="beer")
     * @param Request $request
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function beerAction(Request $request, $name)
    {
        $user=null;

        if($this->isGranted('IS_AUTHENTICATED_FULLY')){

            $user = $this->getUser();
        }

        $beer = $this->getDoctrine()->getRepository('AppBundle:Beer')->findOneBy([
            'name'=>$name
        ]);

        // Get Pubs from PriceLists
        $prices =$beer->getPrice(); //getPrices!

        $pubs[][] = new stdClass();

        foreach($prices as $key =>$price){
            $priceList=$price->getPricelist();
           // var_dump($priceList);die;
            foreach($priceList as $k => $p){
                $pubs[$key][$k]= new stdClass();
                $pub = $this->getDoctrine()->getRepository('AppBundle:Pub')->findOneBy([
                    'pricelist'=>$p
                ]);
                $pubs[$key][$k]->price = $price->getPrice();
                $pubs[$key][$k]->pub= $pub;
            }
        }


        return $this->render('AppBundle:Beer:beer_page.html.twig', array(
            'beer'=>$beer,
            'user'=>$user,
            'pubslist'=>$pubs
        ));
    }
}