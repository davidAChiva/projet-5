<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FrontOfficeController extends Controller

{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ingredientCategories = $em->getRepository('AppBundle:IngredientCategory')->findAll();
        return $this->render('FrontOffice/index.html.twig', array(
            'ingredientCategories' => $ingredientCategories
        ));
    }
}
