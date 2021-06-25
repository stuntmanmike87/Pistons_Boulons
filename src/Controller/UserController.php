<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/myaccount", name="app_myaccount")
     */
    public function myAccount()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('error404');
        } else {
            $user = $this->getUser();
            $motDePasse = $user->getPassword();

            return $this->render('security/my_account.html.twig', ['motDePasse' => $motDePasse]);
        }
    }


     /**
     * @Route("/changePassword", name="app_change_password")
     */
    public function changePassword()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('error404');
        } else {
            $user = $this->getUser();
            $ancienMotDePasse = $user->getPassword();
            
            
        }
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
