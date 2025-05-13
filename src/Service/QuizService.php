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

    public function getQuestions(string $type, int $numberQuestion): array
    {
        $questions = [];
        $tableName = 'lexique';
        if (!in_array($type, ['mot', 'expression'])) {
            $tableName = $type;
            $type = null;
        }
        $allIds = $this->quizRepository->getAllIds($tableName);
        $idsRandomized = $this->randomizeId($allIds, $numberQuestion);
        foreach ($idsRandomized as $key => $id) {
            $question = $this->quizRepository->getQuestion($id, $tableName, $type);
            $questions[$key]['signe'] = ($type !== null ? $question['kanji'] : $question['signe']);
            $questions[$key]['romaji'] = $question['romaji'];
        }
        return $questions;
    }

    private function randomizeId(array $ids, int $numberQuestion): array
    {
        $result = [];
        for ($i = 0; $i < $numberQuestion; $i++) {
            $rand = rand(0, count($ids) - 1);
            while (in_array($ids[$rand]['id'], $result)) {
                $rand = rand(0, count($ids) - 1);
            }
            $result[] = $ids[$rand]['id'];
        }
        return $result;
    }

}