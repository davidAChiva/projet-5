<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\PartOfMenu;
use AppBundle\Form\PartOfMenuType;

class ManagePartOfMenuController extends Controller

{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partsOfMenu = $em->getRepository('AppBundle:PartOfMenu')->findAll();

        return $this->render('ManagePartOfMenu/index.html.twig', array(
            'partsOfMenu'       => $partsOfMenu
        ));
    }

    public function addAction(Request $request)
    {
        $partOfMenu = new PartOfMenu();

        $form = $this->get('form.factory')->create(PartOfMenuType::class,$partOfMenu);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partOfMenu);
            $em->flush();

            return $this->redirectToRoute('manage_part_of_menu_index');
        }

        return $this->render('ManagePartOfMenu/add.html.twig', array(
            'partOfMenu'      => $partOfMenu,
            'form'            => $form->createView()
        ));
    }

}