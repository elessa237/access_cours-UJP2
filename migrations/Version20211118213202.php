<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118213202 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiants CHANGE role roles JSON NOT NULL');
        $this->addSql('ALTER TABLE professeurs CHANGE role roles JSON NOT NULL');
        $this->addSql('ALTER TABLE administration CHANGE role roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administration CHANGE roles role JSON NOT NULL');
        $this->addSql('ALTER TABLE Etudiants CHANGE roles role JSON NOT NULL');
        $this->addSql('ALTER TABLE Professeurs CHANGE roles role JSON NOT NULL');
    }
}
