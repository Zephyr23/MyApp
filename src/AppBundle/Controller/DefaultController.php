<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends Controller
{
    /**
     * @Route("/",options={"expose"=true}, name="homepage")
     */
    public function indexAction(Request $request)
    {
        $pubs = $this->getDoctrine()->getRepository('AppBundle:Pub')->findAll();
        $beers = $this->getDoctrine()->getRepository('AppBundle:Beer')->findAll();

        $numP=count($pubs);
        $numB=count($beers);

        // replace this example code with whatever you need
        return $this->render('AppBundle:default:index.html.twig', array(
            'pubs'=> $pubs,
            'beers'=> $beers,
            'numP'=> $numP,
            'numB'=> $numB,
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/map",options={"expose"=true}, name="map")
     */
    public function mapAction(Request $request)
    {

        $pubs = $this->getDoctrine()->getRepository('AppBundle:Pub')->findAll();
        $arrayCollection = array();

        foreach ($pubs as $pub) {

            $address = str_replace(" ", "+", $pub->getAddress()->__toString()); // replace all the white space with "+" sign to match with google search pattern

            $url = "http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false&v=3.9";

            $response = file_get_contents($url);

            $json = json_decode($response, true); //generate array object from the response from the web

            //var_dump($json['results'][0]['geometry']['location']['lat'] . "," . $json['results'][0]['geometry']['location']['lng']);
            $addressName= $pub->getAddress()->getStreetName() .' ' .$pub->getAddress()->getStreetNumber();

            $arrayCollection[] = array(
                'id' => $pub->getId(),
                'name'=>$pub->getName(),
                'address'=> $addressName,
                'longitude'=>$json['results'][0]['geometry']['location']['lng'],
                'latitude'=>$json['results'][0]['geometry']['location']['lat']
            );
        }

        return new JsonResponse($arrayCollection);

    }
}
