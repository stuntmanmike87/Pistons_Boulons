<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[Route(path: '/user/control')]
final class UserControlController extends AbstractController
{
    public function __construct(private readonly ManagerRegistry $em, private readonly UserPasswordHasherInterface $encoder)
    {
    }

    /**
     * Fonction qui permet l'affichage de la page index de UserControl
     *
     *  Cette page nous montre le listing des users
     *
     * return user_control/index.html.twig 
     */
    #[Route(path: '/', name: 'user_control_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user_control/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * Cette page nous permet de créer un nouvel utilisateur
     * 
     * return user_control/new.html.twig 
     */
    #[Route(path: '/new', name: 'user_control_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var PasswordAuthenticatedUserInterface $user */
            $pw = $this->encoder->hashPassword($user, (string)$user->getPassword());
            /** @var User $user */
            $user->setPassword($pw);
            $entityManager = $this->em->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', "L'utilisateur a bien été ajoutée");
            return $this->redirectToRoute('user_control_index');
        }

        return $this->render('user_control/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page show de UserControl
     *
     * Cette page nous permet de voir un utilisateur et ses informations
     *
     * return user_control/show.html.twig 
     */
    #[Route(path: '/{id}', name: 'user_control_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user_control/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page edit de UserControl
     *
     * Cette page nous permet de modifier les informations d'un utilisateur
     *
     * return user_control/edit.html.twig 
     */
    #[Route(path: '/{id}/edit', name: 'user_control_edit', methods: ['GET', 'POST'])] 
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var PasswordAuthenticatedUserInterface $user */
            $pw = $this->encoder->hashPassword($user, (string)$user->getPassword());
            /** @var User $user */
            $user->setPassword($pw);
            $this->em->getManager()->flush();

            return $this->redirectToRoute('user_control_index');
        }

        return $this->render('user_control/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * Fonction qui permet de supprimer un utilisateur
     *
     * return user_control/user_control_index
     */
    #[Route(path: '/{id}', name: 'user_control_delete', methods: ['POST'])]
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), (string)$request->request->get('_token'))) {
            $entityManager = $this->em->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_control_index');
    }
}
