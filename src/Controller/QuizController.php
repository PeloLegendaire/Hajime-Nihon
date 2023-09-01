<?php

namespace App\Controller;

use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/quiz', name: 'quiz')]
class QuizController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function index(QuizRepository $quizRepository): Response
    {
        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizRepository->findAll()
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier/{id}', name: '_modifier', requirements: ['id' => '\d+'])]
    public function editer(
        Request $request,
        EntityManagerInterface $entityManager,
        Quiz $quiz = new Quiz()
    ): Response
    {
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quiz);
            $entityManager->flush();
            $this->addFlash('success', 'Quiz enregistré avec succès !');
            return $this->redirectToRoute('quiz_index');
        }
        return $this->render('quiz/ajouter.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/supprimer/{id}', name: '_supprimer', requirements: ['id' => '\d+'])]
    public function supprimer(Quiz $quiz, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($quiz);
        $entityManager->flush();
        $this->addFlash('success', 'Quiz supprimé avec succès !');
        return $this->redirectToRoute('quiz_index');
    }

    #[Route('/commencer/{id}', name: '_commencer', requirements: ['id' => '\d+'])]
    public function commencer(Quiz $quiz, EntityManagerInterface $entityManager): Response
    {

        return $this->render('quiz/commencer.html.twig', [
            'quiz' => $quiz
        ]);
    }
}
