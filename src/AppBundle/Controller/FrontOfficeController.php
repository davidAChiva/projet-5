<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\CookingRecipe;
use AppBundle\Form\CookingRecipeType;


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

        $recipesOfCategory = $em->getRepository('AppBundle:CookingRecipe')->getRecipesOfCategoryIngredient($id);

        return $this->render('FrontOffice/ingredientCategory.html.twig', array(
            'ingredients'       => $ingredients,
            'category'          => $category,
            'recipesOfCategory' => $recipesOfCategory
        ));
    }

    public function ingredientAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $ingredient = $em->getRepository('AppBundle:Ingredient')->find($id);

        $recipes = $em->getRepository('AppBundle:CookingRecipe')->getRecipesOfIngredient($id);

        return $this->render('FrontOffice/ingredient.html.twig', array (
            'ingredient'       => $ingredient,
            'recipes'          => $recipes
        ));
    }

    public function partMenuAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $partOfMenu = $em->getRepository('AppBundle:PartOfMenu')->find($id);

        $recipes = $em->getRepository('AppBundle:CookingRecipe')-> getRecipesOfTypeMenu($id);

        return $this->render('FrontOffice/partMenu.html.twig', array(
            'partOfMenu'        =>  $partOfMenu,
            'recipes'           =>  $recipes
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

    public function addRecipeAction(Request $request)
    {
        $cookingRecipe = new CookingRecipe();

        $form = $this->get('form.factory')->create(CookingRecipeType::class,$cookingRecipe);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cookingRecipe);
            $em->flush();

            return $this->redirectToRoute('front_index');
        }

        return $this->render('FrontOffice/addRecipe.html.twig', array(
                'form'  => $form->createView(),
        ));
    }

    public function recipeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cookingRecipe = $em->getRepository('AppBundle:CookingRecipe')->find($id);

        return $this->render('FrontOffice/recipe.html.twig',array (
            'cookingRecipe' => $cookingRecipe,
        ));
    }
}
