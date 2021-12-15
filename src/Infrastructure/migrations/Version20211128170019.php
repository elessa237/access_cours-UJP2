<?php

declare(strict_types=1);

namespace App\Infrastructure\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211128170019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ue_filiere (ue_id INT NOT NULL, filiere_id INT NOT NULL, INDEX IDX_DAA481CB62E883B1 (ue_id), INDEX IDX_DAA481CB180AA129 (filiere_id), PRIMARY KEY(ue_id, filiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ue_filiere ADD CONSTRAINT FK_DAA481CB62E883B1 FOREIGN KEY (ue_id) REFERENCES Unite_enseignement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_filiere ADD CONSTRAINT FK_DAA481CB180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filiere DROP FOREIGN KEY FK_2ED05D9EFB9625A3');
        $this->addSql('DROP INDEX IDX_2ED05D9EFB9625A3 ON filiere');
        $this->addSql('ALTER TABLE filiere DROP unite_enseign_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ue_filiere');
        $this->addSql('ALTER TABLE filiere ADD unite_enseign_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filiere ADD CONSTRAINT FK_2ED05D9EFB9625A3 FOREIGN KEY (unite_enseign_id) REFERENCES unite_enseignement (id)');
        $this->addSql('CREATE INDEX IDX_2ED05D9EFB9625A3 ON filiere (unite_enseign_id)');
    }
}
