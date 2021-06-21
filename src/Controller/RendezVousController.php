<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Repository\RendezVousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rendez/vous")
 */
class RendezVousController extends AbstractController
{
    /**
     * @Route("/", name="rendez_vous_index", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page index de rendez-vous
     * 
     * Cette page nous montre le listing rendez-vous
     * 
     * @param RendezVousRepository $rendezVousRepository
     * 
     * @return rendez_vous/index.html.twig avec les données des rendez-vous dans la base de données
     */
    public function index(RendezVousRepository $rendezVousRepository): Response
    {
        return $this->render('rendez_vous/index.html.twig', [
            'rendez_vouses' => $rendezVousRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rendez_vous_new", methods={"GET","POST"})
     * 
     * Fonction qui permet l'affichage de la page new de rendez-vous
     * 
     * Cette page nous montre le formulaire d'ajout de rendez-vous
     * 
     * @param Request $request qui est la requete d'ajout du rendez-vous
     * 
     * Si l'ajout est validé :
     * @return rendez_vous_index qui est la page avec la liste des rendez-vous et donc aussi du rendez-vous qui a été ajouté.
     * 
     * Si l'ajout n'est pas validé :
     * @return rendez_vous/new.html.twig avec l'erreur affiché dans le champ en question
     */
    public function new(Request $request): Response
    {
        $rendezVou = new RendezVous();
        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rendezVou);
            $entityManager->flush();
            $this->addFlash('success', "Le rendez-vous a bien été ajoutée");
            return $this->redirectToRoute('rendez_vous_index');
        }

        return $this->render('rendez_vous/new.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rendez_vous_show", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page show de rendez-vous
     * 
     * Cette page nous montre les données d'un rendez-vous choisi dans la liste des rendez-vous de la page index de rendez-vous
     * 
     * @param RendezVous $rendezVou cette variable permet de savoir quel rendez-vous nous avons choisi
     * 
     * @return rendez_vous/show.html.twig qui est la page qui affiche les données du rendez-vous choisi
     */
    public function show(RendezVous $rendezVou): Response
    {
        return $this->render('rendez_vous/show.html.twig', [
            'rendez_vou' => $rendezVou,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rendez_vous_edit", methods={"GET","POST"})
     * 
     * Fonction qui permet l'affichage de la page edit de rendez-vous
     * 
     * Cette page nous montre le formulaire d'un rendez-vous choisi dans la liste des rendez-vous de index rendez-vous
     * 
     * @param Request $request qui permet de faire la requete de la modification
     * 
     * @param RendezVous $rendezvou qui permet de savoir le rendez-vous choisi
     * 
     * si la modification est validée :
     * @return rendez_vous_index qui est donc la liste des clients avec le client qui a bien été modifié
     * 
     * si la modification n'est pas validée :
     * @return rendez_vous/edit.html.twig avec l'erreur dans le champ en question
     */
    public function edit(Request $request, RendezVous $rendezVou): Response
    {
        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "Le rendez-vous a bien été modifié");
            return $this->redirectToRoute('rendez_vous_index');
        }

        return $this->render('rendez_vous/edit.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rendez_vous_delete", methods={"POST"})
     * 
     * Fonction qui permet le delete de rendez-vous
     * 
     * Cette fonction est aussi sur la page edit avec le bouton supprimer 
     * 
     * @param Request $request qui permet de faire la requete de la suppression
     * 
     * @param RendezVous $rendezVou cette variable permet de savoir quel client nous avons choisi
     * 
     * @return rendez_vous_index avec la liste des rendez-vous sans le rendez-vous qui a été supprimé
     */
    public function delete(Request $request, RendezVous $rendezVou): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezVou->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rendezVou);
            $entityManager->flush();
        }
        $this->addFlash('success', "Le rendez-vous a bien été effacé");
        return $this->redirectToRoute('rendez_vous_index');
    }
}
