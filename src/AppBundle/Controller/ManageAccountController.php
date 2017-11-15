<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManageAccountController extends Controller

{

    public function userAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('ManageAccount/user.html.twig', array(
            'users'       => $users
        ));
    }

    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $admins = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('ManageAccount/admin.html.twig', array(
            'admins'       => $admins
        ));
    }

}