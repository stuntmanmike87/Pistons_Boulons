<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629134404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_880E0D76A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__admin AS SELECT id, user_id, nom, prenom FROM admin');
        $this->addSql('DROP TABLE admin');
        $this->addSql('CREATE TABLE admin (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, prenom VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_880E0D76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO admin (id, user_id, nom, prenom) SELECT id, user_id, nom, prenom FROM __temp__admin');
        $this->addSql('DROP TABLE __temp__admin');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76A76ED395 ON admin (user_id)');
        $this->addSql('DROP INDEX UNIQ_770CBCD3A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__collaborateur AS SELECT id, user_id, nom, prenom, date_naissance, date_entree_entreprise, num_securite_social, type_contrat, date_heure_derniere_connexion, duree_travail_hebdo, is_actif FROM collaborateur');
        $this->addSql('DROP TABLE collaborateur');
        $this->addSql('CREATE TABLE collaborateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, prenom VARCHAR(255) NOT NULL COLLATE BINARY, date_naissance DATE NOT NULL, date_entree_entreprise DATE NOT NULL, num_securite_social VARCHAR(255) NOT NULL COLLATE BINARY, type_contrat VARCHAR(255) NOT NULL COLLATE BINARY, date_heure_derniere_connexion DATETIME DEFAULT NULL, duree_travail_hebdo VARCHAR(255) NOT NULL COLLATE BINARY, is_actif BOOLEAN DEFAULT NULL, CONSTRAINT FK_770CBCD3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO collaborateur (id, user_id, nom, prenom, date_naissance, date_entree_entreprise, num_securite_social, type_contrat, date_heure_derniere_connexion, duree_travail_hebdo, is_actif) SELECT id, user_id, nom, prenom, date_naissance, date_entree_entreprise, num_securite_social, type_contrat, date_heure_derniere_connexion, duree_travail_hebdo, is_actif FROM __temp__collaborateur');
        $this->addSql('DROP TABLE __temp__collaborateur');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_770CBCD3A76ED395 ON collaborateur (user_id)');
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
        $this->addSql('DROP INDEX UNIQ_8D93D649642B8210');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10');
        $this->addSql('DROP INDEX UNIQ_8D93D649A848E3B1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, collaborateur_id, admin_id, login, password, roles FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, collaborateur_id INTEGER DEFAULT NULL, admin_id INTEGER DEFAULT NULL, login VARCHAR(180) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:array)
        , CONSTRAINT FK_8D93D649642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D649A848E3B1 FOREIGN KEY (collaborateur_id) REFERENCES collaborateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, collaborateur_id, admin_id, login, password, roles) SELECT id, collaborateur_id, admin_id, login, password, roles FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649642B8210 ON user (admin_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (login)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A848E3B1 ON user (collaborateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_880E0D76A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__admin AS SELECT id, user_id, nom, prenom FROM admin');
        $this->addSql('DROP TABLE admin');
        $this->addSql('CREATE TABLE admin (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO admin (id, user_id, nom, prenom) SELECT id, user_id, nom, prenom FROM __temp__admin');
        $this->addSql('DROP TABLE __temp__admin');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76A76ED395 ON admin (user_id)');
        $this->addSql('DROP INDEX UNIQ_770CBCD3A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__collaborateur AS SELECT id, user_id, nom, prenom, date_naissance, date_entree_entreprise, num_securite_social, type_contrat, date_heure_derniere_connexion, duree_travail_hebdo, is_actif FROM collaborateur');
        $this->addSql('DROP TABLE collaborateur');
        $this->addSql('CREATE TABLE collaborateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, date_entree_entreprise DATE NOT NULL, num_securite_social VARCHAR(255) NOT NULL, type_contrat VARCHAR(255) NOT NULL, date_heure_derniere_connexion DATETIME DEFAULT NULL, duree_travail_hebdo VARCHAR(255) NOT NULL, is_actif BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO collaborateur (id, user_id, nom, prenom, date_naissance, date_entree_entreprise, num_securite_social, type_contrat, date_heure_derniere_connexion, duree_travail_hebdo, is_actif) SELECT id, user_id, nom, prenom, date_naissance, date_entree_entreprise, num_securite_social, type_contrat, date_heure_derniere_connexion, duree_travail_hebdo, is_actif FROM __temp__collaborateur');
        $this->addSql('DROP TABLE __temp__collaborateur');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_770CBCD3A76ED395 ON collaborateur (user_id)');
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
        $this->addSql('DROP INDEX UNIQ_8D93D649AA08CB10');
        $this->addSql('DROP INDEX UNIQ_8D93D649642B8210');
        $this->addSql('DROP INDEX UNIQ_8D93D649A848E3B1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, admin_id, collaborateur_id, login, roles, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, admin_id INTEGER DEFAULT NULL, collaborateur_id INTEGER DEFAULT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:array)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, admin_id, collaborateur_id, login, roles, password) SELECT id, admin_id, collaborateur_id, login, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA08CB10 ON user (login)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649642B8210 ON user (admin_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A848E3B1 ON user (collaborateur_id)');
    }
}
