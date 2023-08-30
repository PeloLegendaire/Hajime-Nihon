<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KanjiController extends AbstractController
{
    #[Route('/kanji', name: 'kanji_index')]
    public function index(): Response
    {
        return $this->render('kanji/index.html.twig', []);
    }

    #[Route('/kanji/ajouter', name: 'kanji_ajouter')]
    public function ajouter(): Response
    {
        return $this->render('kanji/ajouter.html.twig', [
            'controller_name' => 'KanjiController',
        ]);
    }
}
