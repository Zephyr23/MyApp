<?php
namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{
    /**
     * @Route("/profile", options={"expose"=true}, name="user_profile")
     */
    public function userAction(Request $request)
    {

        return $this->render('AppBundle:profile:profile.html.twig');
    }

}