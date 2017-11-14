<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BackOfficeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lastRecipes = $em->getRepository('AppBundle:CookingRecipe')->getLastRecipes(5);
        return $this->render('BackOffice/index.html.twig', array(
            'lastRecipes'       => $lastRecipes
        ));
    }
}