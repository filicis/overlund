<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923185830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gedcom (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', parent_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, INDEX IDX_DA5219DC727ACA70 (parent_id), UNIQUE INDEX UNIQ_DA5219DC166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gedcom ADD CONSTRAINT FK_DA5219DC727ACA70 FOREIGN KEY (parent_id) REFERENCES gedcom (id)');
        $this->addSql('ALTER TABLE gedcom ADD CONSTRAINT FK_DA5219DC166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gedcom DROP FOREIGN KEY FK_DA5219DC727ACA70');
        $this->addSql('ALTER TABLE gedcom DROP FOREIGN KEY FK_DA5219DC166D1F9C');
        $this->addSql('DROP TABLE gedcom');
    }
}
