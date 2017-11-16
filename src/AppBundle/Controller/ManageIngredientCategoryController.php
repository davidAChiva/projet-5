<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\IngredientCategory;
use AppBundle\Form\IngredientCategoryType;

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

    public function addAction(Request $request)
    {
        $ingredientCategory = new IngredientCategory();

        $form = $this->get('form.factory')->create(IngredientCategoryType::class,$ingredientCategory);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredientCategory);
            $em->flush();

            return $this->redirectToRoute('manage_ingredientCategory_index');
        }

        return $this->render('ManageIngredientCategory/add.html.twig', array(
            'ingredientCategory'    => $ingredientCategory,
            'form'                  => $form->createView()
        ));
    }

}