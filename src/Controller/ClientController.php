<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/client')]
final class ClientController extends AbstractController
{
    public function __construct(private readonly ManagerRegistry $em) {}
    
    /**
     * Fonction qui permet l'affichage de la page index de client
     *
     * Cette page nous montre le listing des clients
     *
     * return client/index.html.twig avec les données des clients dans la base de données
     */
    #[Route(path: '/', name: 'client_index', methods: ['GET'])]
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'clients' => $clientRepository->findByIsActif(),
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page new de client
     *
     * Cette page nous montre le formulaire d'ajout de client
     *
     * param Request $request qui est la requete d'ajout du client
     *
     * Si l'ajout est validé :
     * return client_index qui est la page avec la liste des clients et donc aussi du client qui a été ajouté.
     * Si l'ajout n'est pas validé :
     * return client/new.html.twig avec l'erreur affiché dans le champ en question
     */
    #[Route(path: '/new', name: 'client_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->em->getManager();
            $client->setIsActif(true);
            $entityManager->persist($client);
            $entityManager->flush();

            
            $this->addFlash('success', 'Le client a bien été ajouté');

            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/new.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }
 

    /**
     * Fonction qui permet l'affichage de la page show de client
     *
     * Cette page nous montre les données d'un client choisi dans la liste des clients de la page index de client
     *
     * param Client $client cette variable permet de savoir quel client nous avons choisi
     * return client/show.html.twig qui est la page qui affiche les données du client choisi
     */
    #[Route(path: '/{id}', name: 'client_show', methods: ['GET'])]
    public function show(Client $client): Response
    {
        return $this->render('client/show.html.twig', [
            'client' => $client,
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page edit de client
     *
     * Cette page nous montre le formulaire d'un client choisi dans la liste des clients de index client
     *
     * param Request $request qui permet de faire la requete de la modification
     *
     * param Client $client qui permet de savoir le client choisi
     *
     * si la modification est validée :
     * return client_index qui est donc la liste des clients avec le client qui a bien été modifié
     * si la modification n'est pas validée :
     * return client/edit.html.twig avec l'erreur dans le champ en question
     */
    #[Route(path: '/{id}/edit', name: 'client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->getManager()->flush();


            $this->addFlash('success', 'Le client a bien été modifié');

            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/edit.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Fonction qui permet le delete de client
     *
     * Cette fonction est aussi sur la page edit avec le bouton supprimer 
     *
     * param Request $request qui permet de faire la requete de la suppression
     *
     * param Client $client cette variable permet de savoir quel client nous avons choisi
     * return client_index avec la liste des clients sans le client qui a été supprimé
     */
    #[Route(path: '/{id}', name: 'client_delete', methods: ['POST'])]
    public function delete(Request $request, Client $client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$client->getId(), (string)$request->request->get('_token'))) {
            $entityManager = $this->em->getManager();
            $client->setIsActif(false);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Le client a bien été effacé');
        return $this->redirectToRoute('client_index');
    }
}
