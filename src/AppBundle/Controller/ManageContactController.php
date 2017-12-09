<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class ManageContactController extends Controller

{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('AppBundle:Contact')->findAll();

        return $this->render('ManageContact/index.html.twig', array(
            'messages'       => $messages
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $message = $em->getRepository('AppBundle:Contact')->find($id);

        if (null === $message)
        {
            throw new NotFoundHttpException('Le message n\'existe pas !');
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

                return $this->redirectToRoute('manage_contact_index');
            }
        }
        return $this->render('ManageContact/delete.html.twig', array(
            'message' => $message,
            'form'   => $form->createView(),
        ));
    }

}
