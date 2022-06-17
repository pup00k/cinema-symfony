<?php

namespace App\Controller;

use App\Entity\Genre;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenreController extends AbstractController
{
    /**
     * @Route("/genre", name="app_genre")
     */
    public function index(): Response
    {
        return $this->render('genre/index.html.twig', [
            'controller_name' => 'GenreController',
        ]);
    }

    /**
     * @Route("/genre/show", name="show_genre")
     */
    public function showGenre(ManagerRegistry $doctrine): Response{

        $genres = $doctrine -> getRepository(Genre::class)->findAll();

        return $this->render('genre/show.html.twig', [
            'genres' => $genres,
        ]);
    }
    /**
     * @Route("/genre/{id}", name="detail_genre")
     */
    public function show(Genre $genre): Response
    {
        
        
        
        return $this->render('genre/detail.html.twig', [
            'genre' => $genre,
        ]);
    }
}
