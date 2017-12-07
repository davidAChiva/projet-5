<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\PartOfMenu;
use AppBundle\Form\PartOfMenuType;

class ManagePartOfMenuController extends Controller

{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partsOfMenu = $em->getRepository('AppBundle:PartOfMenu')->findAll();

        return $this->render('ManagePartOfMenu/index.html.twig', array(
            'partsOfMenu'       => $partsOfMenu
        ));
    }

    public function addAction(Request $request)
    {
        $partOfMenu = new PartOfMenu();

        $form = $this->get('form.factory')->create(PartOfMenuType::class,$partOfMenu);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partOfMenu);
            $em->flush();

            return $this->redirectToRoute('manage_part_of_menu_index');
        }

        return $this->render('ManagePartOfMenu/add.html.twig', array(
            'form'            => $form->createView()
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $partOfMenu = $em->getRepository('AppBundle:PartOfMenu')->find($id);

        if (null === $partOfMenu)
        {
            throw new NotFoundHttpException("Ce type de menu n'existe pas.");
        }

        $form = $this->get('form.factory')->create(PartOfMenuType::class,$partOfMenu);

        $form->handleRequest($request);


        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirectToRoute('manage_part_of_menu_index');
            }
        }

        return $this->render('ManagePartOfMenu/edit.html.twig', array(
            'partOfMenu' => $partOfMenu,
            'form'   => $form->createView()
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $partOfMenu = $em->getRepository('AppBundle:PartOfMenu')->find($id);

        if (null === $partOfMenu)
        {
            throw new NotFoundHttpException('La spécialité de pays n\'existe pas !');
        }

        // Formulaire qui contient juste le champ crsf pour la sécurité
        $form = $this->get('form.factory')->create();

        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                // On récupére la spécialité ' autre type'
                $otherType = $em->getRepository('AppBundle:PartOfMenu')->find(7);

                // On récupére les recettes dont la spécialité correspond à celle qu'on va supprimer
                $recipes = $em->getRepository('AppBundle:CookingRecipe')->getRecipesOfTypeMenu($id);

                // On bascule toutes les recettes dont la spécialité va être supprimer pour les mettres dans spécialité 'autre pays'
                foreach ($recipes as $recipe)
                {
                    $recipe->setPartOfMenu($otherType);
                    $em->persist($recipe);
                }
                // Puis on supprime la spécialité
                $em->remove($partOfMenu);
                $em->flush();

                return $this->redirectToRoute('manage_part_of_menu_index');
            }
        }
        return $this->render('ManagePartOfMenu/delete.html.twig', array(
            'partOfMenu' => $partOfMenu,
            'form'   => $form->createView(),
        ));
    }
}