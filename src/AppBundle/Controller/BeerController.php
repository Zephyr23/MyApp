<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Beer;

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
        $beer = $this->getDoctrine()->getRepository('AppBundle:Beer')->findOneBy([
            'name'=>$name
        ]);

        $pubs= $beer->getPubs();



        // replace this example code with whatever you need
        return $this->render('AppBundle:Beer:beer_page.html.twig', array(
            'beer'=>$beer,
            'pubs'=>$pubs
        ));
    }
}