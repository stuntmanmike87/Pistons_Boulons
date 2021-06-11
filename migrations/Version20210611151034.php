<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611151034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__prestation AS SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, est_active FROM prestation');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('CREATE TABLE prestation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, type_prestation VARCHAR(255) NOT NULL COLLATE BINARY, is_active BOOLEAN NOT NULL, temps_realisation VARCHAR(255) NOT NULL, cout_ht VARCHAR(255) NOT NULL, description CLOB NOT NULL)');
        $this->addSql('INSERT INTO prestation (id, nom, temps_realisation, cout_ht, description, type_prestation, is_active) SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, est_active FROM __temp__prestation');
        $this->addSql('DROP TABLE __temp__prestation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__prestation AS SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, is_active FROM prestation');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('CREATE TABLE prestation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type_prestation VARCHAR(255) NOT NULL, est_active BOOLEAN NOT NULL, temps_realisation INTEGER NOT NULL, cout_ht DOUBLE PRECISION NOT NULL, description CLOB DEFAULT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO prestation (id, nom, temps_realisation, cout_ht, description, type_prestation, est_active) SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, is_active FROM __temp__prestation');
        $this->addSql('DROP TABLE __temp__prestation');
    }
}
