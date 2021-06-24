<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624093147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76A76ED395 ON admin (user_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (login)');
        $this->addSql('ALTER TABLE collaborateur ADD COLUMN is_actif BOOLEAN DEFAULT NULL');
        $this->addSql('CREATE TEMPORARY TABLE __temp__prestation AS SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, is_active FROM prestation');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('CREATE TABLE prestation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, temps_realisation VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, type_prestation VARCHAR(255) NOT NULL COLLATE BINARY, is_active BOOLEAN DEFAULT NULL, cout_ht INTEGER NOT NULL)');
        $this->addSql('INSERT INTO prestation (id, nom, temps_realisation, cout_ht, description, type_prestation, is_active) SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, is_active FROM __temp__prestation');
        $this->addSql('DROP TABLE __temp__prestation');
        $this->addSql('DROP INDEX IDX_65E8AA0A206D1431');
        $this->addSql('DROP INDEX IDX_65E8AA0A4BC2B660');
        $this->addSql('DROP INDEX IDX_65E8AA0A99DED506');
        $this->addSql('CREATE TEMPORARY TABLE __temp__rendez_vous AS SELECT id, id_client_id, id_collaborateur_id, id_prestation_id, date_rendez_vous FROM rendez_vous');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('CREATE TABLE rendez_vous (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_client_id INTEGER NOT NULL, id_collaborateur_id INTEGER NOT NULL, id_prestation_id INTEGER NOT NULL, date_rendez_vous DATETIME NOT NULL, CONSTRAINT FK_65E8AA0A99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_65E8AA0A4BC2B660 FOREIGN KEY (id_collaborateur_id) REFERENCES collaborateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_65E8AA0A206D1431 FOREIGN KEY (id_prestation_id) REFERENCES prestation (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO rendez_vous (id, id_client_id, id_collaborateur_id, id_prestation_id, date_rendez_vous) SELECT id, id_client_id, id_collaborateur_id, id_prestation_id, date_rendez_vous FROM __temp__rendez_vous');
        $this->addSql('DROP TABLE __temp__rendez_vous');
        $this->addSql('CREATE INDEX IDX_65E8AA0A206D1431 ON rendez_vous (id_prestation_id)');
        $this->addSql('CREATE INDEX IDX_65E8AA0A4BC2B660 ON rendez_vous (id_collaborateur_id)');
        $this->addSql('CREATE INDEX IDX_65E8AA0A99DED506 ON rendez_vous (id_client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__collaborateur AS SELECT id, nom, prenom, date_naissance, date_entree_entreprise, num_securite_social, type_contrat, date_heure_derniere_connexion, duree_travail_hebdo, login, mot_de_passe, is_admin FROM collaborateur');
        $this->addSql('DROP TABLE collaborateur');
        $this->addSql('CREATE TABLE collaborateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, date_entree_entreprise DATE NOT NULL, num_securite_social VARCHAR(255) NOT NULL, type_contrat VARCHAR(255) NOT NULL, date_heure_derniere_connexion DATETIME DEFAULT NULL, duree_travail_hebdo VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, is_admin BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO collaborateur (id, nom, prenom, date_naissance, date_entree_entreprise, num_securite_social, type_contrat, date_heure_derniere_connexion, duree_travail_hebdo, login, mot_de_passe, is_admin) SELECT id, nom, prenom, date_naissance, date_entree_entreprise, num_securite_social, type_contrat, date_heure_derniere_connexion, duree_travail_hebdo, login, mot_de_passe, is_admin FROM __temp__collaborateur');
        $this->addSql('DROP TABLE __temp__collaborateur');
        $this->addSql('CREATE TEMPORARY TABLE __temp__prestation AS SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, is_active FROM prestation');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('CREATE TABLE prestation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, temps_realisation VARCHAR(255) NOT NULL, description CLOB NOT NULL, type_prestation VARCHAR(255) NOT NULL, is_active BOOLEAN DEFAULT NULL, cout_ht VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO prestation (id, nom, temps_realisation, cout_ht, description, type_prestation, is_active) SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, is_active FROM __temp__prestation');
        $this->addSql('DROP TABLE __temp__prestation');
        $this->addSql('DROP INDEX IDX_65E8AA0A99DED506');
        $this->addSql('DROP INDEX IDX_65E8AA0A4BC2B660');
        $this->addSql('DROP INDEX IDX_65E8AA0A206D1431');
        $this->addSql('CREATE TEMPORARY TABLE __temp__rendez_vous AS SELECT id, id_client_id, id_collaborateur_id, id_prestation_id, date_rendez_vous FROM rendez_vous');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('CREATE TABLE rendez_vous (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_client_id INTEGER NOT NULL, id_collaborateur_id INTEGER NOT NULL, id_prestation_id INTEGER NOT NULL, date_rendez_vous DATETIME NOT NULL)');
        $this->addSql('INSERT INTO rendez_vous (id, id_client_id, id_collaborateur_id, id_prestation_id, date_rendez_vous) SELECT id, id_client_id, id_collaborateur_id, id_prestation_id, date_rendez_vous FROM __temp__rendez_vous');
        $this->addSql('DROP TABLE __temp__rendez_vous');
        $this->addSql('CREATE INDEX IDX_65E8AA0A99DED506 ON rendez_vous (id_client_id)');
        $this->addSql('CREATE INDEX IDX_65E8AA0A4BC2B660 ON rendez_vous (id_collaborateur_id)');
        $this->addSql('CREATE INDEX IDX_65E8AA0A206D1431 ON rendez_vous (id_prestation_id)');
    }
}
