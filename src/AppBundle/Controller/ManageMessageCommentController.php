<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManageMessageCommentController extends Controller

{

    public function listMessageAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('AppBundle:Contact')->findAll();

        return $this->render('ManageMessageComment/listMessage.html.twig', array(
            'messages'       => $messages
        ));
    }

    public function listCommentAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('AppBundle:CommentRecipe')->findAll();

        return $this->render('ManageMessageComment/listComment.html.twig', array(
            'comments'       => $comments
        ));
    }

}