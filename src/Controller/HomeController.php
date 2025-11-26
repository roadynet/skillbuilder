<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'title' => 'Symfony Kurs – Tag 1',
            'username' => 'Alvaro',
            'steps' => [
                'Entwicklungsumgebung eingerichtet (PHP, Composer, Git, Symfony-CLI)',
                'Neues Symfony-Projekt erstellt',
                'Ersten Controller & Route angelegt',
                'Twig-Template mit dynamischen Daten verbunden',
            ],
        ]);
    }
}
