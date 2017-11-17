<?php

namespace AppBundle\Controller;

use AppBundle\Form\SpecialtyCountryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\SpecialtyCountry;

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

    public function addAction(Request $request)
    {
        $specialtyCountry = new SpecialtyCountry();

        $form = $this->get('form.factory')->create(SpecialtyCountryType::class,$specialtyCountry);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($specialtyCountry);
            $em->flush();

            return $this->redirectToRoute('manage_specialty_country_index');
        }

        return $this->render('ManageSpecialtyCountry/add.html.twig', array(
            'specialtyCountry'      => $specialtyCountry,
            'form'                  => $form->createView()
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $specialtyCountry = $em->getRepository('AppBundle:SpecialtyCountry')->find($id);

        if (null === $specialtyCountry)
        {
            throw new NotFoundHttpException("La spécialité n'existe pas.");
        }

        $form = $this->get('form.factory')->create(SpecialtyCountryType::class,$specialtyCountry);

        $form->handleRequest($request);


        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirectToRoute('manage_specialty_country_index');
            }
        }

        return $this->render('ManageSpecialtyCountry/edit.html.twig', array(
            'specialtyCountry' => $specialtyCountry,
            'form'   => $form->createView()
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $specialtyCountry = $em->getRepository('AppBundle:SpecialtyCountry')->find($id);

        if (null === $specialtyCountry)
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
                $em->remove($specialtyCountry);
                $em->flush();

                return $this->redirectToRoute('manage_specialty_country_index');
            }
        }
        return $this->render('ManageSpecialtyCountry/delete.html.twig', array(
            'specialtyCountry' => $specialtyCountry,
            'form'   => $form->createView(),
        ));
    }
}