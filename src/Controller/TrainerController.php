<?php

namespace App\Controller;

use App\Entity\Trainer;
use App\Form\TrainerType;
use App\Repository\RefPokemonTypeRepository;
use App\Repository\TrainerTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/trainer")
 */
class TrainerController extends AbstractController
{
    private TrainerTypeRepository $trainerRepository;

    private RefPokemonTypeRepository $pokemonRepository;

    public function __construct(RefPokemonTypeRepository $pokemonRepository, TrainerTypeRepository $trainerRepository)
    {
        $this->pokemonRepository = $pokemonRepository;
        $this->trainerRepository = $trainerRepository;
    }
    /**
     * @Route("/", name="app_trainer_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $trainers = $entityManager
            ->getRepository(Trainer::class)
            ->findAll();

        return $this->render('trainer/index.html.twig', [
            'trainers' => $trainers,
        ]);
    }

    /**
     * @Route("/new", name="app_trainer_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trainer = new Trainer();
        $form = $this->createForm(TrainerType::class, $trainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trainer);
            $entityManager->flush();

            return $this->redirectToRoute('app_trainer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trainer/new.html.twig', [
            'trainer' => $trainer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_trainer_show", methods={"GET"})
     */
    public function show(Trainer $trainer): Response
    {
        return $this->render('trainer/show.html.twig', [
            'trainer' => $trainer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_trainer_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Trainer $trainer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrainerType::class, $trainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_trainer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trainer/edit.html.twig', [
            'trainer' => $trainer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_trainer_delete", methods={"POST"})
     */
    public function delete(Request $request, Trainer $trainer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trainer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trainer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_trainer_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/myPokemon", name="myPokemon", methods={"GET"})
     */
    public function myPokemon(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $Trainer = $this->trainerRepository->findById($user->getId());



        return $this->render('trainer/myPokemon.html.twig', [
            'trainersPokemon' => $this->pokemonRepository->findByTrainer($Trainer),
        ]);
    }


}
