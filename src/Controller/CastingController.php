<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CastingController extends AbstractController
{
    /**
     * @Route("/casting", name="app_casting")
     */
    public function index(): Response
    {
        return $this->render('casting/index.html.twig', [
            'controller_name' => 'CastingController',
        ]);
    }
}
