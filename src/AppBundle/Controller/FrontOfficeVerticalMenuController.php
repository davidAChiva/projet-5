<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class FrontOfficeVerticalMenuController extends Controller

{
    public function ingredientsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ingredients = $em->getRepository('AppBundle:Ingredient')->findAll();

        return $this->render('ViewAllElement/ingredients.html.twig', array(
            'ingredients'       => $ingredients,
        ));
    }

    public function partsMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $partsMenu = $em->getRepository('AppBundle:PartOfMenu')->findAll();

        return $this->render('ViewAllElement/partsMenu.html.twig', array(
            'partsMenu'       => $partsMenu
        ));
    }

    public function specialtiesCountryAction()
    {
        $em = $this->getDoctrine()->getManager();
        $specialtiesCountry = $em->getRepository('AppBundle:SpecialtyCountry')->findAll();

        return $this->render('ViewAllElement/specialtiesCountry.html.twig', array(
            'specialtiesCountry'       => $specialtiesCountry
        ));
    }

    public function cookingRecipesAction($page)
    {
        if ($page < 1)
        {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $nbPerPage = 5;

        $em = $this->getDoctrine()->getManager();
        $cookingRecipes = $em->getRepository('AppBundle:CookingRecipe')->getAllRecipes($page, $nbPerPage);

        $nbPages = ceil(count($cookingRecipes) /$nbPerPage);
        if ($page > $nbPages)
        {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }
        return $this->render('ViewAllElement/cookingRecipes.html.twig', array(
            'cookingRecipes'       => $cookingRecipes,
            'nbPages'              => $nbPages,
            'page'                 => $page
        ));
    }

    public function popularityRecipesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recipes = $em->getRepository('AppBundle:CookingRecipe')->getAllRecipeMostPopular();

        return $this->render('ViewAllElement/popularityRecipes.html.twig', array(
            'recipes'           =>  $recipes
        ));
    }
}