<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211128143511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cour_filiere (cour_id INT NOT NULL, filiere_id INT NOT NULL, INDEX IDX_16BADC6CB7942F03 (cour_id), INDEX IDX_16BADC6C180AA129 (filiere_id), PRIMARY KEY(cour_id, filiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cour_filiere ADD CONSTRAINT FK_16BADC6CB7942F03 FOREIGN KEY (cour_id) REFERENCES Cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cour_filiere ADD CONSTRAINT FK_16BADC6C180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filiere DROP FOREIGN KEY FK_2ED05D9EB7942F03');
        $this->addSql('DROP INDEX IDX_2ED05D9EB7942F03 ON filiere');
        $this->addSql('ALTER TABLE filiere DROP cour_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cour_filiere');
        $this->addSql('ALTER TABLE filiere ADD cour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filiere ADD CONSTRAINT FK_2ED05D9EB7942F03 FOREIGN KEY (cour_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_2ED05D9EB7942F03 ON filiere (cour_id)');
    }
}
