<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131152831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE counter (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, counter_of_clients INTEGER DEFAULT NULL, counter_of_sites INTEGER DEFAULT NULL, counter_of_years_work INTEGER DEFAULT NULL, counter_of_years INTEGER DEFAULT NULL, counter_of_win INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE projects (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, url_git VARCHAR(255) DEFAULT NULL, url_web VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL, updated_at DATE DEFAULT NULL, file VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE projects_tags (projects_id INTEGER NOT NULL, tags_id INTEGER NOT NULL, PRIMARY KEY(projects_id, tags_id))');
        $this->addSql('CREATE INDEX IDX_51A228EE1EDE0F55 ON projects_tags (projects_id)');
        $this->addSql('CREATE INDEX IDX_51A228EE8D7B4FB4 ON projects_tags (tags_id)');
        $this->addSql('CREATE TABLE tags (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE counter');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE projects_tags');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE user');
    }
}
