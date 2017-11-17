<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function listMessageDeleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $message = $em->getRepository('AppBundle:Contact')->find($id);

        if (null === $message)
        {
            throw new NotFoundHttpException('L\'utilisateur n\'existe pas !');
        }

        // Formulaire qui contient juste le champ crsf pour la sécurité
        $form = $this->get('form.factory')->create();

        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $em->remove($message);
                $em->flush();

                return $this->redirectToRoute('manage_message_comment_list_message');
            }
        }
        return $this->render('ManageMessageComment/deleteListMessage.html.twig', array(
            'message' => $message,
            'form'   => $form->createView(),
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