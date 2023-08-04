<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Content;
use App\Form\ContentType;
use App\Repository\ContentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/content')]
final class ContentController extends AbstractController
{
    public function __construct(private readonly ManagerRegistry $em) {}

    /**
     *
     * Cette page est la page d'accueil du site
     *
     *
     * return content/home.html.twig avec le contenu qui doit être visible sur cette page (texte de présentation et d'affiliation)
     */
    #[Route(path: '/', name: 'home', methods: ['GET'])]
    public function home(ContentRepository $contentRepository): Response
    {

        return $this->render('content/home.html.twig', [

            'controller_name' => 'ContentController',
            'contenu_accueil' => $contentRepository->findByPosition('texte'),
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page erreur 404
     * return layout/error404.twig 
     */
    #[Route(path: '/error404', name: 'error404', methods: ['GET'])]
    public function error404(): Response
    {
        return $this->render('layout/error404.twig', [
            'controller_name' => 'ContentController'
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page Contact qui sera visible en public
     *
     * Cette page est la page contact du site
     *
     * return layout/contact.twig avec le contenu qui doit être visible sur cette page c'est a dire les infos de contact
     */
    #[Route(path: '/contact', name: 'contact', methods: ['GET'])]
    public function contact(ContentRepository $contentRepository): Response
    {
        return $this->render('layout/contact.twig', [
            'controller_name' => 'ContentController',
            'contenu_contact' => $contentRepository->findByPosition('contact'),
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page est la page mentions légales du site
     *
     * return layout/mentions.twig 
     */
    #[Route(path: '/mentions', name: 'mentions_legales', methods: ['GET'])]
    public function mentions(): Response
    {
        return $this->render('layout/mentions.twig', [
            'controller_name' => 'ContentController',
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page de la politique de confidentialité qui sera visible en public
     *
     * return layout/politiqueConfidentialite.twig 
     */
    #[Route(path: '/politique_conf', name: 'politique_conf', methods: ['GET'])]
    public function politiqueConfidentialité(): Response
    {
        return $this->render('layout/politiqueConfidentialite.twig', [
            'controller_name' => 'ContentController',
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page de la politique de confidentialité qui sera visible en public
     *
     * return layout/politiqueConfidentialite.twig 
     */
    #[Route(path: '/plan_du_site', name: 'plan_site', methods: ['GET'])]
    public function planDuSite(): Response
    {
        return $this->render('layout/plandusite.twig', [
            'controller_name' => 'ContentController',
        ]);
    }

    /** 
     * Fonction qui permet l'affichage de la page Connexion qui sera visible en public
     *
     * Cette page est la page connexion du site
     * return layout/connexion.twig 
     */
    #[Route(path: '/connexion', name: 'connexion', methods: ['GET'])]
    public function connexion(): Response
    {
        return $this->render('layout/connexion.twig', [
            'controller_name' => 'ContentController',
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page index de Content
     *
     * Cette page nous montre le listing des contenus
     *
     * return content/index.html.twig avec les données des contenus dans la base de données
     */
    #[Route(path: '/index', name: 'content_index', methods: ['GET'])]
    public function index(ContentRepository $contentRepository): Response
    {
        return $this->render('content/index.html.twig', [
            'contents' => $contentRepository->findAll(),
        ]);
    }

    /**
     * Cette page nous montre le formulaire d'ajout d'un contenu
     *
     * @param Request $request qui est la requete d'ajout d'un contenu
     *
     * Si l'ajout est validé :
     * return content_index qui est la page avec la liste des contenus
     * Si l'ajout n'est pas validé :
     * return content/new.html.twig avec l'erreur affiché dans le champ en question
     */
    #[Route(path: '/new', name: 'content_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $content = new Content();
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->em->getManager();
            $entityManager->persist($content);
            $entityManager->flush();
            $this->addFlash('success', "Le contenu a bien été ajouté");
            return $this->redirectToRoute('content_index');
        }

        return $this->render('content/new.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page show de conteut
     *
     * Cette page nous montre les données du contenu choisi dans la liste des contenus de la page index de content
     *
     * @param Content $content cette variable permet de savoir quel contenu nous avons choisi
     * return content/show.html.twig qui est la page qui affiche les données du contenu choisi
     */
    #[Route(path: '/{id}', name: 'content_show', methods: ['GET'])]
    public function show(Content $content): Response
    {
        return $this->render('content/show.html.twig', [
            'content' => $content,
        ]);
    }

    /**
     * Cette page nous montre le formulaire d'un contenu choisi dans la liste des contenu de index content
     *
     * @param Request $request qui permet de faire la requete de la modification
     *
     * @param Content $content qui permet de savoir la contenu choisi
     *
     * si la modification est validée :
     * return content_index qui est donc la liste des contenus avec le contenu qui a bien été modifié
     * si la modification n'est pas validée :
     * return content/edit.html.twig avec l'erreur dans le champ en question
     */
    #[Route(path: '/{id}/edit', name: 'content_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Content $content): Response
    {
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->getManager()->flush();
            $this->addFlash('success', "Le contenu a bien été modifié");
            return $this->redirectToRoute('content_index');
        }

        return $this->render('content/edit.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Cette fonction est présente sur la page edit avec le bouton supprimer 
     *
     * @param Request $request qui permet de faire la requete de la suppression
     *
     * @param Content $content cette variable permet de savoir quel contenu nous avons choisi
     * return content_index avec la liste des contenus sans le contenu précédemment supprimé
     */
    #[Route(path: '/{id}', name: 'content_delete', methods: ['POST'])]
    public function delete(Request $request, Content $content): Response
    {
        if ($this->isCsrfTokenValid('delete' . $content->getId(), (string)$request->request->get('_token'))) {
            $entityManager = $this->em->getManager();
            $entityManager->remove($content);
            $entityManager->flush();
        }

        $this->addFlash('success', "Le contenu a bien été supprimé");
        return $this->redirectToRoute('content_index');
    }

}
