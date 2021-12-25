<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225153103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_structure (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', place_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, agency VARCHAR(80) NOT NULL, religion VARCHAR(80) NOT NULL, cause VARCHAR(80) NOT NULL, tag VARCHAR(22) NOT NULL, text VARCHAR(80) DEFAULT NULL, INDEX IDX_E99409D7DA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE family (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, INDEX IDX_A5E6215B166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gedcom_structure (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', super_structure_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', line INT DEFAULT NULL, level INT NOT NULL, xref VARCHAR(20) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, value VARCHAR(255) NOT NULL, discr VARCHAR(20) NOT NULL, INDEX IDX_7F63A5AA12ABFA1 (super_structure_id), INDEX IDX_7F63A5AA166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE identifier_structure (id INT AUTO_INCREMENT NOT NULL, record_links_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', tag VARCHAR(20) NOT NULL, value VARCHAR(80) NOT NULL, type VARCHAR(80) NOT NULL, INDEX IDX_7EB3A005EEDD8A0C (record_links_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE individual (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, INDEX IDX_8793FC17166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_link (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', media_record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(80) DEFAULT NULL, crop VARCHAR(80) DEFAULT NULL, INDEX IDX_F5EB4622689DC682 (media_record_id), INDEX IDX_F5EB46224DFD750C (record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, INDEX IDX_274D054F166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, note LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personal_name_structure (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, personal_name VARCHAR(255) DEFAULT NULL, npfx VARCHAR(80) DEFAULT NULL, givn VARCHAR(80) DEFAULT NULL, nick VARCHAR(80) DEFAULT NULL, spfx VARCHAR(80) DEFAULT NULL, surn VARCHAR(80) DEFAULT NULL, nsfx VARCHAR(80) DEFAULT NULL, INDEX IDX_7549DFC7AE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, place VARCHAR(255) NOT NULL, latitude VARCHAR(30) DEFAULT NULL, longitude VARCHAR(30) DEFAULT NULL, INDEX IDX_39FA98F8166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(80) NOT NULL, url VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_2FB3D0EEF47645AE (url), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE record_identifier_structure (record_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', identifier_structure_id INT NOT NULL, INDEX IDX_73E630C24DFD750C (record_id), INDEX IDX_73E630C29CE5597A (identifier_structure_id), PRIMARY KEY(record_id, identifier_structure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE record_note_record (record_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', note_record_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', INDEX IDX_49164FFB4DFD750C (record_id), INDEX IDX_49164FFB5A5A9093 (note_record_id), PRIMARY KEY(record_id, note_record_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repository_record (id INT AUTO_INCREMENT NOT NULL, repo VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source_citation (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', source_record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', page VARCHAR(80) DEFAULT NULL, quality VARCHAR(80) DEFAULT NULL, INDEX IDX_B99DAAAC2563E6C2 (source_record_id), INDEX IDX_B99DAAAC4DFD750C (record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, source VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE submitter_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, addr LONGTEXT DEFAULT NULL, adr1 VARCHAR(60) DEFAULT NULL, adr2 VARCHAR(60) DEFAULT NULL, adr3 VARCHAR(60) DEFAULT NULL, city VARCHAR(60) DEFAULT NULL, stae VARCHAR(60) DEFAULT NULL, post VARCHAR(20) DEFAULT NULL, ctry VARCHAR(60) DEFAULT NULL, phon LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', email LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', fax LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', www LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_8EA7E5D166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, parameter1 VARCHAR(80) NOT NULL, parameter2 INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_structure ADD CONSTRAINT FK_E99409D7DA6A219 FOREIGN KEY (place_id) REFERENCES place_record (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE gedcom_structure ADD CONSTRAINT FK_7F63A5AA12ABFA1 FOREIGN KEY (super_structure_id) REFERENCES gedcom_structure (id)');
        $this->addSql('ALTER TABLE gedcom_structure ADD CONSTRAINT FK_7F63A5AA166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE identifier_structure ADD CONSTRAINT FK_7EB3A005EEDD8A0C FOREIGN KEY (record_links_id) REFERENCES record (id)');
        $this->addSql('ALTER TABLE individual ADD CONSTRAINT FK_8793FC17166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE media_link ADD CONSTRAINT FK_F5EB4622689DC682 FOREIGN KEY (media_record_id) REFERENCES media_record (id)');
        $this->addSql('ALTER TABLE media_link ADD CONSTRAINT FK_F5EB46224DFD750C FOREIGN KEY (record_id) REFERENCES record (id)');
        $this->addSql('ALTER TABLE media_record ADD CONSTRAINT FK_274D054F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE personal_name_structure ADD CONSTRAINT FK_7549DFC7AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id)');
        $this->addSql('ALTER TABLE place_record ADD CONSTRAINT FK_39FA98F8166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE record_identifier_structure ADD CONSTRAINT FK_73E630C24DFD750C FOREIGN KEY (record_id) REFERENCES record (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE record_identifier_structure ADD CONSTRAINT FK_73E630C29CE5597A FOREIGN KEY (identifier_structure_id) REFERENCES identifier_structure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE record_note_record ADD CONSTRAINT FK_49164FFB4DFD750C FOREIGN KEY (record_id) REFERENCES record (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE record_note_record ADD CONSTRAINT FK_49164FFB5A5A9093 FOREIGN KEY (note_record_id) REFERENCES note_record (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE source_citation ADD CONSTRAINT FK_B99DAAAC2563E6C2 FOREIGN KEY (source_record_id) REFERENCES source_record (id)');
        $this->addSql('ALTER TABLE source_citation ADD CONSTRAINT FK_B99DAAAC4DFD750C FOREIGN KEY (record_id) REFERENCES record (id)');
        $this->addSql('ALTER TABLE submitter_record ADD CONSTRAINT FK_8EA7E5D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gedcom_structure DROP FOREIGN KEY FK_7F63A5AA12ABFA1');
        $this->addSql('ALTER TABLE record_identifier_structure DROP FOREIGN KEY FK_73E630C29CE5597A');
        $this->addSql('ALTER TABLE personal_name_structure DROP FOREIGN KEY FK_7549DFC7AE271C0D');
        $this->addSql('ALTER TABLE media_link DROP FOREIGN KEY FK_F5EB4622689DC682');
        $this->addSql('ALTER TABLE record_note_record DROP FOREIGN KEY FK_49164FFB5A5A9093');
        $this->addSql('ALTER TABLE event_structure DROP FOREIGN KEY FK_E99409D7DA6A219');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B166D1F9C');
        $this->addSql('ALTER TABLE gedcom_structure DROP FOREIGN KEY FK_7F63A5AA166D1F9C');
        $this->addSql('ALTER TABLE individual DROP FOREIGN KEY FK_8793FC17166D1F9C');
        $this->addSql('ALTER TABLE media_record DROP FOREIGN KEY FK_274D054F166D1F9C');
        $this->addSql('ALTER TABLE place_record DROP FOREIGN KEY FK_39FA98F8166D1F9C');
        $this->addSql('ALTER TABLE submitter_record DROP FOREIGN KEY FK_8EA7E5D166D1F9C');
        $this->addSql('ALTER TABLE identifier_structure DROP FOREIGN KEY FK_7EB3A005EEDD8A0C');
        $this->addSql('ALTER TABLE media_link DROP FOREIGN KEY FK_F5EB46224DFD750C');
        $this->addSql('ALTER TABLE record_identifier_structure DROP FOREIGN KEY FK_73E630C24DFD750C');
        $this->addSql('ALTER TABLE record_note_record DROP FOREIGN KEY FK_49164FFB4DFD750C');
        $this->addSql('ALTER TABLE source_citation DROP FOREIGN KEY FK_B99DAAAC4DFD750C');
        $this->addSql('ALTER TABLE source_citation DROP FOREIGN KEY FK_B99DAAAC2563E6C2');
        $this->addSql('DROP TABLE event_structure');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE gedcom_structure');
        $this->addSql('DROP TABLE identifier_structure');
        $this->addSql('DROP TABLE individual');
        $this->addSql('DROP TABLE media_link');
        $this->addSql('DROP TABLE media_record');
        $this->addSql('DROP TABLE note_record');
        $this->addSql('DROP TABLE personal_name_structure');
        $this->addSql('DROP TABLE place_record');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE record');
        $this->addSql('DROP TABLE record_identifier_structure');
        $this->addSql('DROP TABLE record_note_record');
        $this->addSql('DROP TABLE repository_record');
        $this->addSql('DROP TABLE source_citation');
        $this->addSql('DROP TABLE source_record');
        $this->addSql('DROP TABLE submitter_record');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE user');
    }
}
