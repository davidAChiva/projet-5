<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\CookingRecipe;
use AppBundle\Form\CookingRecipeType;

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

    public function addAction(Request $request)
    {
        $cookingRecipe = new CookingRecipe();

        $form = $this->get('form.factory')->create(CookingRecipeType::class,$cookingRecipe);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cookingRecipe);
            $em->flush();

            return $this->redirectToRoute('manage_cooking_recipe_index');
        }

        return $this->render('ManageCookingRecipe/add.html.twig', array(
            'form'  => $form->createView(),
        ));
    }
}