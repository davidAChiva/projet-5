<?php

namespace AppBundle\Controller;




use AppBundle\Entity\Statistic;
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
use AppBundle\Entity\IngredientCategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class FrontOfficeController extends Controller

{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ingredientCategories = $em->getRepository('AppBundle:IngredientCategory')->getAllIngredientCategory();
        $recipesMostPopular = $em->getRepository('AppBundle:CookingRecipe')->getRecipeMostPopular(9);
        $partsOfMenu = $em->getRepository('AppBundle:PartOfMenu')->getAllPartOfMenu();
        $specialtiesCountries = $em->getRepository('AppBundle:SpecialtyCountry')->getAllSpecialtyCountry();
        $recipesMostNote = $em->getRepository('AppBundle:CookingRecipe')->getRecipeMostAverageNotes();

        return $this->render('FrontOffice/index.html.twig', array(
            'ingredientCategories'      => $ingredientCategories,
            'partsOfMenu'               => $partsOfMenu,
            'specialtiesCountries'      => $specialtiesCountries,
            'recipesMostPopular'        => $recipesMostPopular,
            'recipesMostNote'           => $recipesMostNote
        ));
    }

    public function categoryIngredientAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $ingredients = $em->getRepository('AppBundle:Ingredient')->getIngredientsOfCategory($id);

        $category = $em->getRepository('AppBundle:IngredientCategory')->find($id);

        if (null === $category)
        {
            throw new NotFoundHttpException("La catégorie n\'existe pas !");
        }

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
        if (null === $ingredient)
        {
            throw new NotFoundHttpException("L'ingrédient n\'existe pas !");
        }

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

        if (null === $partOfMenu)
        {
            throw new NotFoundHttpException("Le type de menu n\'existe pas !");
        }

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
        if (null === $specialtyCountry)
        {
            throw new NotFoundHttpException("La spécialité n\'existe pas !");
        }

        $recipes = $em->getRepository('AppBundle:CookingRecipe')->getRecipesOfCountry($id);

        return $this->render('FrontOffice/countrySpecialty.html.twig', array(
                'specialtyCountry' => $specialtyCountry,
                'recipes'          => $recipes
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Security("has_role('ROLE_USER')")
     */
    public function addRecipeAction(Request $request)
    {
        $cookingRecipe = new CookingRecipe();

        $form = $this->get('form.factory')->create(CookingRecipeType::class,$cookingRecipe);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $cookingRecipe->setUser($user);
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
        if (null === $cookingRecipe)
        {
            throw new NotFoundHttpException("La recette n\'existe pas !");
        }
        $ip = $request->getClientIp();

        $visit = $em->getRepository('AppBundle:Statistic')->getVisitRecipe($id,$ip);
        if (count($visit) !== 1) {
            $statistic = new Statistic();
            $statistic->setIpVisitor($ip);
            $statistic->setCookingRecipe($cookingRecipe);
            $em->persist($statistic);
            $em->flush();
        }

        $comments = $em->getRepository('AppBundle:CommentRecipe')->getCommentsOfRecipe($id);

        $commentRecipe = new CommentRecipe();
        $form = $this->get('form.factory')->create(CommentRecipeType::class,$commentRecipe);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $user = $this->getUser();
            $commentRecipe->setUser($user);
            $commentRecipe->setCookingRecipe($cookingRecipe);
            $em->persist($commentRecipe);
            $em->flush();

            $average = $em->getRepository('AppBundle:CommentRecipe')->calculAverage($id);
            $averageRecipe = $average[0];
            $averageRecipe = $averageRecipe['average'];
            $cookingRecipe->setAverageNotes($averageRecipe);
            $em->persist($cookingRecipe);
            $em->flush();


            return $this->redirectToRoute('front_office_index');
        }
        return $this->render('FrontOffice/recipe.html.twig',array (
            'cookingRecipe' => $cookingRecipe,
            'comments'      => $comments,
            'form'          => $form->createView(),
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

    public function recipeJsonAction(Request $request)
    {
            $term = $request->get('term');
            $em = $this->getDoctrine()->getManager();
            $recipes = $em->getRepository('AppBundle:CookingRecipe')->getResultJsonRecipe($term);

            $response = new Response(json_encode($recipes));

            return $response;
    }

    public function searchRecipeAction (Request $request)
    {
        $recipeName = $request->get('recipeName');
        $em = $this->getDoctrine()->getManager();
        $recipes = $em->getRepository('AppBundle:CookingRecipe')->getResultSearch($recipeName);

        return $this->render('FrontOffice/resultSearch.html.twig', array(
            'recipes'          => $recipes
        ));

    }

}
