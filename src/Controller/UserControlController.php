<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user/control")
 */
class UserControlController extends AbstractController
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * @Route("/", name="user_control_index", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page index de UserControl
     * 
     *  Cette page nous montre le listing des users
     * 
     * @param UserRepository $userRepository
     * 
     * @return user_control/index.html.twig 
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user_control/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }



    /**
     * @Route("/new", name="user_control_new", methods={"GET","POST"})
     * Fonction qui permet l'affichage de la page new de UserControl
     * 
     *  Cette page nous permet de créer un nouvel utilisateur
     * 
     * @param Request $request
     * 
     * @return user_control/new.html.twig 
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', "L'utilisateur a bien été ajoutée");
            return $this->redirectToRoute('user_control_index');
        }

        return $this->render('user_control/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_control_show", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page show de UserControl
     * 
     *  Cette page nous permet de voir un utilisateur et ses informations
     * 
     * @param User $user
     * 
     * @return user_control/show.html.twig 
     */
    public function show(User $user): Response
    {
        return $this->render('user_control/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_control_edit", methods={"GET","POST"})
     * 
     * Fonction qui permet l'affichage de la page edit de UserControl
     * 
     *  Cette page nous permet de modifier les informations d'un utilisateur
     * 
     * @param User $user
     * 
     * @param Request $request
     * 
     * @return user_control/edit.html.twig 
     */
     
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_control_index');
        }

        return $this->render('user_control/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_control_delete", methods={"POST"})
       * 
     * Fonction qui permet de supprimer un utilisateur
     * 
     * @param User $user
     * 
     * @param Request $request
     * 
     * @return user_control/user_control_index
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_control_index');
    }
}
