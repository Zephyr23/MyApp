<?php
/**
 * Created by PhpStorm.
 * User: nenad
 * Date: 21.10.16.
 * Time: 12.00
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TestController extends Controller
{
    /**
     * @Route("/lucky/number")
     */

    public function numberAction()
    {
        $number = mt_rand(0, 100);

        return $this->render('AppBundle:lucky:number.html.twig', array(
            'number' => $number,
        ));
    }

}