<?php

namespace App\Controller;

use App\Entity\Content;
use App\Form\ContentType;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\equalTo;

/**
 * @Route("/content")
 */
class ContentController extends AbstractController
{

     /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(ContentRepository $contentRepository): Response
    {   

        return $this->render('content/home.html.twig', [
         
            'controller_name' => 'ContentController',
            'contenu_contact' => $contentRepository->findByPosition('contact'),
            'contenu_accueil' => $contentRepository->findByPosition('texte'),
        ]);
    }

    /**
    * @Route("/contact", name="contact", methods={"GET"})
    */
    public function contact(ContentRepository $contentRepository): Response
    {   
        
        return $this->render('layout/contact.twig', [
            'controller_name' => 'ContentController',
            'contenu_contact' => $contentRepository->findByPosition('contact'),
        ]);
    }

    /**
    * @Route("/connexion", name="connexion", methods={"GET"})
    */
    public function connexion(): Response
    {   
        
        return $this->render('layout/connexion.twig', [
            'controller_name' => 'ContentController',
        ]);
    }


    /**
     * @Route("/view", name="content_view", methods={"GET"})
     */
    public function view(ContentRepository $contentRepository): Response
    {
        return $this->render('content/index.html.twig', [
            'contents' => $contentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="content_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('content_index');
        }

        return $this->render('content/new.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="content_show", methods={"GET"})
     */
    public function show(Content $content): Response
    {
        return $this->render('content/show.html.twig', [
            'content' => $content,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="content_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Content $content): Response
    {
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('content_index');
        }

        return $this->render('content/edit.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="content_delete", methods={"POST"})
     */
    public function delete(Request $request, Content $content): Response
    {
        if ($this->isCsrfTokenValid('delete'.$content->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($content);
            $entityManager->flush();
        }

        return $this->redirectToRoute('content_index');
    }


    



    
}
