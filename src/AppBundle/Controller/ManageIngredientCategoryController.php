<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManageIngredientCategoryController extends Controller

{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ingredientCategories = $em->getRepository('AppBundle:IngredientCategory')->findAll();

        return $this->render('ManageIngredientCategory/index.html.twig', array(
            'ingredientCategories'       => $ingredientCategories
        ));
    }

}