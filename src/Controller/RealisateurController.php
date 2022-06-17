<?php

namespace App\Controller;



use App\Entity\Realisateur;
use App\Form\RealisateurType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RealisateurController extends AbstractController
{
    /**
     * @Route("/realisateur", name="app_realisateur")
     */
    public function index(): Response
    {
        return $this->render('realisateur/index.html.twig', [
            'controller_name' => 'RealisateurController',
        ]);
    }

    /**
     * @Route("/realisateur/show", name="show_realisateur")
     */
    public function showRealisateur(ManagerRegistry $doctrine): Response{

        $realisateurs = $doctrine->getRepository(Realisateur::class)->findAll();

        return $this->render('realisateur/show.html.twig', [
            'realisateurs' => $realisateurs,
        ]);
    }

    

    /**
     * @Route("/realisateur/add", name="add_realisateur")
     * @Route("/realisateur/update/{id}", name="update_realisateur")
     */
    public function add(ManagerRegistry $doctrine, Realisateur $realisateur = null, Request $request): Response{
        
        if(!$realisateur) { // si l'entreprise n'existe pas alors tu l'ajoute
            $realisateur = new Realisateur(); // si l'entreprise déjà il va recup les données de lentreprise existante. 
        }


        $entityManager = $doctrine->GetManager();
        $form = $this-> createForm(RealisateurType::class, $realisateur);
        $form -> handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){

            $realisateur = $form -> getData();
            $entityManager -> persist($realisateur);
            $entityManager -> flush();

            return $this->redirectToRoute('app_film');
        }

        return $this->render('realisateur/add.html.twig', [
                'FormRealisateur'=> $form ->createView()
        ]);
    }

        /**
     * @Route("/film/delete/{id}", name="delete_realisateur")
     */
    public function delete(ManagerRegistry $doctrine, Realisateur $realisateur){
        $entityManager = $doctrine->getManager();
        $entityManager -> remove($realisateur);
        $entityManager -> flush();
        return $this-> redirectToRoute("app_film");
    }

    /**
     * @Route("/realisateur/{id}", name="detail_realisateur")
     */
    public function show(Realisateur $realisateur): Response // 
    {
        
        
        
        return $this->render('realisateur/detail.html.twig', [
            'realisateur' => $realisateur,
        ]);
    }
}
