<?php

namespace App\Controller;

use App\Entity\Acteur;
use App\Form\ActeurFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActeurController extends AbstractController
{
    /**
     * @Route("/acteur", name="app_acteur")
     */
    public function index(): Response
    {
        return $this->render('acteur/index.html.twig', [
            'controller_name' => 'ActeurController',
        ]);
    }

    /**
     * @Route("/acteur/show", name="show_acteur")
     */
    public function showActeur(ManagerRegistry $doctrine): Response{

        $acteurs = $doctrine -> getRepository(Acteur::class)->findAll();

        return $this->render('acteur/show.html.twig', [
            'acteurs' => $acteurs,
        ]);
    }

    /**
     * @Route("/acteur/add", name="add_acteur")
     * @Route("/acteur/update/{id}", name="update_acteur")
     */
    public function add(ManagerRegistry $doctrine, Acteur $acteur = null, Request $request): Response{
        
        if(!$acteur) { // si l'entreprise n'existe pas alors tu l'ajoute
            $acteur = new Acteur(); // si l'entreprise déjà il va recup les données de lentreprise existante. 
        }


        $entityManager = $doctrine->GetManager();
        $form = $this-> createForm(ActeurFormType::class, $acteur);
        $form -> handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){

            $acteur = $form -> getData();
            $entityManager -> persist($acteur);
            $entityManager -> flush();

            return $this->redirectToRoute('app_acteur');
        }

        return $this->render('acteur/add.html.twig', [
                'FormActeur'=> $form ->createView()
        ]);
    }
        /**
     * @Route("/acteur/{id}", name="detail_acteur")
     */
    public function show(Acteur $acteur): Response
    {
        
        
        
        return $this->render('acteur/detail.html.twig', [
            'acteur' => $acteur,
        ]);
    }
}
