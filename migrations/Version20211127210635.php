<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211127210635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filiere ADD unite_enseign_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filiere ADD CONSTRAINT FK_2ED05D9EFB9625A3 FOREIGN KEY (unite_enseign_id) REFERENCES Unite_enseignement (id)');
        $this->addSql('CREATE INDEX IDX_2ED05D9EFB9625A3 ON filiere (unite_enseign_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filiere DROP FOREIGN KEY FK_2ED05D9EFB9625A3');
        $this->addSql('DROP INDEX IDX_2ED05D9EFB9625A3 ON filiere');
        $this->addSql('ALTER TABLE filiere DROP unite_enseign_id');
    }
}
