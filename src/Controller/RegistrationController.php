<?php

namespace App\Controller;

use App\Entity\Trainer;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="trainer_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $trainer = new Trainer();
        $form = $this->createForm(RegistrationFormType::class, $trainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the plain password before saving to the database
            $password = $passwordEncoder->encodePassword($trainer, $trainer->getPassword());
            $trainer->setPassword($password);

            // Save the trainer to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trainer);
            $entityManager->flush();

            // Redirect to a success page or wherever you want
            return $this->redirectToRoute('registration_success');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/registration/success", name="registration_success")
     */
    public function success(): Response
    {
        return $this->render('registration/success.html.twig');
    }

}