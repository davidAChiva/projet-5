<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManagePartOfMenuController extends Controller

{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partsOfMenu = $em->getRepository('AppBundle:PartOfMenu')->findAll();

        return $this->render('ManagePartOfMenu/index.html.twig', array(
            'partsOfMenu'       => $partsOfMenu
        ));
    }

}