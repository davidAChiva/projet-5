<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ingredient = $em->getRepository('AppBundle:Ingredient')->find($id);

        if (null === $ingredient)
        {
            throw new NotFoundHttpException("L' ingrédient n'existe pas n'existe pas.");
        }

        $form = $this->get('form.factory')->create(IngredientType::class,$ingredient);
        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirectToRoute('manage_ingredient_index');
            }
        }

        return $this->render('ManageIngredient/edit.html.twig', array(
            'ingredient' => $ingredient,
            'form'   => $form->createView()
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $ingredient = $em->getRepository('AppBundle:Ingredient')->find($id);

        if (null === $ingredient)
        {
            throw new NotFoundHttpException('L\'ingrédient n\'existe pas !');
        }

        // Formulaire qui contient juste le champ crsf pour la sécurité
        $form = $this->get('form.factory')->create();

        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $em->remove($ingredient);
                $em->flush();

                return $this->redirectToRoute('manage_ingredient_index');
            }
        }
        return $this->render('ManageIngredient/delete.html.twig', array(
            'ingredient' => $ingredient,
            'form'   => $form->createView(),
        ));
    }
}