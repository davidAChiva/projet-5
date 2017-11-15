<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManageCookingRecipeController extends Controller

{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cookingRecipes = $em->getRepository('AppBundle:CookingRecipe')->findAll();

        return $this->render('ManageCookingRecipe/index.html.twig', array(
            'cookingRecipes'       => $cookingRecipes
        ));
    }

}