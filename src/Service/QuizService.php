<?php

namespace App\Service;

use App\Repository\QuizRepository;

class QuizService
{

    private QuizRepository $quizRepository;

    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    public function getQuestions(string $tableName) {
        $allIds = $this->quizRepository->getAllIds($tableName);

    }

    private function randomizeId(array $ids, int $numberQuestion) {
        $result = [];
        for ($i = 0; $i < $numberQuestion; $i++) {
            $rand = rand(0, count($ids) - 1);
            while (in_array($ids[$rand], $result)) {
                $rand = rand(0, count($ids) - 1);
            }
            $result[] = $rand;
        }
        return $result;
    }

}