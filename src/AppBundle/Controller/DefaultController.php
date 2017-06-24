<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Beer;
use AppBundle\Form\BeerFilterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use stdClass;
class DefaultController extends Controller
{
    /**
     * @Route("/",options={"expose"=true}, name="homepage")
     */
    public function indexAction(Request $request)
    {

        $user=null;

        if($this->isGranted('IS_AUTHENTICATED_FULLY')){

            $user = $this->getUser();
        }

        $allPubs = $this->getDoctrine()->getRepository('AppBundle:Pub')->findAll();
        $pubs[][] = new stdClass();
        foreach($allPubs as $key =>$pub) {
            $pubs[0][$key]= new stdClass();
            $pubs[0][$key]->pub=$pub;
            $pubs[0][$key]->price='0';

        }
        $beers[] =new stdClass();
        $beers[0]->beer=null;
        $beers[0]->price=null;
        $allBeers = $this->getDoctrine()->getRepository('AppBundle:Beer')->findAll();

        foreach($allBeers as $key =>$beer) {
            $beers[$key] = new stdClass();
            $beers[$key]->beer = $beer;
            $allPrices = $beer->getPrice();

            if ($allPrices->isEmpty()==false) {

                $max = $beer->getPrice()->get(0)->getPrice();
                $min = $beer->getPrice()->get(0)->getPrice();
                foreach ($allPrices as $price) {
                    $curr = $price->getPrice();
                    if ($curr < $min) {
                        $min = $curr;
                    }
                    if($curr> $max){
                        $max=$curr;
                    }
                }
                $beers[$key]->price = $min .'/' . $max;
            }
            else{
                $beers[$key]->price = 'noinfo';
            }
        }

        $beerForm = new Beer();
        $numP=($pubs[0][0]->pub == null? 0 : count($pubs[0]));
        $numB=($beers[0]->beer == null? 0 : count($beers));

        $form = $this->createForm(BeerFilterType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
           // var_dump($form->getData());

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();
            $formSubmited = true;
            return $this->render('AppBundle:default:index.html.twig', array(
                'pubslist'=> $pubs,
                'user'=>$user,
                'beers'=> $beers,
                'numP'=> $numP,
                'numB'=> $numB,
                'form'=> $form->createView(),
                'formSubmited' => $formSubmited,
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            ));
        }


        return $this->render('AppBundle:default:index.html.twig', array(
            'pubslist'=> $pubs,
            'user'=>$user,
            'beers'=> $beers,
            'numP'=> $numP,
            'numB'=> $numB,
            'form'=> $form->createView(),
            'formSubmited' => false,
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


    public function recentBeerAction(Request $request)
    {
        $beers[] =new stdClass();
        $beers[0]->beer=null;
        $beers[0]->price=null;
        $allBeers = $this->getDoctrine()->getRepository('AppBundle:Beer')->findAll();

        foreach($allBeers as $key =>$beer) {
            $beers[$key] = new stdClass();
            $beers[$key]->beer = $beer;
            $allPrices = $beer->getPrice();

            if ($allPrices->isEmpty()==false) {

                $max = $beer->getPrice()->get(0)->getPrice();
                $min = $beer->getPrice()->get(0)->getPrice();
                foreach ($allPrices as $price) {
                    $curr = $price->getPrice();
                    if ($curr < $min) {
                        $min = $curr;
                    }
                    if($curr> $max){
                        $max=$curr;
                    }
                }
                $beers[$key]->price = $min .'/' . $max;
            }
            else{
                $beers[$key]->price = 'noinfo';
            }
        }

        $form = $this->createForm(BeerFilterType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->render('AppBundle:Partial:beerlist.html.twig', array(
                    'beers' => $beers,
                    'form'=> $form->createView(),
                )
            );
        }


        return $this->render('AppBundle:Partial:beerlist.html.twig', array(
            'beers' => $beers,
                'form'=> $form->createView(),
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            )
        );
    }

    /**
     * @Route("/search/{searchItem}",options={"expose"=true}, name="search")
     * @param $searchItem
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request, $searchItem)
    {
        $user = null;
        $items = null;

        if($this->isGranted('IS_AUTHENTICATED_FULLY')){
            $user = $this->getUser();
        }

        if(strcmp($searchItem,'pubs') == 0 ) {

            $allPubs = $this->getDoctrine()->getRepository('AppBundle:Pub')->findAll();
            $pubs[][] = new stdClass();
            foreach ($allPubs as $key => $pub) {
                $pubs[0][$key] = new stdClass();
                $pubs[0][$key]->pub = $pub;
                $pubs[0][$key]->price = '0';
            }
            $items=$pubs;
        }
        if(strcmp($searchItem,'beers') == 0) {
            $beers[] = new stdClass();
            $beers[0]->beer = null;
            $beers[0]->price = null;
            $allBeers = $this->getDoctrine()->getRepository('AppBundle:Beer')->findAll();

            foreach ($allBeers as $key => $beer) {
                $beers[$key] = new stdClass();
                $beers[$key]->beer = $beer;
                $allPrices = $beer->getPrice();

                if ($allPrices->isEmpty() == false) {

                    $max = $beer->getPrice()->get(0)->getPrice();
                    $min = $beer->getPrice()->get(0)->getPrice();
                    foreach ($allPrices as $price) {
                        $curr = $price->getPrice();
                        if ($curr < $min) {
                            $min = $curr;
                        }
                        if ($curr > $max) {
                            $max = $curr;
                        }
                    }
                    $beers[$key]->price = $min . '/' . $max;
                } else {
                    $beers[$key]->price = 'noinfo';
                }
            }
            $items = $beers;
        }

        return $this->render('AppBundle:Search:search_page.html.twig', array(
                'items' => $items,
                'searchItem' => $searchItem,
                'user'=>$user,
            )
        );

    }
}
