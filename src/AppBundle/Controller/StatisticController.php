<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class StatisticController extends Controller

{
    public function popularityRecipeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recipes = $em->getRepository('AppBundle:CookingRecipe')->getAllRecipeMostPopular();

        return $this->render('Statistic/popularityRecipe.html.twig', array(
            'recipes'       => $recipes
        ));
    }

    public function visitorsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $visits = $em->getRepository('AppBundle:Statistic')->findAll();

        return $this->render('Statistic/visitors.html.twig', array(
            'visits'       => $visits
        ));
    }
}