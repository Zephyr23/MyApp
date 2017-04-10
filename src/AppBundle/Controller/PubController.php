<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use stdClass;

/**
 * @Route("/pubs")
 */

class PubController extends Controller
{
    /**
     * @Route("/{name}",options={"expose"=true}, name="pub")
     * @param Request $request
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function pubsAction(Request $request, $name)
    {
        $pub = $this->getDoctrine()->getRepository('AppBundle:Pub')->findOneBy([
            'name'=>$name
        ]);

        $em = $this->getDoctrine()->getManager();
        $gallery = $pub->getGallery();
        $media=null;
        $beers=null;

        $images = $em->getRepository('ApplicationSonataMediaBundle:GalleryHasMedia')->findBy(
            array(
                'gallery' => $gallery,
            )
        );

        foreach($images as $image){
            $media[] = $image->getMedia();
        }

        // Get Beers from Price
        $priceList =$pub->getPricelist();
        $beerPrices= $priceList->getBeerprice();
        $beers[] = new stdClass();
        foreach($beerPrices as $key =>$beerPrice){
            $beers[$key]= new stdClass();
            $beers[$key]->price = $beerPrice->getPrice();
            $b=$beerPrice->getBeer();
            foreach($b as $beer){
                $beers[$key]->beer = $beer;
            }
        }
        $numB = count($beers);
        $numI = count($media);

        // replace this example code with whatever you need
        return $this->render('AppBundle:Pub:pub_page.html.twig', array(
            'pub'=> $pub,
            'beers'=>$beers,
            'images'=>$media,
            'numB'=>$numB,
            'numI'=>$numI,
        ));
    }
}
