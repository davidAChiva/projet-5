<?php

namespace AppBundle\Controller;




use AppBundle\Form\SpecialtyCountryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\SpecialtyCountry;

class ManageSpecialtyCountryController extends Controller

{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoriesSpecialtyCountry = $em->getRepository('AppBundle:SpecialtyCountry')->findAll();

        return $this->render('ManageSpecialtyCountry/index.html.twig', array(
            'categoriesSpecialtyCountry'       => $categoriesSpecialtyCountry
        ));
    }

    public function addAction(Request $request)
    {
        $specialtyCountry = new SpecialtyCountry();

        $form = $this->get('form.factory')->create(SpecialtyCountryType::class,$specialtyCountry);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($specialtyCountry);
            $em->flush();

            return $this->redirectToRoute('manage_specialty_country_index');
        }

        return $this->render('ManageSpecialtyCountry/add.html.twig', array(
            'specialtyCountry'      => $specialtyCountry,
            'form'                  => $form->createView()
        ));
    }

}