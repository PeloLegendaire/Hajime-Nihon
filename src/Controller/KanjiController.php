<?php

namespace App\Controller;

use App\Entity\Kanji;
use App\Form\KanjiType;
use App\Repository\KanjiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/kanji', name: 'kanji')]
class KanjiController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(KanjiRepository $kanjiRepository): Response
    {
        return $this->render('kanji/index.html.twig', [
            'kanjis' => $kanjiRepository->findAll()
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier', requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_ADMIN')]
    public function editer(
        Request $request,
        EntityManagerInterface $entityManager,
        Kanji $kanji = new Kanji()
    ): Response
    {
        $form = $this->createForm(KanjiType::class, $kanji);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($kanji);
            $entityManager->flush();
            $this->addFlash('success', 'Kanji enregistré avec succès !');
            return $this->redirectToRoute('kanji_index');
        }
        return $this->render('kanji/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_ADMIN')]
    public function supprimer(Kanji $kanji, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($kanji);
        $entityManager->flush();
        $this->addFlash('success', 'Kanji supprimé avec succès !');
        return $this->redirectToRoute('kanji_index');
    }
}
