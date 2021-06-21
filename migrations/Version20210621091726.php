<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210621091726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rendez_vous (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_client_id INTEGER NOT NULL, id_collaborateur_id INTEGER NOT NULL, id_prestation_id INTEGER NOT NULL, date_rendez_vous DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_65E8AA0A99DED506 ON rendez_vous (id_client_id)');
        $this->addSql('CREATE INDEX IDX_65E8AA0A4BC2B660 ON rendez_vous (id_collaborateur_id)');
        $this->addSql('CREATE INDEX IDX_65E8AA0A206D1431 ON rendez_vous (id_prestation_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__prestation AS SELECT id, nom, type_prestation, temps_realisation, cout_ht, description, is_active FROM prestation');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('CREATE TABLE prestation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, type_prestation VARCHAR(255) NOT NULL COLLATE BINARY, temps_realisation VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, is_active BOOLEAN DEFAULT NULL, cout_ht INTEGER NOT NULL)');
        $this->addSql('INSERT INTO prestation (id, nom, type_prestation, temps_realisation, cout_ht, description, is_active) SELECT id, nom, type_prestation, temps_realisation, cout_ht, description, is_active FROM __temp__prestation');
        $this->addSql('DROP TABLE __temp__prestation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('CREATE TEMPORARY TABLE __temp__prestation AS SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, is_active FROM prestation');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('CREATE TABLE prestation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, temps_realisation VARCHAR(255) NOT NULL, description CLOB NOT NULL, type_prestation VARCHAR(255) NOT NULL, is_active BOOLEAN DEFAULT NULL, cout_ht VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO prestation (id, nom, temps_realisation, cout_ht, description, type_prestation, is_active) SELECT id, nom, temps_realisation, cout_ht, description, type_prestation, is_active FROM __temp__prestation');
        $this->addSql('DROP TABLE __temp__prestation');
    }
}
