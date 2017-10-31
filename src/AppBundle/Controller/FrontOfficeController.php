<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FrontOfficeController extends Controller

{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ingredientCategories = $em->getRepository('AppBundle:IngredientCategory')->findAll();

        $partsOfMenu = $em->getRepository('AppBundle:PartOfMenu')->findAll();

        $specialtiesCountries = $em->getRepository('AppBundle:SpecialtyCountry')->findAll();

        return $this->render('FrontOffice/index.html.twig', array(
            'ingredientCategories' => $ingredientCategories,
            'partsOfMenu' => $partsOfMenu,
            'specialtiesCountries' => $specialtiesCountries
        ));
    }

    public function CategoryIngredientAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $ingredients = $em->getRepository('AppBundle:IngredientCategory')->findBy($id);

        return $this->render('FrontOffice/ingredientCategory.html.twig', array(
            'ingredients' => $ingredients
        ));
    }
}
