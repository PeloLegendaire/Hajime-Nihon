<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230831073750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hiragana (id INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kanji (id INT NOT NULL, description VARCHAR(255) NOT NULL, traduction VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE katakana (id INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE signe (id INT AUTO_INCREMENT NOT NULL, signe VARCHAR(2) NOT NULL, romaji VARCHAR(5) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hiragana ADD CONSTRAINT FK_B495E62CBF396750 FOREIGN KEY (id) REFERENCES signe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kanji ADD CONSTRAINT FK_426F9DDCBF396750 FOREIGN KEY (id) REFERENCES signe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE katakana ADD CONSTRAINT FK_957AF30DBF396750 FOREIGN KEY (id) REFERENCES signe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hiragana DROP FOREIGN KEY FK_B495E62CBF396750');
        $this->addSql('ALTER TABLE kanji DROP FOREIGN KEY FK_426F9DDCBF396750');
        $this->addSql('ALTER TABLE katakana DROP FOREIGN KEY FK_957AF30DBF396750');
        $this->addSql('DROP TABLE hiragana');
        $this->addSql('DROP TABLE kanji');
        $this->addSql('DROP TABLE katakana');
        $this->addSql('DROP TABLE signe');
    }
}
