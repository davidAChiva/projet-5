<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Ingredient;
use AppBundle\Form\IngredientType;

class ManageIngredientController extends Controller

{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ingredients = $em->getRepository('AppBundle:Ingredient')->findAll();

        return $this->render('ManageIngredient/index.html.twig', array(
            'ingredients'       => $ingredients
        ));
    }

    public function addAction(Request $request)
    {
        $ingredient = new Ingredient();

        $form = $this->get('form.factory')->create(IngredientType::class,$ingredient);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredient);
            $em->flush();

            return $this->redirectToRoute('manage_ingredient_index');
        }

        return $this->render('ManageIngredient/add.html.twig', array(
            'ingredient'            => $ingredient,
            'form'                  => $form->createView()
        ));
    }
}