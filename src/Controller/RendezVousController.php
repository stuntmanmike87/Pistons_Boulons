<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Service\AgendaService;
use App\Repository\RendezVousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ContentRepository;
use App\Controller\Month;
use Dompdf\Dompdf;
use Dompdf\Options;
/**
 * @Route("/rendez/vous")
 */
class RendezVousController extends AbstractController
{

    private $month;

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
        $this->month = new Month();
        return $this->render('rendez_vous/index.html.twig', [
            'rendez_vouses' => $rendezVousRepository->findAll(),
        ]);
    }

    /**
     * @Route("/agenda", name="agendaMensuel")
     * 
     * @param RendezVousRepository $rendezVousRepository 
     * @return rendez_vous/agenda.twig avec les données des rendez-vous dans la base de données
     */
    public function agendaMensuel(RendezVousRepository $rendezVousRepository): Response
    {
       
        $this->month = new Month();
        $debut =  $this->month->getStartingDay();
        $mois = $debut->format('m');
        $annee = $debut->format('Y');
        $moisSuivant = mktime(0, 0, 0, $mois+1, 1, $annee);
        $dernierJour = date('Y-m-d',$moisSuivant--); 
        $liste_events = $rendezVousRepository->findAllByDateRendezVous($debut,$dernierJour);
        return $this->render('rendez_vous/agenda.twig', [
            'controller_name' => 'ContentController',
            'events' => $liste_events
        ]);
    }
    /**
     * @Route("/agenda/{month}-{year}", name="agenda", methods={"GET","POST"})
     * 
     * @param RendezVousRepository $rendezVousRepository 
     * @return rendez_vous/agenda.twig avec les données des rendez-vous dans la base de données
     */
    public function agenda(RendezVousRepository $rendezVousRepository,$year,$month): Response
    {
       
        $this->month = new Month($month,$year);
        
        $debut =  $this->month->getStartingDay();
        $mois = $debut->format('m');
        $annee = $debut->format('Y');
        $moisSuivant = mktime(0, 0, 0, $mois+1, 1, $annee);
        $dernierJour = date('Y-m-d',$moisSuivant--); 
        $liste_events = $rendezVousRepository->findAllByDateRendezVous($debut,$dernierJour);
        return $this->render('rendez_vous/agenda.twig', [
            'controller_name' => 'ContentController',
            'events' => $liste_events
        ]);
    }
    /**
     * @Route("/agenda_quotidien/{day}", name="agenda_quotidien", methods={"GET","POST"})
     * 
     * @param RendezVousRepository $rendezVousRepository 
     * @return rendez_vous/agenda.twig avec les données des rendez-vous dans la base de données
     */
    public function agenda_quotidien(\DateTime $day,RendezVousRepository $rendezVousRepository): Response
    {
        $date = $day->format('d/m/Y');
        $demain  = mktime(0, 0, 0, $day->format('m')  , $day->format('d') +1, $day->format('Y') );
        $hier = mktime(0, 0, 0, $day->format('m')  , $day->format('d') -1, $day->format('Y') );
        $events = $rendezVousRepository->findByDateRendezVous($day);
        return $this->render('rendez_vous/agenda_quotidien.twig', [
            'controller_name' => 'ContentController',
            'events' => $events,
            'date'=> $date,
            'demain'=>$demain,
            'hier'=>$hier
        ]);
    }

    public function getMonth()
    {
        return $this->month;
    }
    /**
     * @Route("/pdf/{id}", name="rendez_vous_pdf")
     */
    public function pdf(int $id , RendezVousRepository $rendezVousRepository, ContentRepository $content): Response
    {
        $this->month = new Month();
        $rv = new RendezVous();
        $rv = $rendezVousRepository->findOneBy(['id' => $id]);
        $titre = "RDV du ".$rv->getDateRendezVous()->format("d-m-Y"). " à ". $rv->getDateRendezVous()->format("H:i");
       
         return $this->render('rendez_vous/pdf.twig', [
            'controller_name' => 'ContentController',
            'title' => $titre,
            'event' => $rv,
            'contenu_contact' => $content->findByPosition('contact'),
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
        $this->month = new Month();
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
        $this->month = new Month();
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
        $this->month = new Month();
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
        $this->month = new Month();
        if ($this->isCsrfTokenValid('delete' . $rendezVou->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rendezVou);
            $entityManager->flush();
        }
        $this->addFlash('success', "Le rendez-vous a bien été effacé");
        return $this->redirectToRoute('rendez_vous_index');
    }
}
