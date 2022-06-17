<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilmController extends AbstractController
{
    /**
     * @Route("/film", name="app_film")
     */
    public function index(): Response
    {
        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
        ]);
    }


    /**
     * @Route("/film/show", name="show_film")
     */
    public function showFilm(ManagerRegistry $doctrine): Response{

        $films = $doctrine -> getRepository(Film::class)->findAll();

        return $this->render('film/show.html.twig', [
            'films' => $films,
        ]);
    }

    /**
     * @Route("/film/add", name="add_film")
     * @Route("/film/update/{id}", name="update_film")
     */
    public function add(ManagerRegistry $doctrine, Film $film = null, Request $request): Response{
        
        if(!$film) { // si l'entreprise n'existe pas alors tu l'ajoute
            $film = new Film(); // si l'entreprise déjà il va recup les données de lentreprise existante. 
        }


        $entityManager = $doctrine->GetManager();
        $form = $this-> createForm(FilmType::class, $film);
        $form -> handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){

            $film = $form -> getData();
            $entityManager -> persist($film);
            $entityManager -> flush();

            return $this->redirectToRoute('app_film');
        }

        return $this->render('film/add.html.twig', [
                'FormFilm'=> $form ->createView()
        ]);
    }

    /**
     * @Route("/film/{id}", name="detail_film")
     */
    public function show(Film $film): Response
    {
        
        
        
        return $this->render('film/detail.html.twig', [
            'film' => $film,
        ]);
    }

    /**
     * @Route("/film/delete/{id}", name="delete_film")
     */
    public function delete(ManagerRegistry $doctrine, Film $film){
        $entityManager = $doctrine->getManager();
        $entityManager -> remove($film);
        $entityManager -> flush();
        return $this-> redirectToRoute("app_film");
    }

}

