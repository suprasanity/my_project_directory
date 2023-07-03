<?php

namespace App\Controller;

use App\Entity\RefElementaryType;
use App\Form\RefElementaryTypeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ref/elementary/type")
 */
class RefElementaryTypeController extends AbstractController
{
    /**
     * @Route("/", name="app_ref_elementary_type_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $refElementaryTypes = $entityManager
            ->getRepository(RefElementaryType::class)
            ->findAll();

        return $this->render('ref_elementary_type/index.html.twig', [
            'ref_elementary_types' => $refElementaryTypes,
        ]);
    }

    /**
     * @Route("/new", name="app_ref_elementary_type_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $refElementaryType = new RefElementaryType();
        $form = $this->createForm(RefElementaryTypeType::class, $refElementaryType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($refElementaryType);
            $entityManager->flush();

            return $this->redirectToRoute('app_ref_elementary_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ref_elementary_type/new.html.twig', [
            'ref_elementary_type' => $refElementaryType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ref_elementary_type_show", methods={"GET"})
     */
    public function show(RefElementaryType $refElementaryType): Response
    {
        return $this->render('ref_elementary_type/show.html.twig', [
            'ref_elementary_type' => $refElementaryType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ref_elementary_type_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, RefElementaryType $refElementaryType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RefElementaryTypeType::class, $refElementaryType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ref_elementary_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ref_elementary_type/edit.html.twig', [
            'ref_elementary_type' => $refElementaryType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ref_elementary_type_delete", methods={"POST"})
     */
    public function delete(Request $request, RefElementaryType $refElementaryType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$refElementaryType->getId(), $request->request->get('_token'))) {
            $entityManager->remove($refElementaryType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ref_elementary_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
