<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618151509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__client AS SELECT id, nom, prenom, date_premiere_saisie, adresse, type_vehicule, plaque_immat, is_actif FROM client');
        $this->addSql('DROP TABLE client');
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, prenom VARCHAR(255) NOT NULL COLLATE BINARY, date_premiere_saisie DATE NOT NULL, adresse VARCHAR(255) NOT NULL COLLATE BINARY, type_vehicule VARCHAR(255) NOT NULL COLLATE BINARY, plaque_immat VARCHAR(255) NOT NULL COLLATE BINARY, is_actif BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO client (id, nom, prenom, date_premiere_saisie, adresse, type_vehicule, plaque_immat, is_actif) SELECT id, nom, prenom, date_premiere_saisie, adresse, type_vehicule, plaque_immat, is_actif FROM __temp__client');
        $this->addSql('DROP TABLE __temp__client');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74404552AA5307A ON client (plaque_immat)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__prestation AS SELECT id, nom, type_prestation, temps_realisation, cout_ht, description, is_active FROM prestation');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('CREATE TABLE prestation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, type_prestation VARCHAR(255) NOT NULL COLLATE BINARY, temps_realisation VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, is_active BOOLEAN DEFAULT NULL, cout_ht INTEGER NOT NULL)');
        $this->addSql('INSERT INTO prestation (id, nom, type_prestation, temps_realisation, cout_ht, description, is_active) SELECT id, nom, type_prestation, temps_realisation, cout_ht, description, is_active FROM __temp__prestation');
        $this->addSql('DROP TABLE __temp__prestation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C74404552AA5307A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__client AS SELECT id, nom, prenom, date_premiere_saisie, adresse, type_vehicule, plaque_immat, is_actif FROM client');
        $this->addSql('DROP TABLE client');
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_premiere_saisie DATE NOT NULL, adresse VARCHAR(255) NOT NULL, type_vehicule VARCHAR(255) NOT NULL, plaque_immat VARCHAR(255) NOT NULL, is_actif BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO client (id, nom, prenom, date_premiere_saisie, adresse, type_vehicule, plaque_immat, is_actif) SELECT id, nom, prenom, date_premiere_saisie, adresse, type_vehicule, plaque_immat, is_actif FROM __temp__client');
        $this->addSql('DROP TABLE __temp__client');
        $this->addSql('CREATE TEMPORARY TABLE __temp__prestation AS SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, is_active FROM prestation');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('CREATE TABLE prestation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, temps_realisation VARCHAR(255) NOT NULL, description CLOB NOT NULL, type_prestation VARCHAR(255) NOT NULL, is_active BOOLEAN DEFAULT NULL, cout_ht VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO prestation (id, nom, temps_realisation, cout_ht, description, type_prestation, is_active) SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, is_active FROM __temp__prestation');
        $this->addSql('DROP TABLE __temp__prestation');
    }
}
