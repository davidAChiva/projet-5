<?php

namespace AppBundle\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\NewsletterInscription;
use AppBundle\Form\NewsletterInscriptionType;
use AppBundle\Entity\CookingRecipe;
use AppBundle\Form\CookingRecipeType;
use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use AppBundle\Entity\CommentRecipe;
use AppBundle\Form\CommentRecipeType;


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

        $recipes = $em->getRepository('AppBundle:CookingRecipe')->getRecipesOfTypeMenu($id);

        return $this->render('FrontOffice/partMenu.html.twig', array(
            'partOfMenu'        =>  $partOfMenu,
            'recipes'           =>  $recipes
        ));
    }

    public function countrySpecialtyAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $specialtyCountry = $em->getRepository('AppBundle:SpecialtyCountry')->find($id);

        $recipes = $em->getRepository('AppBundle:CookingRecipe')->getRecipesOfCountry($id);

        return $this->render('FrontOffice/countrySpecialty.html.twig', array(
                'specialtyCountry' => $specialtyCountry,
                'recipes'          => $recipes
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

            return $this->redirectToRoute('front_office_index');
        }

        return $this->render('FrontOffice/addRecipe.html.twig', array(
                'form'  => $form->createView(),
        ));
    }

    public function recipeAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cookingRecipe = $em->getRepository('AppBundle:CookingRecipe')->find($id);

        $commentRecipe = new CommentRecipe();
        $form = $this->get('form.factory')->create(CommentRecipeType::class,$commentRecipe);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $commentRecipe->setCookingRecipe($cookingRecipe);
            $em->persist($commentRecipe);
            $em->flush();

            return $this->redirectToRoute('front_office_index');
        }
        return $this->render('FrontOffice/recipe.html.twig',array (
            'cookingRecipe' => $cookingRecipe,
            'form'          => $form->createView()
        ));
    }

    public function newsletterInscriptionAction(Request $request)
    {
        $newsletterInscription = new NewsletterInscription();
        $form = $this->get('form.factory')->create(NewsletterInscriptionType::class,$newsletterInscription);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newsletterInscription);
            $em->flush();

            return $this->redirectToRoute('front_office_index');
        }
        return $this->render('FrontOffice/newsletterInscription.html.twig',array(
            'form'          => $form->createView(),
        ));
    }

    public function contactAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->get('form.factory')->create(ContactType::class,$contact);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('front_office_index');
        }

        return $this->render('FrontOffice/contact.html.twig', array(
            'form'          => $form->createView()
        ));

    }

    public function recipeJsonAction()
    {
        $request = $this->get('request');
        if ($request->isXmlHttpRequest())
        {
            $term = $request->request->get('motcle');
            echo $term;
            $em = $this->getDoctrine()->getManager();
            $array = $em->getRepository('AppBundle:CookingRecipe')->getRecipeResultSearch($term);

            $response = new Response(json_encode($array));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }

}
