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
}