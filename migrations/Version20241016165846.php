<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241016165846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT NOT NULL, all_day TINYINT(1) NOT NULL, background_color VARCHAR(7) NOT NULL, border_color VARCHAR(7) NOT NULL, text_color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_premiere_saisie DATE NOT NULL, adresse VARCHAR(255) NOT NULL, type_vehicule VARCHAR(255) NOT NULL, plaque_immat VARCHAR(255) NOT NULL, is_actif TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE collaborateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, date_entree_entreprise DATE NOT NULL, num_securite_social VARCHAR(255) NOT NULL, type_contrat VARCHAR(255) NOT NULL, date_heure_derniere_connexion DATETIME DEFAULT NULL, duree_travail_hebdo VARCHAR(255) NOT NULL, is_actif TINYINT(1) DEFAULT NULL, user_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_770CBCD3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT NOT NULL, position VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, temps_realisation VARCHAR(255) NOT NULL, cout_ht INT NOT NULL, description LONGTEXT NOT NULL, type_prestation VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, date_rendez_vous DATETIME NOT NULL, id_client_id INT NOT NULL, id_collaborateur_id INT NOT NULL, id_prestation_id INT NOT NULL, INDEX IDX_65E8AA0A99DED506 (id_client_id), INDEX IDX_65E8AA0A4BC2B660 (id_collaborateur_id), INDEX IDX_65E8AA0A206D1431 (id_prestation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE collaborateur ADD CONSTRAINT FK_770CBCD3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A4BC2B660 FOREIGN KEY (id_collaborateur_id) REFERENCES collaborateur (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0A206D1431 FOREIGN KEY (id_prestation_id) REFERENCES prestation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collaborateur DROP FOREIGN KEY FK_770CBCD3A76ED395');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A99DED506');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A4BC2B660');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0A206D1431');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE collaborateur');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE user');
    }
}
