<?php

namespace App\Controller;

use App\Repository\HiraganaRepository;
use App\Repository\KatakanaRepository;
use App\Repository\SigneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('app/index.html.twig', []);
    }

    #[Route('/syllabaire/{signe}', name: 'app_signe')]
    public function signe(
        string $signe,
        SigneRepository $signeRepository,
        HiraganaRepository $hiraganaRepository,
        KatakanaRepository $katakanaRepository
    ): Response
    {
        if ($signe === 'hiragana') {
            $signes = $signeRepository->findByTypeOrdered($hiraganaRepository);
        } elseif ($signe === 'katakana') {
            $signes = $signeRepository->findByTypeOrdered($katakanaRepository);
        } else {
            return $this->redirectToRoute('app_index');
        }
        return $this->render('app/signe.html.twig', [
            'type' => $signe,
            'tabSignes' => $signes
        ]);
    }
}
