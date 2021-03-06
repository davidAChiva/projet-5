<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $cookingRecipe->setUser($user);
            $em->persist($cookingRecipe);
            $em->flush();

            return $this->redirectToRoute('manage_cooking_recipe_index');
        }

        return $this->render('ManageCookingRecipe/add.html.twig', array(
            'form'  => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cookingRecipe = $em->getRepository('AppBundle:CookingRecipe')->find($id);

        if (null === $cookingRecipe)
        {
            throw new NotFoundHttpException("La recette n'existe pas.");
        }

        $form = $this->get('form.factory')->create(CookingRecipeType::class,$cookingRecipe);

        $form->handleRequest($request);


        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirectToRoute('manage_cooking_recipe_index');
            }
        }

        return $this->render('ManageCookingRecipe/edit.html.twig', array(
            'cookingRecipe' => $cookingRecipe,
            'form'   => $form->createView()
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $cookingRecipe = $em->getRepository('AppBundle:CookingRecipe')->find($id);

        if (null === $cookingRecipe)
        {
            throw new NotFoundHttpException('La recette n\'existe pas !');
        }
        // Formulaire qui contient juste le champ crsf pour la sécurité
        $form = $this->get('form.factory')->create();

        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                // On récupére les commentaires de la recette
                $comments = $em->getRepository('AppBundle:CommentRecipe')->getCommentsOfRecipe($id);

                //Si il y a des commetaires, alors on les supprime pour éviter d'avoir des commentaires orphelines
                if (count($comments) > 0)
                {
                    foreach($comments as $comment)
                    {
                        $em->remove($comment);
                    }
                }

                // On récupére les statistiques concernant la recette
                $statisticsRecipe = $em->getRepository('AppBundle:Statistic')->findBy(array('cookingRecipe' => $cookingRecipe));

                // Si il y a des statistiques, alors on les supprime
                if (count($statisticsRecipe) > 0)
                {
                    foreach($statisticsRecipe as $statisticRecipe)
                    {
                        $em->remove($statisticRecipe);
                    }
                }
                $em->remove($cookingRecipe);
                $em->flush();

                return $this->redirectToRoute('manage_cooking_recipe_index');
            }
        }
        return $this->render('ManageCookingRecipe/delete.html.twig', array(
            'cookingRecipe' => $cookingRecipe,
            'form'   => $form->createView(),
        ));
    }
}
