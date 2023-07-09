<?php

namespace App\Controller;

use App\Entity\RefPokemonType;
use App\Form\PokemonType;
use App\Form\RefPokemonTypeType;
use App\Repository\RefPokemonTypeRepository;
use App\Repository\TrainerTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ref/pokemon/type")
 */
class RefPokemonTypeController extends AbstractController
{
    private RefPokemonTypeRepository $pokemonRepository;

    private TrainerTypeRepository $trainerRepository;
    public function __construct(RefPokemonTypeRepository $pokemonRepository, TrainerTypeRepository $trainerRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
        $this->trainerRepository = $trainerRepository;
    }
    /**
     * @Route("/", name="app_ref_pokemon_type_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $refPokemonTypes = $entityManager
            ->getRepository(RefPokemonType::class)
            ->findAll();

        return $this->render('ref_pokemon_type/index.html.twig', [
            'ref_pokemon_types' => $refPokemonTypes,
        ]);
    }

    /**
     * @Route("/new", name="app_ref_pokemon_type_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $refPokemonType = new RefPokemonType();
        $form = $this->createForm(RefPokemonTypeType::class, $refPokemonType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($refPokemonType);
            $entityManager->flush();

            return $this->redirectToRoute('app_ref_pokemon_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ref_pokemon_type/new.html.twig', [
            'ref_pokemon_type' => $refPokemonType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ref_pokemon_type_show", methods={"GET"})
     */
    public function show(RefPokemonType $refPokemonType): Response
    {
        return $this->render('ref_pokemon_type/show.html.twig', [
            'ref_pokemon_type' => $refPokemonType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ref_pokemon_type_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, RefPokemonType $refPokemonType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RefPokemonTypeType::class, $refPokemonType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ref_pokemon_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ref_pokemon_type/edit.html.twig', [
            'ref_pokemon_type' => $refPokemonType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ref_pokemon_type_delete", methods={"POST"})
     */
    public function delete(Request $request, RefPokemonType $refPokemonType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$refPokemonType->getId(), $request->request->get('_token'))) {
            $entityManager->remove($refPokemonType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ref_pokemon_type_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/registration/first_login", name="first_login")
     */
    public function success(Request $request,EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PokemonType::class);

        // Handle form submission, validation, etc.

        $pokemons = $this->pokemonRepository->findAllStarters();

        return $this->render('ref_pokemon_type/chooseStarter.html.twig', [
            'form' => $form->createView(),
            'pokemons' => $pokemons,
        ]);
    }

    /**
     * @Route("/toto/{pokemon.id}", name="toto", methods={"POST"})
     */
    public function addPokemon(Request $request): Response

    {
        $user = $this->getUser();
        $Trainer = $this->trainerRepository->findById($user->getId());
        $Trainer->setFirstLogged(false);
        $this->trainerRepository->persist($Trainer);

        $pokemonId = $request->request->get('pokemon_id');

        $pokemon = $this->pokemonRepository->findById($pokemonId);
        $pokemon->setTrainer($Trainer);
        $this->pokemonRepository->persist($pokemon);







        return $this->redirectToRoute('app_home');
    }
}
