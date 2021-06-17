<?php

namespace App\Controller;

use App\Entity\Content;
use App\Form\ContentType;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Events;
use App\Controller\Month;

use function PHPUnit\Framework\equalTo;

/**
 * @Route("/content")
 */
class ContentController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     * Fonction qui permet l'affichage de la page Home qui sera visible en public
     * 
     * Cette page est la page d'accueil du site
     * 
     * @param ContentRepository $contentRepository
     * 
     * @return content/home.html.twig avec le contenu qui doit être visible sur cette page (texte de présentation et d'affiliation)
     */
    public function home(ContentRepository $contentRepository): Response
    {

        return $this->render('content/home.html.twig', [

            'controller_name' => 'ContentController',
            'contenu_accueil' => $contentRepository->findByPosition('texte'),
        ]);
    }
    /**
     * @Route("/contact", name="contact", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page Contact qui sera visible en public
     * 
     * Cette page est la page contact du site
     * 
     * @param ContentRepository $contentRepository
     * 
     * @return layout/contact.twig avec le contenu qui doit être visible sur cette page c'est a dire les infos de contact
     */
    public function contact(ContentRepository $contentRepository): Response
    {
        return $this->render('layout/contact.twig', [
            'controller_name' => 'ContentController',
            'contenu_contact' => $contentRepository->findByPosition('contact'),
        ]);
    }
    /**
     * @Route("/mentions", name="mentions_legales", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page est la page mentions légales du site
     * 
     * 
     * @return layout/mentions.twig 
     */
    public function mentions(): Response
    {
        return $this->render('layout/mentions.twig', [
            'controller_name' => 'ContentController',
        ]);
    }
    /**
     * @Route("/politique_conf", name="politique_conf", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page de la politique de confidentialité qui sera visible en public
     * 
     * 
     * @return layout/politiqueConfidentialite.twig 
     */
    public function politiqueConfidentialité(): Response
    {
        return $this->render('layout/politiqueConfidentialite.twig', [
            'controller_name' => 'ContentController',
        ]);
    }
    /**
     * @Route("/connexion", name="connexion", methods={"GET"})
     *  
     * Fonction qui permet l'affichage de la page Connexion qui sera visible en public
     * 
     * Cette page est la page connexion du site
     * 
     * @return layout/connexion.twig 
     */
    public function connexion(): Response
    {
        return $this->render('layout/connexion.twig', [
            'controller_name' => 'ContentController',
        ]);
    }
    /**
     * @Route("/index", name="content_index", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page index de Content
     * 
     * Cette page nous montre le listing des contenus
     * 
     * @param ContentRepository $contentRepository
     * 
     * @return content/index.html.twig avec les données des contenus dans la base de données
     */
    public function index(ContentRepository $contentRepository): Response
    {
        return $this->render('content/index.html.twig', [
            'contents' => $contentRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="content_new", methods={"GET","POST"})
     * Fonction qui permet l'affichage de la page new de content
     * 
     * Cette page nous montre le formulaire d'ajout d'un contenu
     * 
     * @param Request $request qui est la requete d'ajout d'un contenu
     * 
     * Si l'ajout est validé :
     * @return content_index qui est la page avec la liste des contenus
     * 
     * Si l'ajout n'est pas validé :
     * @return content/new.html.twig avec l'erreur affiché dans le champ en question
     */
    public function new(Request $request): Response
    {
        $content = new Content();
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
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
     * @Route("/{id}", name="content_show", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page show de conteut
     * 
     * Cette page nous montre les données du contenu choisi dans la liste des contenus de la page index de content
     * 
     * @param Content $content cette variable permet de savoir quel contenu nous avons choisi
     * 
     * @return content/show.html.twig qui est la page qui affiche les données du contenu choisi
     */
    public function show(Content $content): Response
    {
        return $this->render('content/show.html.twig', [
            'content' => $content,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="content_edit", methods={"GET","POST"})
     * 
     * Cette page nous montre le formulaire d'un contenu choisi dans la liste des contenu de index content
     * 
     * @param Request $request qui permet de faire la requete de la modification
     * 
     * @param Content $content qui permet de savoir la contenu choisi
     * 
     * si la modification est validée :
     * @return content_index qui est donc la liste des contenus avec le contenu qui a bien été modifié
     * 
     * si la modification n'est pas validée :
     * @return content/edit.html.twig avec l'erreur dans le champ en question
     */
    public function edit(Request $request, Content $content): Response
    {
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "Le contenu a bien été modifié");
            return $this->redirectToRoute('content_index');
        }

        return $this->render('content/edit.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="content_delete", methods={"POST"})
     * Fonction qui permet de supprimer un contenu
     * 
     * Cette fonction est présente sur la page edit avec le bouton supprimer 
     * 
     * @param Request $request qui permet de faire la requete de la suppression
     * 
     * @param Content $content cette variable permet de savoir quel contenu nous avons choisi
     * 
     * @return content_index avec la liste des contenus sans le contenu précédemment supprimé
     */
    public function delete(Request $request, Content $content): Response
    {
        if ($this->isCsrfTokenValid('delete' . $content->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($content);
            $entityManager->flush();
        }
        $this->addFlash('success', "Le contenu a bien été supprimé");
        return $this->redirectToRoute('content_index');
    }



    /**
     * @Route("/calendar", name="calendar", methods={"GET"})
     *  
     */
    public function agenda(): Response
    {
        $mois_actuel =date('m');
        $annee_actuelle = date('Y');
        $events = new Events();
        // $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
        $month = new Month($mois_actuel,$annee_actuelle);
        $start = $month->getStartingDay();
        $weeks = $month->getWeeks();
        $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify("last monday");
        $end = (clone $start)->modify('+' . (6 + 7 * $weeks - 1) . 'days');
        //$events = $events->getEventsBetweenByDay($start, $end);
        return $this->render('layout/agenda.twig', [
            'controller_name' => 'ContentController',
            'month'=>'month',
            'weeks'=>'weeks',
            'start'=>'start',
            'end'=>'end',
        ]);
    }
}
