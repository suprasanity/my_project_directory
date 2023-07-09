<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
        $Trainer = $this->getUser();

        if ($Trainer == null) {
            return $this->redirectToRoute('app_login');
        }

        if ( $Trainer->isFirstLogged()) {
            return $this->redirectToRoute('first_login');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'first' => $Trainer->isFirstLogged()
        ]);
    }
}
