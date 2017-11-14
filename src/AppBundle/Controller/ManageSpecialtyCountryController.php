<?php

namespace AppBundle\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

}