<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211122165009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Cours (id INT AUTO_INCREMENT NOT NULL, professeur_id INT NOT NULL, filiere_id INT NOT NULL, niveau_id INT NOT NULL, ue_id INT NOT NULL, nom VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3C0BA398BAB22EE9 (professeur_id), INDEX IDX_3C0BA398180AA129 (filiere_id), INDEX IDX_3C0BA398B3E9C81 (niveau_id), INDEX IDX_3C0BA39862E883B1 (ue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Unite_enseignement (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, nom_UE VARCHAR(255) NOT NULL, INDEX IDX_1B96C47FB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, alias VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, alias VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, filiere_id INT DEFAULT NULL, niveau_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero_telephone VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, numero_cni VARCHAR(255) NOT NULL, poste VARCHAR(255) DEFAULT NULL, INDEX IDX_1D1C63B3180AA129 (filiere_id), INDEX IDX_1D1C63B3B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_ue (utilisateur_id INT NOT NULL, ue_id INT NOT NULL, INDEX IDX_6AF88C84FB88E14F (utilisateur_id), INDEX IDX_6AF88C8462E883B1 (ue_id), PRIMARY KEY(utilisateur_id, ue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA39862E883B1 FOREIGN KEY (ue_id) REFERENCES Unite_enseignement (id)');
        $this->addSql('ALTER TABLE Unite_enseignement ADD CONSTRAINT FK_1B96C47FB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE utilisateur_ue ADD CONSTRAINT FK_6AF88C84FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_ue ADD CONSTRAINT FK_6AF88C8462E883B1 FOREIGN KEY (ue_id) REFERENCES Unite_enseignement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA39862E883B1');
        $this->addSql('ALTER TABLE utilisateur_ue DROP FOREIGN KEY FK_6AF88C8462E883B1');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398180AA129');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3180AA129');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398B3E9C81');
        $this->addSql('ALTER TABLE Unite_enseignement DROP FOREIGN KEY FK_1B96C47FB3E9C81');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3B3E9C81');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398BAB22EE9');
        $this->addSql('ALTER TABLE utilisateur_ue DROP FOREIGN KEY FK_6AF88C84FB88E14F');
        $this->addSql('DROP TABLE Cours');
        $this->addSql('DROP TABLE Unite_enseignement');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_ue');
    }
}
