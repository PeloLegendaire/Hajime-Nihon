<?php

namespace App\Controller;

use App\Repository\HiraganaRepository;
use App\Repository\KatakanaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        HiraganaRepository $hiraganaRepository,
        KatakanaRepository $katakanaRepository
    ): Response
    {
        if ($signe === 'hiragana') {
            $signes = $hiraganaRepository->findAll();
        } elseif ($signe === 'katakana') {
            $signes = $katakanaRepository->findAll();
        } else {
            return $this->redirectToRoute('app_index');
        }
        return $this->render('app/signe.html.twig', [
            'type' => $signe,
            'signes' => $signes
        ]);
    }
}
