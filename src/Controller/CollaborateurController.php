<?php

namespace App\Controller;

use App\Entity\Collaborateur;
use App\Entity\User;
use App\Form\CollaborateurType;
use App\Repository\CollaborateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/collaborateur")
 */
class CollaborateurController extends AbstractController
{
    /**
     * @Route("/", name="collaborateur_index", methods={"GET"})
     */
    public function index(CollaborateurRepository $collaborateurRepository): Response
    {
        return $this->render('collaborateur/index.html.twig', [
            'collaborateurs' => $collaborateurRepository->findByIsActif(),
        ]);
    }

     /**
     * @Route("/lastConnexion", name="collaborateur_derniere_connexion", methods={"GET"})
     */
    public function derniereConnexion(CollaborateurRepository $collaborateurRepository): Response
    {
        return $this->render('collaborateur/derniere_connexion.html.twig', [
            'collaborateurs' => $collaborateurRepository->findByDerniereConnexion(),
        ]);
    }

    /**
     * @Route("/new", name="collaborateur_new", methods={"GET","POST"})
     * 
     * Fonction qui permet l'affichage de la page new de collaborateur
     * 
     * Cette page nous montre le formulaire d'ajout de collaborateur
     * 
     * @param Request $request qui est la requete d'ajout du collaborateur
     * 
     * Si l'ajout est validé :
     * @return collaborateur_index qui est la page avec la liste des collaborateurs et donc aussi du collaborateur qui a été ajouté.
     * 
     * Si l'ajout n'est pas validé :
     * @return collaborateur/new.html.twig avec l'erreur affiché dans le champ en question
     */
    public function new(Request $request): Response
    {
        $u = new User();
        $collaborateur = new Collaborateur();
        $form = $this->createForm(CollaborateurType::class, $collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form['user']->getData();
            
            $entityManager = $this->getDoctrine()->getManager();

            if($user!=null){
                $u->setCollaborateur($collaborateur);
                $entityManager->persist($u);
            }

            $collaborateur->setIsActif(true);
            $entityManager->persist($collaborateur);
            $entityManager->flush();

            $this->addFlash('success', 'Le collaborateur a bien été ajouté');

            return $this->redirectToRoute('collaborateur_index');
        }

        return $this->render('collaborateur/new.html.twig', [
            'collaborateur' => $collaborateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="collaborateur_show", methods={"GET"})
    * 
     * Fonction qui permet l'affichage de la page show de collaborateur
     * 
     * Cette page nous montre les données d'un collaborateur choisi dans la liste des collaborateurs de la page index de collaborateur
     * 
     * @param Collaborateur $collaborateur cette variable permet de savoir quel collaborateur nous avons choisi
     * 
     * @return collaborateur/show.html.twig qui est la page qui affiche les données du collaborateur choisi
     */
    public function show(Collaborateur $collaborateur): Response
    {
        return $this->render('collaborateur/show.html.twig', [
            'collaborateur' => $collaborateur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="collaborateur_edit", methods={"GET","POST"})
     * 
     * Fonction qui permet l'affichage de la page edit de collaborateur
     * 
     * Cette page nous montre le formulaire d'un collaborateur choisi dans la liste des collaborateurs de index collaborateur
     * 
     * @param Request $request qui permet de faire la requete de la modification
     * 
     * @param Collaborateur $collaborateur qui permet de savoir le collaborateur choisi
     * 
     * si la modification est validée :
     * @return collaborateur_index qui est donc la liste des collaborateurs avec le collaborateur qui a bien été modifié
     * 
     * si la modification n'est pas validée :
     * @return collaborateur/edit.html.twig avec l'erreur dans le champ en question
     */
    public function edit(Request $request, Collaborateur $collaborateur): Response
    {
        $form = $this->createForm(CollaborateurType::class, $collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $u = new User();

            $user = $form['user']->getData();

            $entityManager = $this->getDoctrine()->getManager();

            if($user!=null){
                $u->setCollaborateur($collaborateur);
                $entityManager->persist($u);
            }

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le collaborateur a bien été modifié');

            return $this->redirectToRoute('collaborateur_index');
        }

        return $this->render('collaborateur/edit.html.twig', [
            'collaborateur' => $collaborateur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="collaborateur_delete", methods={"POST"})
     * 
     * Fonction qui permet le delete de collaborateur
     * 
     * Cette fonction est aussi sur la page edit avec le bouton supprimer 
     * 
     * @param Request $request qui permet de faire la requete de la suppression
     * 
     * @param Collaborateur $collaborateur cette variable permet de savoir quel collaborateur nous avons choisi
     * 
     * @return collaborateur_index avec la liste des collaborateurs sans le collaborateur qui a été supprimé
     */
    public function delete(Request $request, Collaborateur $collaborateur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collaborateur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $collaborateur->setIsActif(false);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Le collaborateur a bien été effacé');

        return $this->redirectToRoute('collaborateur_index');
    }
}
