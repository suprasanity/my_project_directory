<?php

namespace App\Controller;

use App\Entity\Trainer;
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
        if ($Trainer->isFirstLogged()) {
            return $this->redirectToRoute('registration_success2'); // Replace "other_route" with the name of your desired route
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'first' => $Trainer->isFirstLogged()
        ]);
    }
}
