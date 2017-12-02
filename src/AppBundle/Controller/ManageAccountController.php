<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

class ManageAccountController extends Controller

{

    public function userAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('ManageAccount/user.html.twig', array(
            'users'       => $users
        ));
    }

    public function userModifyRoleAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->getUsers();

        // Formulaire qui contient juste le champ crsf pour la sécurité
        $form = $this->get('form.factory')->create();

        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $role = array('ROLE_ADMIN');
                $user->setRoles($role);
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('manage_account_user');
            }
        }
        return $this->render('ManageAccount/userModifyRole.html.twig', array(
            'user'   => $user,
            'form'   => $form->createView()
        ));

    }
    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $admins = $em->getRepository('AppBundle:User')->getAdmins();

        return $this->render('ManageAccount/admin.html.twig', array(
            'admins'       => $admins
        ));
    }

    public function adminModifyRoleAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('AppBundle:User')->find($id);

        // Formulaire qui contient juste le champ crsf pour la sécurité
        $form = $this->get('form.factory')->create();

        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $role = 'ROLE_ADMIN';
                $admin->removeRole($role);
                $em->persist($admin);
                $em->flush();

                return $this->redirectToRoute('manage_account_admin');
            }
        }
        return $this->render('ManageAccount/adminModifyRole.html.twig', array(
            'admin'   => $admin,
            'form'   => $form->createView()
        ));
    }

    public function userDeleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        if (null === $user)
        {
            throw new NotFoundHttpException('L\'utilisateur n\'existe pas !');
        }

        // Formulaire qui contient juste le champ crsf pour la sécurité
        $form = $this->get('form.factory')->create();

        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $em->remove($user);
                $em->flush();

                return $this->redirectToRoute('manage_account_user');
            }
        }
        return $this->render('ManageAccount/deleteUser.html.twig', array(
            'user' => $user,
            'form'   => $form->createView(),
        ));
    }

    public function deleteAdminAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('AppBundle:User')->find($id);

        if (null === $admin)
        {
            throw new NotFoundHttpException('L\'administrateur n\'existe pas !');
        }

        // Formulaire qui contient juste le champ crsf pour la sécurité
        $form = $this->get('form.factory')->create();

        $form->handleRequest($request);

        if ($request->isMethod('POST'))
        {
            if ($form->isValid() && $form->isSubmitted())
            {
                $em->remove($admin);
                $em->flush();

                return $this->redirectToRoute('manage_account_admin');
            }
        }
        return $this->render('ManageAccount/deleteAdmin.html.twig', array(
            'admin' => $admin,
            'form'   => $form->createView(),
        ));
    }

}