<?php

namespace App\Tests\Service;

use App\Repository\QuizRepository;
use App\Service\QuizService;
use Doctrine\DBAL\Exception;
use PHPUnit\Framework\TestCase;

class QuizServiceTest extends TestCase
{

    /**
     * @throws Exception
     */
    public function testGetQuestionsWithTypeMot(): void
    {
        $repository = $this->createMock(QuizRepository::class);

        // On simule 5 IDs en base
        $repository->method('getAllIds')
            ->with('lexique')
            ->willReturn([
                ['id' => 1], ['id' => 2], ['id' => 3], ['id' => 4], ['id' => 5]
            ]);

        // Simule le retour de getQuestion
        $repository->method('getQuestion')
            ->willReturnCallback(function ($id, $table, $type) {
                return [
                    'kanji' => "kanji_$id",
                    'romaji' => "romaji_$id",
                ];
            });

        $service = new QuizService($repository);

        $questions = $service->getQuestions('mot', 3);

        $this->assertCount(3, $questions);
        foreach ($questions as $q) {
            $this->assertArrayHasKey('signe', $q);
            $this->assertArrayHasKey('romaji', $q);
            $this->assertStringStartsWith('kanji_', $q['signe']);
        }
    }

    /**
     * @throws Exception
     */
    public function testGetQuestionsWithTypeKanji(): void
    {
        $repository = $this->createMock(QuizRepository::class);

        $repository->method('getAllIds')
            ->with('kanji')
            ->willReturn([
                ['id' => 1], ['id' => 2], ['id' => 3]
            ]);

        $repository->method('getQuestion')
            ->willReturnCallback(function ($id, $table, $type) {
                return [
                    'signe' => "signe_$id",
                    'romaji' => "romaji_$id",
                ];
            });

        $service = new QuizService($repository);

        $questions = $service->getQuestions('kanji', 2);

        $this->assertCount(2, $questions);
        foreach ($questions as $q) {
            $this->assertArrayHasKey('signe', $q);
            $this->assertArrayHasKey('romaji', $q);
            $this->assertStringStartsWith('signe_', $q['signe']);
        }
    }

    /**
     * @throws Exception
     */
    public function testGetQuestionsReturnsAllIfNotEnoughAvailable(): void
    {
        $repository = $this->createMock(QuizRepository::class);

        $repository->method('getAllIds')
            ->willReturn([
                ['id' => 1], ['id' => 2] // Seulement 2
            ]);

        $repository->method('getQuestion')
            ->willReturn([
                'kanji' => 'a',
                'romaji' => 'a'
            ]);

        $service = new QuizService($repository);

        $questions = $service->getQuestions('mot', 5); // en demande 5

        $this->assertCount(2, $questions); // Doit retourner que ce qu’il peut
    }

    /**
     * @throws Exception
     */
    public function testGetQuestionsReturnsEmptyArrayIfNoData(): void
    {
        $repository = $this->createMock(QuizRepository::class);

        $repository->method('getAllIds')
            ->willReturn([]); // Rien en base

        $service = new QuizService($repository);

        $questions = $service->getQuestions('expression', 3);

        $this->assertIsArray($questions);
        $this->assertEmpty($questions);
    }

}