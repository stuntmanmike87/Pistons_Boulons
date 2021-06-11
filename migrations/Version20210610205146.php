<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210610205146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__content AS SELECT id, texte, localisation FROM content');
        $this->addSql('DROP TABLE content');
        $this->addSql('CREATE TABLE content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, text CLOB NOT NULL, position VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO content (id, text, position) SELECT id, texte, localisation FROM __temp__content');
        $this->addSql('DROP TABLE __temp__content');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__content AS SELECT id, text, position FROM content');
        $this->addSql('DROP TABLE content');
        $this->addSql('CREATE TABLE content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, texte CLOB NOT NULL COLLATE BINARY, localisation VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO content (id, texte, localisation) SELECT id, text, position FROM __temp__content');
        $this->addSql('DROP TABLE __temp__content');
    }
}
