<?php

namespace App\Controller;

use App\Entity\Lexique;
use App\Form\LexiqueType;
use App\Repository\LexiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lexique', name: 'lexique')]
class LexiqueController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(LexiqueRepository $lexiqueRepository): Response
    {
        $mots = $lexiqueRepository->findBy(['type' => Lexique::TYPE_MOT]);
        $expressions = $lexiqueRepository->findBy(['type' => Lexique::TYPE_EXPRESSION]);
        return $this->render('lexique/index.html.twig', [
            'mots' => $mots,
            'expressions' => $expressions
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier', requirements: ['id' => '\d+'])]
    public function editer(
        Request $request,
        EntityManagerInterface $entityManager,
        Lexique $lexique = new Lexique()
    ): Response
    {
        $form = $this->createForm(LexiqueType::class, $lexique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lexique);
            $entityManager->flush();
            $this->addFlash('success', 'Mot/expression enregistrée avec succès !');
            return $this->redirectToRoute('lexique_index');
        }
        return $this->render('lexique/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
    public function supprimer(Lexique $lexique, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($lexique);
        $entityManager->flush();
        $this->addFlash('success', 'Mot/expression supprimée avec succès !');
        return $this->redirectToRoute('lexique_index');
    }
}
