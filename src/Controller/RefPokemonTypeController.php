<?php

namespace App\Controller;

use App\Entity\RefPokemonType;
use App\Form\RefPokemonTypeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ref/pokemon/type")
 */
class RefPokemonTypeController extends AbstractController
{
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
     * @Route("/registration/success2", name="registration_success2")
     */
    public function success(EntityManagerInterface $entityManager): Response
    {
        $refPokemonTypes = $entityManager
            ->getRepository(RefPokemonType::class)
            ->findAll();

        return $this->render('ref_pokemon_type/chooseStarter.html.twig', [
            'ref_pokemon_types' => $refPokemonTypes,
        ]);
    }
}
