<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923194959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fam (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gedc (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE head (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE indi (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, dummy VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gedcom DROP FOREIGN KEY FK_DA5219DC166D1F9C');
        $this->addSql('ALTER TABLE gedcom DROP FOREIGN KEY FK_DA5219DC727ACA70');
        $this->addSql('DROP TABLE gedcom');
        $this->addSql('ALTER TABLE gedcom_structure DROP FOREIGN KEY FK_7F63A5AA12ABFA1');
        $this->addSql('DROP INDEX tag_idx ON gedcom_structure');
        $this->addSql('DROP INDEX IDX_7F63A5AA12ABFA1 ON gedcom_structure');
        $this->addSql('DROP INDEX xref_idx ON gedcom_structure');
        $this->addSql('ALTER TABLE gedcom_structure ADD parent_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', ADD escape VARCHAR(32) DEFAULT NULL, DROP super_structure_id, DROP line, DROP discr, DROP dummy, CHANGE id id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', CHANGE xref xref VARCHAR(32) DEFAULT NULL');
        $this->addSql('ALTER TABLE gedcom_structure ADD CONSTRAINT FK_7F63A5AA727ACA70 FOREIGN KEY (parent_id) REFERENCES gedcom_structure (id)');
        $this->addSql('CREATE INDEX IDX_7F63A5AA727ACA70 ON gedcom_structure (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gedcom (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', parent_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, tag VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pointer VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, escape VARCHAR(32) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, value LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_DA5219DC166D1F9C (project_id), INDEX IDX_DA5219DC727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE gedcom ADD CONSTRAINT FK_DA5219DC166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE gedcom ADD CONSTRAINT FK_DA5219DC727ACA70 FOREIGN KEY (parent_id) REFERENCES gedcom (id)');
        $this->addSql('DROP TABLE fam');
        $this->addSql('DROP TABLE gedc');
        $this->addSql('DROP TABLE head');
        $this->addSql('DROP TABLE indi');
        $this->addSql('ALTER TABLE gedcom_structure DROP FOREIGN KEY FK_7F63A5AA727ACA70');
        $this->addSql('DROP INDEX IDX_7F63A5AA727ACA70 ON gedcom_structure');
        $this->addSql('ALTER TABLE gedcom_structure ADD super_structure_id INT DEFAULT NULL, ADD line INT DEFAULT NULL, ADD discr VARCHAR(20) NOT NULL, ADD dummy VARCHAR(255) DEFAULT NULL, DROP parent_id, DROP escape, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE xref xref VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE gedcom_structure ADD CONSTRAINT FK_7F63A5AA12ABFA1 FOREIGN KEY (super_structure_id) REFERENCES gedcom_structure (id)');
        $this->addSql('CREATE INDEX tag_idx ON gedcom_structure (tag)');
        $this->addSql('CREATE INDEX IDX_7F63A5AA12ABFA1 ON gedcom_structure (super_structure_id)');
        $this->addSql('CREATE INDEX xref_idx ON gedcom_structure (xref)');
    }
}
