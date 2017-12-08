<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class ManageCommentRecipeController extends Controller

{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('AppBundle:CommentRecipe')->findAll();

        return $this->render('ManageCommentRecipe/index.html.twig', array(
            'comments'       => $comments
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('AppBundle:CommentRecipe')->find($id);

        if (null === $comment)
        {
            throw new NotFoundHttpException('Le commentaire n\'existe pas !');
        }

        // Formulaire qui contient juste le champ crsf pour la sécurité
        $form = $this->get('form.factory')->create();

        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                // On récupére l'id de la recette commenté pour l'utiliser ensuite
                $idRecipe = $comment->getCookingRecipe()->getId();
                $em->remove($comment);
                // On recalcule la moyenne des notes de la recette
                //
                //Dans un premier temps on récupére les notes de la recette
                $average = $em->getRepository('AppBundle:CommentRecipe')->calculAverage($idRecipe);
                $averageRecipe = $average[0];
                $averageRecipe = $averageRecipe['average'];
                // On récupére la recette
                $cookingRecipe = $em->getRepository('AppBundle:CookingRecipe')->find($idRecipe);
                $cookingRecipe->setAverageNotes($averageRecipe);
                $em->persist($cookingRecipe);
                $em->flush();

                return $this->redirectToRoute('manage_comment_recipe_index');
            }
        }
        return $this->render('ManageCommentRecipe/delete.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView(),
        ));
    }

}