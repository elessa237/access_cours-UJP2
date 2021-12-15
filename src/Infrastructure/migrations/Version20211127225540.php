<?php

declare(strict_types=1);

namespace App\Infrastructure\migrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211127225540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_3C0BA398180AA129');
        $this->addSql('DROP INDEX IDX_3C0BA398180AA129 ON cours');
        $this->addSql('ALTER TABLE cours DROP filiere_id');
        $this->addSql('ALTER TABLE filiere ADD cour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filiere ADD CONSTRAINT FK_2ED05D9EB7942F03 FOREIGN KEY (cour_id) REFERENCES Cours (id)');
        $this->addSql('CREATE INDEX IDX_2ED05D9EB7942F03 ON filiere (cour_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Cours ADD filiere_id INT NOT NULL');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('CREATE INDEX IDX_3C0BA398180AA129 ON Cours (filiere_id)');
        $this->addSql('ALTER TABLE filiere DROP FOREIGN KEY FK_2ED05D9EB7942F03');
        $this->addSql('DROP INDEX IDX_2ED05D9EB7942F03 ON filiere');
        $this->addSql('ALTER TABLE filiere DROP cour_id');
    }
}
