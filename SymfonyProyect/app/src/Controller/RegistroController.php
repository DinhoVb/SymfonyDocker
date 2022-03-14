<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'registro_index', methods: ['GET'])]
    public function index(): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('registro_new'),
            'method' => 'POST'
        ]);
        return $this->render('registro/index.html.twig', [
            'formulario' => $form->createView(),
        ]);
    }

    #[Route('/registro/nuevo', name: 'registro_new', methods: ['POST'])]
    public function new(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher){
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em= $doctrine->getManager();
            $user->setPassword($passwordHasher->hashPassword(
                $user,
                $form['password']->getData()
            ));
            $em->persist($user);
            $em->flush();
            $this->addFlash('exito', 'El usuario se a registrado correctamente');
            return $this->redirectToRoute('app_login');
        }

        /* $error_username = $form['username']->getErrors();
        $errors_email = $form['email']->getErrors();

        
        if (is_null($error_username)) {
            $error_username = '';
        } else {
            $this->addFlash('error_username', $error_username);
        }

        if (is_null($errors_email)) {
            $errors_email = '';
        }else{
            if (is_null($errors_email) == false) {
                $this->addFlash('error_email', $errors_email);
            }
        }
         */

        return $this->render('registro/index.html.twig', [
            'formulario' => $form->createView(),
        ]);
        
    }
}
