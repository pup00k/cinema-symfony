<?php

namespace App\Controller;

use App\Entity\Personnage;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonnageController extends AbstractController
{
    /**
     * @Route("/personnage", name="app_personnage")
     */
    public function index(): Response
    {
        return $this->render('personnage/index.html.twig', [
            'controller_name' => 'PersonnageController',
        ]);
    }
    /**
     * @Route("/personnage/show", name="show_personnages")
     */
    public function showActeur(ManagerRegistry $doctrine): Response{

        $personnages = $doctrine -> getRepository(Personnage::class)->findAll();

        return $this->render('personnage/show.html.twig', [
            'personnages' => $personnages,
        ]);
    }
        /**
     * @Route("/personnage/{id}", name="detail_personnage")
     */
    public function show(Personnage $personnage): Response
    {
        
        
        
        return $this->render('personnage/detail.html.twig', [
            'personnage' => $personnage,
        ]);
    }
}
