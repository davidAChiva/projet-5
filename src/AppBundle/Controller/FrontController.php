<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('front/layout.html.twig');
    }
}
