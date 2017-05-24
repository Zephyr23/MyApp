<?php
namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/user")
 */

class UserController extends Controller
{

    /**
     * @Route("/{username}",options={"expose"=true}, name="user")
     * @param Request $request
     * @param $username
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function userAction(Request $request, $username)
    {
        $user=null;

        if($this->isGranted('IS_AUTHENTICATED_FULLY')){

            $user = $this->getUser();
        }

        return $this->render('AppBundle:User:user_page.html.twig', array(
            'user'=>$user

        ));
    }

}