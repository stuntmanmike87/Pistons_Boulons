<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Repository\CollaborateurRepository;
use App\Repository\UserRepository;
use DateTime;

class UserController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * Fonction d'afficher la page de connexion
     * 
     * @param AuthenticationUtils $authenticationUtils
     * @param UserRepository $repoUser
     * @param CollaborateurRepository $repoCollabo
     * 
     * @return security/login.html.twig
     */
    public function login(AuthenticationUtils $authenticationUtils, CollaborateurRepository $repoCollabo,UserRepository $repoUser): Response
    {
        if ($this->getUser()) {
              //on géneère la date du jour en mode date time pour modifier le champ derniere connexion du collabo
            $today = new DateTime();  
      
          //On pointe sur le login de l'utilisateur
          $user_login= $this->getUser()->getLogin();
          //on récupère le collaborateur en fonction de son nom d'utilisateur
          $collab = $repoCollabo->findOneBy([
              'user' => $repoUser->findOneBy([
                  'login'=>$user_login,
              ]),
          ]);
          //on met a jour le chp derniereConnexion  de collabo
          $entityManager = $this->getDoctrine()->getManager();
          $collab->setDateHeureDerniereConnexion($today);
          $entityManager->flush();
        
          return $this->redirectToRoute('home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
            
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     * 
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
