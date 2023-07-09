<?php

namespace App\Controller;

use App\Repository\RefPokemonTypeRepository;
use App\Repository\TrainerTypeRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController

{
    private RefPokemonTypeRepository $pokemonRepository;
    private TrainerTypeRepository $trainerRepository;

    public function __construct(RefPokemonTypeRepository $pokemonRepository, TrainerTypeRepository $trainerRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
        $this->trainerRepository = $trainerRepository;
    }
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

    /**
     * @Route("/market", name="market")
     */

    public function market(): Response
    {
        $user = $this->getUser();
        $Trainer = $this->trainerRepository->findById($user->getId());
        $pokemonToBuy= $this->pokemonRepository->findPokemonToBuy($Trainer);
        return $this->render('home/market.html.twig', [
            'pokemonToBuy' => $pokemonToBuy,
            'Trainer' => $Trainer
        ]);
    }

    /**
     * @Route("/buy", name="buy", methods={"POST"})
     */

    public function buy(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        $user = $this->getUser();
        $Trainer = $this->trainerRepository->findById($user->getId());
        $Pokemon = $this->pokemonRepository->findById($request->get('id'));
        $Price = $Pokemon->getSellPrice();
        $Trainer->setPokedolls($Trainer->getPokedolls() - $Price);
        $Pokemon->setTrainer($Trainer);
        $Pokemon->setSellPrice(0);
        $this->trainerRepository->persist($Trainer);
        $this->pokemonRepository->persist($Pokemon);
        return $this->redirectToRoute('market');
    }

}
