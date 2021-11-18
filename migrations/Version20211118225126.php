<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118225126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Cours (id INT AUTO_INCREMENT NOT NULL, professeur_id INT NOT NULL, filiere_id INT NOT NULL, niveau_id INT NOT NULL, ue_id INT NOT NULL, nom VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3C0BA398BAB22EE9 (professeur_id), INDEX IDX_3C0BA398180AA129 (filiere_id), INDEX IDX_3C0BA398B3E9C81 (niveau_id), INDEX IDX_3C0BA39862E883B1 (ue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Etudiants (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, niveau_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero_telephone VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A08D8048180AA129 (filiere_id), INDEX IDX_A08D8048B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Professeurs (id INT AUTO_INCREMENT NOT NULL, numero_cni VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero_telephone VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Unite_enseignement (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, nom_UE VARCHAR(255) NOT NULL, INDEX IDX_1B96C47FB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE administration (id INT AUTO_INCREMENT NOT NULL, poste VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero_telephone VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, alias VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, alias VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES Professeurs (id)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA39862E883B1 FOREIGN KEY (ue_id) REFERENCES Unite_enseignement (id)');
        $this->addSql('ALTER TABLE Etudiants ADD CONSTRAINT FK_A08D8048180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE Etudiants ADD CONSTRAINT FK_A08D8048B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE Unite_enseignement ADD CONSTRAINT FK_1B96C47FB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398BAB22EE9');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA39862E883B1');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398180AA129');
        $this->addSql('ALTER TABLE Etudiants DROP FOREIGN KEY FK_A08D8048180AA129');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398B3E9C81');
        $this->addSql('ALTER TABLE Etudiants DROP FOREIGN KEY FK_A08D8048B3E9C81');
        $this->addSql('ALTER TABLE Unite_enseignement DROP FOREIGN KEY FK_1B96C47FB3E9C81');
        $this->addSql('DROP TABLE Cours');
        $this->addSql('DROP TABLE Etudiants');
        $this->addSql('DROP TABLE Professeurs');
        $this->addSql('DROP TABLE Unite_enseignement');
        $this->addSql('DROP TABLE administration');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE niveau');
    }
}
