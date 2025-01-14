<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Calendar;
use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Repository\ContentRepository;
use App\Repository\RendezVousRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/rendez/vous')]
final class RendezVousController extends AbstractController
{
    public function __construct(private readonly ManagerRegistry $em)
    {
    }

    private ?Calendar $calendar = null;

    /**
     * Fonction qui permet l'affichage de la page index de rendez-vous.
     *
     * Cette page nous montre le listing rendez-vous
     *
     * return rendez_vous/index.html.twig
     * avec les données des rendez-vous dans la base de données
     */
    #[Route(path: '/', name: 'rendez_vous_index', methods: ['GET'])]
    public function index(RendezVousRepository $rendezVousRepository): Response
    {
        $this->calendar = new Calendar();

        return $this->render('rendez_vous/index.html.twig', [
            'rendez_vouses' => $rendezVousRepository->findAll(),
        ]);
    }

    /**
     * return rendez_vous/agenda.twig
     * avec les données des rendez-vous dans la base de données.
     */
    #[Route(path: '/agenda', name: 'agendaMensuel')]
    public function agendaMensuel(RendezVousRepository $rendezVousRepository): Response
    {
        $this->calendar = new Calendar();

        /** @var \DateTimeInterface $debut */
        $debut = $this->calendar->getStart();
        $mois = $debut->format('m');
        $annee = $debut->format('Y');
        $moisSuivant = (int) mktime(0, 0, 0, $mois + 1, 1, (int) $annee);
        $dernierJour = date('Y-m-d', $moisSuivant--);
        $fin = \DateTime::createFromFormat('d-m-Y', $dernierJour);
        $liste_events = $rendezVousRepository->findAllByDateRendezVous($debut, $fin);

        return $this->render('rendez_vous/agenda.twig', [
            'controller_name' => 'ContentController',
            'events' => $liste_events,
        ]);
    }

    /**
     * return rendez_vous/agenda.twig
     * avec les données des rendez-vous dans la base de données.
     */
    #[Route(path: '/agenda/{month}-{year}', name: 'agenda', methods: ['GET', 'POST'])]
    public function agenda(RendezVousRepository $rendezVousRepository, ?int $year, ?int $month): Response
    {
        // $this->calendar = new Calendar($month,$year);
        // Class App\Entity\Calendar does not have a constructor and must be instantiated without any parameters.
        $calendar = $this->calendar;

        /** @var Calendar $calendar */
        $debut = $calendar->getStart();
        /** @var \DateTimeInterface $debut */
        $mois = $debut->format('m');
        $annee = $debut->format('Y');
        $moisSuivant = (int) mktime(0, 0, 0, $mois + 1, 1, (int) $annee);
        $dernierJour = date('Y-m-d', $moisSuivant--);
        $fin = \DateTime::createFromFormat('d-m-Y', $dernierJour);
        $liste_events = $rendezVousRepository->findAllByDateRendezVous($debut, $fin);

        return $this->render('rendez_vous/agenda.twig', [
            'controller_name' => 'ContentController',
            'events' => $liste_events,
        ]);
    }

    /**
     * return rendez_vous/agenda.twig
     * avec les données des rendez-vous dans la base de données.
     */
    #[Route(path: '/agenda_quotidien/{day}', name: 'agenda_quotidien', methods: ['GET', 'POST'])]
    public function agenda_quotidien(\DateTime $day, RendezVousRepository $rendezVousRepository): Response
    {
        $date = $day->format('d/m/Y');
        $demain = mktime(0, 0, 0, (int) $day->format('m'), $day->format('d') + 1, (int) $day->format('Y'));
        $hier = mktime(0, 0, 0, (int) $day->format('m'), $day->format('d') - 1, (int) $day->format('Y'));
        $events = $rendezVousRepository->findByDateRendezVous($day);

        return $this->render('rendez_vous/agenda_quotidien.twig', [
            'controller_name' => 'ContentController',
            'events' => $events,
            'date' => $date,
            'demain' => $demain,
            'hier' => $hier,
        ]);
    }

    /**
     * return Month month retourne un mois correspondant au Service.
     */
    #[Route(path: '/pdf/{id}', name: 'rendez_vous_pdf')]
    public function getCalendar(): ?Calendar
    {
        return $this->calendar;
    }

    /**
     * return rendez_vous/pdf.twig
     * avec les données du rendez-vous dans la base de données.
     */
    #[Route(path: '/pdf/{id}', name: 'rendez_vous_pdf')]
    public function pdf(int $id, RendezVousRepository $rendezVousRepository, ContentRepository $content): Response
    {
        $this->calendar = new Calendar();

        $rv = new RendezVous();
        /** @var RendezVous $rv */
        $rv = $rendezVousRepository->findOneBy(['id' => $id]);
        /** @var \DateTimeInterface $date_rdv */
        $date_rdv = $rv->getDateRendezVous(); // "RDV du ". //
        $titre = $date_rdv->format('d-m-Y').' à '.$date_rdv->format('H:i');

        return $this->render('rendez_vous/pdf.twig', [
            'controller_name' => 'ContentController',
            'title' => $titre,
            'event' => $rv,
            'contenu_contact' => $content->findByPosition('contact'),
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page new de rendez-vous.
     *
     * Cette page nous montre le formulaire d'ajout de rendez-vous
     *
     * Si l'ajout est validé :
     * return rendez_vous_index
     * page avec la liste des rendez-vous et donc aussi du rendez-vous qui a été ajouté.
     *
     * Si l'ajout n'est pas validé :
     * return rendez_vous/new.html.twig avec l'erreur affiché dans le champ en question
     */
    #[Route(path: '/new', name: 'rendez_vous_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $this->calendar = new Calendar();
        $rendezVou = new RendezVous();

        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->em->getManager();
            $entityManager->persist($rendezVou);
            $entityManager->flush();
            $this->addFlash('success', 'Le rendez-vous a bien été ajouté');

            return $this->redirectToRoute('rendez_vous_index');
        }

        return $this->render('rendez_vous/new.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form,
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page show de rendez-vous.
     *
     * Cette page nous montre les données d'un rendez-vous choisi
     * dans la liste des rendez-vous de la page index de rendez-vous
     *
     * param RendezVous $rendezVou cette variable
     * permet de savoir quel rendez-vous nous avons choisi
     *
     * return rendez_vous/show.html.twig qui est la page
     * qui affiche les données du rendez-vous choisi
     */
    #[Route(path: '/{id}', name: 'rendez_vous_show', methods: ['GET'])]
    public function show(RendezVous $rendezVou): Response
    {
        $this->calendar = new Calendar();

        return $this->render('rendez_vous/show.html.twig', [
            'rendez_vou' => $rendezVou,
        ]);
    }

    /**
     * Fonction qui permet l'affichage de la page edit de rendez-vous.
     *
     * Cette page nous montre le formulaire d'un rendez-vous choisi
     * dans la liste des rendez-vous de index rendez-vous
     *
     * param Request $request qui permet de faire la requete de la modification
     *
     * param RendezVous $rendezVou qui permet de savoir le rendez-vous choisi
     *
     * si la modification est validée : return rendez_vous_index
     * qui est donc la liste des clients avec le client qui a bien été modifié
     *
     * si la modification n'est pas validée :
     * return rendez_vous/edit.html.twig avec l'erreur dans le champ en question
     */
    #[Route(path: '/{id}/edit', name: 'rendez_vous_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RendezVous $rendezVou): Response
    {
        $this->calendar = new Calendar();

        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->getManager()->flush();
            $this->addFlash('success', 'Le rendez-vous a bien été modifié');

            return $this->redirectToRoute('rendez_vous_index');
        }

        return $this->render('rendez_vous/edit.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form,
        ]);
    }

    /**
     * Fonction qui permet le delete de rendez-vous.
     *
     * Cette fonction est aussi sur la page edit avec le bouton supprimer
     *
     * param Request $request qui permet de faire la requete de la suppression
     *
     * param RendezVous $rendezVou cette variable permet de savoir quel client nous avons choisi
     *
     * return rendez_vous_index avec la liste des rendez-vous sans le rendez-vous qui a été supprimé
     */
    #[Route(path: '/{id}', name: 'rendez_vous_delete', methods: ['POST'])]
    public function delete(Request $request, RendezVous $rendezVou): Response
    {
        $this->calendar = new Calendar();

        if ($this->isCsrfTokenValid('delete'.$rendezVou->getId(), (string) $request->request->get('_token'))) {
            $entityManager = $this->em->getManager();
            $entityManager->remove($rendezVou);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Le rendez-vous a bien été effacé');

        return $this->redirectToRoute('rendez_vous_index');
    }
}
