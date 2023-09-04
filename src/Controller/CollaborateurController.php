<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Entity\Collaborateur;
use App\Form\CollaborateurType;
use App\Repository\CollaborateurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/collaborateur')]
final class CollaborateurController extends AbstractController
{
    public function __construct(private readonly ManagerRegistry $em) {}
    
    #[Route(path: '/', name: 'collaborateur_index', methods: ['GET'])]
    public function index(CollaborateurRepository $collaborateurRepository): Response
    {
        return $this->render('collaborateur/index.html.twig', [
            'collaborateurs' => $collaborateurRepository->findByIsActif(),
        ]);
    }

     #[Route(path: '/lastConnexion', name: 'collaborateur_derniere_connexion', methods: ['GET'])]
    public function derniereConnexion(CollaborateurRepository $collaborateurRepository): Response
    {
        return $this->render('collaborateur/derniere_connexion.html.twig', [
            'collaborateurs' => $collaborateurRepository->findByDerniereConnexion(),
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page new de collaborateur
     *
     * Cette page nous montre le formulaire d'ajout de collaborateur
     *
     * param Request $request qui est la requete d'ajout du collaborateur
     *
     * Si l'ajout est validé :
     * return collaborateur_index qui est la page avec la liste des collaborateurs et donc aussi du collaborateur qui a été ajouté.
     * Si l'ajout n'est pas validé :
     * return collaborateur/new.html.twig avec l'erreur affiché dans le champ en question
     */
    #[Route(path: '/new', name: 'collaborateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $collaborateur = new Collaborateur();
        $form = $this->createForm(CollaborateurType::class, $collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
  
            $entityManager = $this->em->getManager();
          
            $collaborateur->setIsActif(true);
            $entityManager->persist($collaborateur);
            $entityManager->flush();

            ///** @var \Symfony\Component\Form\FormInterface $form *////** @var string $login */
            $login = $form['user']->getData();//Cannot call method getData() on Symfony\Component\Form\FormInterface|null.

            if($login != null){
                /** @var User $user */
                $user = $collaborateur->getUser();
                $user->setCollaborateur($collaborateur);
                /** @var object $user */
                $entityManager->persist($user);
                $entityManager->flush();
            }
            
            
            $this->addFlash('success', 'Le collaborateur a bien été ajouté');

            return $this->redirectToRoute('collaborateur_index');
        }

        return $this->render('collaborateur/new.html.twig', [
            'collaborateur' => $collaborateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page show de collaborateur
     *
     * Cette page nous montre les données d'un collaborateur choisi dans la liste des collaborateurs de la page index de collaborateur
     *
     * param Collaborateur $collaborateur cette variable permet de savoir quel collaborateur nous avons choisi
     * return collaborateur/show.html.twig qui est la page qui affiche les données du collaborateur choisi
     */
    #[Route(path: '/{id}', name: 'collaborateur_show', methods: ['GET'])]
    public function show(Collaborateur $collaborateur): Response
    {
        return $this->render('collaborateur/show.html.twig', [
            'collaborateur' => $collaborateur,
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page edit de collaborateur
     *
     * Cette page nous montre le formulaire d'un collaborateur choisi dans la liste des collaborateurs de index collaborateur
     *
     * param Request $request qui permet de faire la requete de la modification
     *
     * param Collaborateur $collaborateur qui permet de savoir le collaborateur choisi
     *
     * si la modification est validée :
     * return collaborateur_index qui est donc la liste des collaborateurs avec le collaborateur qui a bien été modifié
     * si la modification n'est pas validée :
     * return collaborateur/edit.html.twig avec l'erreur dans le champ en question
     */
    #[Route(path: '/{id}/edit', name: 'collaborateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Collaborateur $collaborateur): Response
    {
        $form = $this->createForm(CollaborateurType::class, $collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->em->getManager();

            ///** @var \Symfony\Component\Form\FormInterface $form *////** @var string $login */
            $login = $form['user']->getData();//Cannot call method getData() on Symfony\Component\Form\FormInterface|null.

            if($login != null){
                /** @var User $user */
                $user = $collaborateur->getUser();
                $user->setCollaborateur($collaborateur);
                /** @var object $user */
                $entityManager->persist($user);
                $entityManager->flush();
            }

            $this->em->getManager()->flush();

            $this->addFlash('success', 'Le collaborateur a bien été modifié');

            return $this->redirectToRoute('collaborateur_index');
        }

        return $this->render('collaborateur/edit.html.twig', [
            'collaborateur' => $collaborateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Fonction qui permet le delete de collaborateur
     *
     * Cette fonction est aussi sur la page edit avec le bouton supprimer 
     *
     * param Request $request qui permet de faire la requete de la suppression
     *
     * param Collaborateur $collaborateur cette variable permet de savoir quel collaborateur nous avons choisi
     * return collaborateur_index avec la liste des collaborateurs sans le collaborateur qui a été supprimé
     */
    #[Route(path: '/{id}', name: 'collaborateur_delete', methods: ['POST'])]
    public function delete(Request $request, Collaborateur $collaborateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collaborateur->getId(), (string)$request->request->get('_token'))) {
            $entityManager = $this->em->getManager();
            $collaborateur->setIsActif(false);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Le collaborateur a bien été effacé');

        return $this->redirectToRoute('collaborateur_index');
    }
}
