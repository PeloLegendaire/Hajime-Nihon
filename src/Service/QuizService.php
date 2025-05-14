<?php

namespace App\Service;

use App\Repository\QuizRepository;
use Doctrine\DBAL\Exception;

class QuizService
{

    private QuizRepository $quizRepository;

    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    /**
     * @throws Exception
     */
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
        $idsPool = array_column($ids, 'id');
        shuffle($idsPool);
        return array_slice($idsPool, 0, min($numberQuestion, count($idsPool)));
    }

}