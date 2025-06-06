<?php

namespace App\DataFixtures;

use App\Entity\Kanji;
use App\Entity\Lexique;
use App\Entity\Quiz;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $user->setUsername('test');
        $user->setEmail('test@test.test');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->userPasswordHasher->hashPassword(
            $user,
            'Azerty123!'
        ));
        $manager->persist($user);

        // kanji
        $kanji1 = new Kanji();
        $kanji1->setSigne('日');
        $kanji1->setDescription('Soleil/Jour');
        $kanji1->setOnyomi(['二チ', 'ジツ']);
        $kanji1->setKunyomi(['か', 'ひ']);
        $manager->persist($kanji1);

        $kanji2 = new Kanji();
        $kanji2->setSigne('月');
        $kanji2->setDescription('Lune/Mois');
        $kanji2->setOnyomi(['ゲツ', 'ガツ']);
        $kanji2->setKunyomi(['つき']);
        $manager->persist($kanji2);

        $kanji3 = new Kanji();
        $kanji3->setSigne('水');
        $kanji3->setDescription('Eau');
        $kanji3->setOnyomi(['スイ']);
        $kanji3->setKunyomi(['みず']);
        $manager->persist($kanji3);

        $kanji4 = new Kanji();
        $kanji4->setSigne('木');
        $kanji4->setDescription('Arbre');
        $kanji4->setOnyomi(['ボク', 'モク']);
        $kanji4->setKunyomi(['き', 'こ-']);
        $manager->persist($kanji4);

        $kanji5 = new Kanji();
        $kanji5->setSigne('土');
        $kanji5->setDescription('Terre/Sol');
        $kanji5->setOnyomi(['ド', 'ト']);
        $kanji5->setKunyomi(['つち']);
        $manager->persist($kanji5);

        // mot
        $mot1 = new Lexique();
        $mot1->setType('mot');
        $mot1->setKanji('はい');
        $mot1->setTraduction('Oui');
        $manager->persist($mot1);

        $mot2 = new Lexique();
        $mot2->setType('mot');
        $mot2->setKanji('いいえ');
        $mot2->setTraduction('Non');
        $manager->persist($mot2);

        $mot3 = new Lexique();
        $mot3->setType('mot');
        $mot3->setKanji('うれしい');
        $mot3->setTraduction('Content');
        $manager->persist($mot3);

        $mot4 = new Lexique();
        $mot4->setType('mot');
        $mot4->setKanji('子供');
        $mot4->setTraduction('Enfant');
        $manager->persist($mot4);

        $mot5 = new Lexique();
        $mot5->setType('mot');
        $mot5->setKanji('ここ');
        $mot5->setTraduction('Ici');
        $manager->persist($mot5);

        // expression
        $expression1 = new Lexique();
        $expression1->setType('expression');
        $expression1->setKanji('おはようございます');
        $expression1->setTraduction('Bonjour');
        $manager->persist($expression1);

        $expression2 = new Lexique();
        $expression2->setType('expression');
        $expression2->setKanji('ありがとうございます');
        $expression2->setTraduction('Merci');
        $manager->persist($expression2);

        $expression3 = new Lexique();
        $expression3->setType('expression');
        $expression3->setKanji('おねがいします');
        $expression3->setTraduction('S\'il vous plait');
        $manager->persist($expression3);

        $expression4 = new Lexique();
        $expression4->setType('expression');
        $expression4->setKanji('またね');
        $expression4->setTraduction('À bientôt');
        $manager->persist($expression4);

        // quizzes
        $quiz1 = new Quiz();
        $quiz1->setType('hiragana');
        $quiz1->setLibelle('Quiz Hiragana 1');
        $quiz1->setNombreQuestion(10);
        $manager->persist($quiz1);

        $quiz2 = new Quiz();
        $quiz2->setType('katakana');
        $quiz2->setLibelle('Quiz Katakana 1');
        $quiz2->setNombreQuestion(10);
        $manager->persist($quiz2);

        $manager->flush();
    }
}
