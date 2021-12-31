<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211230215834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gedcom_structure (id INT AUTO_INCREMENT NOT NULL, super_structure_id INT DEFAULT NULL, project_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', line INT DEFAULT NULL, level INT NOT NULL, xref VARCHAR(20) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, value VARCHAR(255) NOT NULL, discr VARCHAR(20) NOT NULL, INDEX IDX_7F63A5AA12ABFA1 (super_structure_id), INDEX IDX_7F63A5AA166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gedcom_structure ADD CONSTRAINT FK_7F63A5AA12ABFA1 FOREIGN KEY (super_structure_id) REFERENCES gedcom_structure (id)');
        $this->addSql('ALTER TABLE gedcom_structure ADD CONSTRAINT FK_7F63A5AA166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('DROP TABLE dummy');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gedcom_structure DROP FOREIGN KEY FK_7F63A5AA12ABFA1');
        $this->addSql('CREATE TABLE dummy (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE gedcom_structure');
    }
}
