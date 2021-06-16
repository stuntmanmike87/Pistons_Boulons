<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prestation")
 */
class PrestationController extends AbstractController
{

    /**
     * @Route("/", name="nos_prestations", methods={"GET"})
     * Fonction qui permet l'affichage de la page Prestations qui sera visible en public
     * 
     * Cette page nous montre le listing des prestations actives par types de prestations
     * 
     * Dans un premier temps on récupère les types de prestations actifs 
     * Ensuite on cherche les prestations actives pour les types qu'on a trouvés précédemment
     * 
     * @param PrestationRepository $prestationRepository
     * 
     * @return prestation/vue_prestations.twig avec les données sur les types de prestations ainsi que les prestations présents dans la base de données
     */
    public function nos_prestations(PrestationRepository $prestationRepository): Response
    {

        $typesPrestation = $prestationRepository->findByAllTypePrestation();
        //tableau final qui aura les prestations triées par types
        $listePrestations = array();


        //permet de classer les presta par types
        foreach ($typesPrestation as $typePresta) {
            foreach ($typePresta as $type) {

                //Requete pr récupérer chq prestation pour le type actuel
                $prestaParType = $prestationRepository->findByAllPrestationParTypePrestation($type);
                //Ajout au tableau associatif final : $listePrestations[[$type][$prestaParType]]
                $listePrestations[$type] =  $prestaParType;
            }
        }
        return $this->render('prestation/vue_prestations.twig', [
            "typesPrestation" => $typesPrestation,
            "prestations" => $listePrestations,

        ]);
    }

    /**
     * @Route("/index", name="prestation_index", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page index de prestation
     * 
     * Cette page nous montre le listing des prestations
     * 
     * @param PrestationRepository $prestationRepository
     * 
     * @return prestation/index.html.twig avec les données des prestations dans la base de données
     */
    public function index(PrestationRepository $prestationRepository): Response
    {
        return $this->render('prestation/index.html.twig', [
            'prestations' => $prestationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prestation_new", methods={"GET","POST"})
     * Fonction qui permet l'affichage de la page new de prestation
     * 
     * Cette page nous montre le formulaire d'ajout d'une prestation
     * 
     * @param Request $request qui est la requete d'ajout de la prestation
     * 
     * Si l'ajout est validé :
     * @return prestation_index qui est la page avec la liste des prestations
     * 
     * Si l'ajout n'est pas validé :
     * @return prestation/new.html.twig avec l'erreur affiché dans le champ en question
     */
    public function new(Request $request): Response
    {
        $prestation = new Prestation();
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prestation);
            $entityManager->flush();
            $this->addFlash('success', "La prestation a bien été ajoutée");
            return $this->redirectToRoute('prestation_index');
        }

        return $this->render('prestation/new.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prestation_show", methods={"GET"})
     * 
     * Fonction qui permet l'affichage de la page show de prestation
     * 
     * Cette page nous montre les données de la prestation choisie dans la liste des prestations de la page index de prestation
     * 
     * @param Prestation $prestation cette variable permet de savoir quelle prestation nous avons choisie
     * 
     * @return prestation/show.html.twig qui est la page qui affiche les données de la prestation choisie
     */
    public function show(Prestation $prestation): Response
    {
        return $this->render('prestation/show.html.twig', [
            'prestation' => $prestation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prestation_edit", methods={"GET","POST"})
     * Fonction qui permet l'affichage de la page edit de prestation
     * 
     * Cette page nous montre le formulaire d'une prestation choisie dans la liste des prestations de index prestation
     * 
     * @param Request $request qui permet de faire la requete de la modification
     * 
     * @param Prestation $prestation qui permet de savoir la prestation choisie
     * 
     * si la modification est validée :
     * @return prestation_index qui est donc la liste des prestations avec la prestation qui a bien été modifiée
     * 
     * si la modification n'est pas validée :
     * @return prestation/edit.html.twig avec l'erreur dans le champ en question
     */
    public function edit(Request $request, Prestation $prestation): Response
    {
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "La prestation a bien été modifiée");

            return $this->redirectToRoute('prestation_index');
        }

        return $this->render('prestation/edit.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prestation_delete", methods={"POST"})
     * Fonction qui permet supprimer une prestation
     * 
     * Cette fonction est présente sur la page edit avec le bouton supprimer 
     * 
     * @param Request $request qui permet de faire la requete de la suppression
     * 
     * @param Prestation $prestation cette variable permet de savoir quelle prestation nous avons choisie
     * 
     * @return prestation_index avec la liste des prestations sans la prestation précédemment supprimé
     */
    public function delete(Request $request, Prestation $prestation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $prestation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prestation);
            $entityManager->flush();
        }
        $this->addFlash('success', "La prestation a bien été supprimée");
        return $this->redirectToRoute('prestation_index');
    }
}
