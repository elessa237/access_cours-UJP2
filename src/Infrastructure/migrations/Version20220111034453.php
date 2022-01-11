<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220111034453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Cours (id INT AUTO_INCREMENT NOT NULL, professeur_id INT NOT NULL, niveau_id INT NOT NULL, ue_id INT NOT NULL, nom VARCHAR(255) NOT NULL, nom_cour VARCHAR(255) NOT NULL, taille_cour INT NOT NULL, published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3C0BA398BAB22EE9 (professeur_id), INDEX IDX_3C0BA398B3E9C81 (niveau_id), INDEX IDX_3C0BA39862E883B1 (ue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cour_filiere (cour_id INT NOT NULL, filiere_id INT NOT NULL, INDEX IDX_16BADC6CB7942F03 (cour_id), INDEX IDX_16BADC6C180AA129 (filiere_id), PRIMARY KEY(cour_id, filiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Unite_enseignement (id INT AUTO_INCREMENT NOT NULL, niveau_id INT NOT NULL, nom_UE VARCHAR(255) NOT NULL, INDEX IDX_1B96C47FB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ue_filiere (ue_id INT NOT NULL, filiere_id INT NOT NULL, INDEX IDX_DAA481CB62E883B1 (ue_id), INDEX IDX_DAA481CB180AA129 (filiere_id), PRIMARY KEY(ue_id, filiere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Utilisateurs (id INT AUTO_INCREMENT NOT NULL, filiere_id INT DEFAULT NULL, niveau_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, numero_telephone VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, numero_cni VARCHAR(255) DEFAULT NULL, poste VARCHAR(255) DEFAULT NULL, registration_token VARCHAR(255) DEFAULT NULL, reset_password_token VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, INDEX IDX_514AEAA6180AA129 (filiere_id), INDEX IDX_514AEAA6B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_ue (utilisateur_id INT NOT NULL, ue_id INT NOT NULL, INDEX IDX_6AF88C84FB88E14F (utilisateur_id), INDEX IDX_6AF88C8462E883B1 (ue_id), PRIMARY KEY(utilisateur_id, ue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, alias VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, alias VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES Utilisateurs (id)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA398B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE Cours ADD CONSTRAINT FK_3C0BA39862E883B1 FOREIGN KEY (ue_id) REFERENCES Unite_enseignement (id)');
        $this->addSql('ALTER TABLE cour_filiere ADD CONSTRAINT FK_16BADC6CB7942F03 FOREIGN KEY (cour_id) REFERENCES Cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cour_filiere ADD CONSTRAINT FK_16BADC6C180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Unite_enseignement ADD CONSTRAINT FK_1B96C47FB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE ue_filiere ADD CONSTRAINT FK_DAA481CB62E883B1 FOREIGN KEY (ue_id) REFERENCES Unite_enseignement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ue_filiere ADD CONSTRAINT FK_DAA481CB180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Utilisateurs ADD CONSTRAINT FK_514AEAA6180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE Utilisateurs ADD CONSTRAINT FK_514AEAA6B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE utilisateur_ue ADD CONSTRAINT FK_6AF88C84FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_ue ADD CONSTRAINT FK_6AF88C8462E883B1 FOREIGN KEY (ue_id) REFERENCES Unite_enseignement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cour_filiere DROP FOREIGN KEY FK_16BADC6CB7942F03');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA39862E883B1');
        $this->addSql('ALTER TABLE ue_filiere DROP FOREIGN KEY FK_DAA481CB62E883B1');
        $this->addSql('ALTER TABLE utilisateur_ue DROP FOREIGN KEY FK_6AF88C8462E883B1');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398BAB22EE9');
        $this->addSql('ALTER TABLE utilisateur_ue DROP FOREIGN KEY FK_6AF88C84FB88E14F');
        $this->addSql('ALTER TABLE cour_filiere DROP FOREIGN KEY FK_16BADC6C180AA129');
        $this->addSql('ALTER TABLE ue_filiere DROP FOREIGN KEY FK_DAA481CB180AA129');
        $this->addSql('ALTER TABLE Utilisateurs DROP FOREIGN KEY FK_514AEAA6180AA129');
        $this->addSql('ALTER TABLE Cours DROP FOREIGN KEY FK_3C0BA398B3E9C81');
        $this->addSql('ALTER TABLE Unite_enseignement DROP FOREIGN KEY FK_1B96C47FB3E9C81');
        $this->addSql('ALTER TABLE Utilisateurs DROP FOREIGN KEY FK_514AEAA6B3E9C81');
        $this->addSql('DROP TABLE Cours');
        $this->addSql('DROP TABLE cour_filiere');
        $this->addSql('DROP TABLE Unite_enseignement');
        $this->addSql('DROP TABLE ue_filiere');
        $this->addSql('DROP TABLE Utilisateurs');
        $this->addSql('DROP TABLE utilisateur_ue');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE niveau');
    }
}
