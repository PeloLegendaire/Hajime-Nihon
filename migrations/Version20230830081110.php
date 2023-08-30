<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230830081110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hiragana CHANGE signe signe VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE kanji CHANGE signe signe VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE katakana CHANGE signe signe VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE signe CHANGE signe signe VARCHAR(2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hiragana CHANGE signe signe VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE kanji CHANGE signe signe VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE katakana CHANGE signe signe VARCHAR(1) NOT NULL');
        $this->addSql('ALTER TABLE signe CHANGE signe signe VARCHAR(1) NOT NULL');
    }
}
