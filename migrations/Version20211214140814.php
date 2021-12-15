<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211214140814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE name_structure (id INT AUTO_INCREMENT NOT NULL, individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', personal_name VARCHAR(255) DEFAULT NULL, INDEX IDX_13F109A8AE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE submitter_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL COMMENT \'Friendly Identifier\', addr LONGTEXT DEFAULT NULL, adr1 VARCHAR(60) DEFAULT NULL, adr2 VARCHAR(60) DEFAULT NULL, adr3 VARCHAR(60) DEFAULT NULL, city VARCHAR(60) DEFAULT NULL, stae VARCHAR(60) DEFAULT NULL, post VARCHAR(20) DEFAULT NULL, ctry VARCHAR(60) DEFAULT NULL, phon LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', email LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', fax LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', www LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_8EA7E5D166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE name_structure ADD CONSTRAINT FK_13F109A8AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id)');
        $this->addSql('ALTER TABLE submitter_record ADD CONSTRAINT FK_8EA7E5D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE family ADD rin VARCHAR(12) DEFAULT NULL, ADD last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD crea VARCHAR(20) DEFAULT NULL, ADD xref VARCHAR(20) DEFAULT NULL COMMENT \'Friendly Identifier\'');
        $this->addSql('ALTER TABLE individual ADD rin VARCHAR(12) DEFAULT NULL, ADD last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD crea VARCHAR(20) DEFAULT NULL, ADD xref VARCHAR(20) DEFAULT NULL COMMENT \'Friendly Identifier\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE name_structure');
        $this->addSql('DROP TABLE submitter_record');
        $this->addSql('ALTER TABLE family DROP rin, DROP last_change, DROP crea, DROP xref');
        $this->addSql('ALTER TABLE individual DROP rin, DROP last_change, DROP crea, DROP xref');
    }
}
