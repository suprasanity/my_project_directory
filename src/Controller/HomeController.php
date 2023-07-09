<?php

namespace App\Controller;

use App\Repository\RefPokemonTypeRepository;
use App\Repository\TrainerTypeRepository;
use App\Repository\ZoneRepository;
use http\Env\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController

{
    private RefPokemonTypeRepository $pokemonRepository;
    private TrainerTypeRepository $trainerRepository;

    private ZoneRepository $zoneRepository;

    public function __construct(RefPokemonTypeRepository $pokemonRepository, TrainerTypeRepository $trainerRepository, ZoneRepository $zoneRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
        $this->trainerRepository = $trainerRepository;
        $this->zoneRepository = $zoneRepository;
    }
    /**
     * @Route("/home", name="app_home")
     * @IsGranted("ROLE_USER")
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
     * @IsGranted("ROLE_USER")
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
     * @IsGranted("ROLE_USER")
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

    /**
     * @Route("/sortir", name="sortir")
     * @IsGranted("ROLE_USER")
     */
    public function sortir(): Response{
        return $this ->render('home/sortir.html.twig');
    }

    /**
     * @Route("/capture", name="capture")
     * @IsGranted("ROLE_USER")
     */

    public function capture(\Symfony\Component\HttpFoundation\Request $request): Response{
        $zone =$request->get('card_title');
        $type=   $this->zoneRepository->findTypeZone($zone);

        //get the pokemon that has a type in $type
        $pokemon = $this->pokemonRepository->findPokemonByType($type);
        //pick random pokemon in the array
        $pokemon = $pokemon[rand(0, count($pokemon) - 1)];

        $pokemonReal = $this->pokemonRepository->findById($pokemon);
        $pokemonClone = new \App\Entity\RefPokemonType($pokemonReal);
        $Trainer = $this->trainerRepository->findById($this->getUser()->getId());
        $pokemonClone->setTrainer($Trainer);
        $this->pokemonRepository->persist($pokemonClone);



        return $this ->render('home/capture.html.twig', [
            'pokemon' => $pokemonClone,
        ]);
    }


}
