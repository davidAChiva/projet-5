<?php

namespace AppBundle\Controller;

use AppBundle\Form\IngredientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ingredientCategory = $em->getRepository('AppBundle:IngredientCategory')->find($id);

        if (null === $ingredientCategory)
        {
            throw new NotFoundHttpException("La catégorie n'existe pas.");
        }

        $form = $this->get('form.factory')->create(IngredientCategoryType::class,$ingredientCategory);
        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirectToRoute('manage_ingredient_category_index');
            }
        }

        return $this->render('ManageIngredientCategory/edit.html.twig', array(
            'ingredientCategory' => $ingredientCategory,
            'form'   => $form->createView()
        ));
    }

}