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

    public function categoryIngredientAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $ingredients = $em->getRepository('AppBundle:Ingredient')->getIngredientsOfCategory($id);

        $category = $em->getRepository('AppBundle:IngredientCategory')->find($id);

        return $this->render('FrontOffice/ingredientCategory.html.twig', array(
            'ingredients' => $ingredients,
            'category'    => $category
        ));
    }

    public function countrySpecialtyAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $specialtyCountry = $em->getRepository('AppBundle:SpecialtyCountry')->find($id);

        return $this->render('FrontOffice/countrySpecialty.html.twig', array(
                'specialtyCountry' => $specialtyCountry
        ));
    }
}
