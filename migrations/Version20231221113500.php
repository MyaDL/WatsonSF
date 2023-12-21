<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221113500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__link AS SELECT id, titre, url, description, state FROM link');
        $this->addSql('DROP TABLE link');
        $this->addSql('CREATE TABLE link (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, description CLOB NOT NULL, state BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO link (id, title, url, description, state) SELECT id, titre, url, description, state FROM __temp__link');
        $this->addSql('DROP TABLE __temp__link');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__link AS SELECT id, title, url, description, state FROM link');
        $this->addSql('DROP TABLE link');
        $this->addSql('CREATE TABLE link (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, description CLOB NOT NULL, state BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO link (id, titre, url, description, state) SELECT id, title, url, description, state FROM __temp__link');
        $this->addSql('DROP TABLE __temp__link');
    }
}
