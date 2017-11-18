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

}