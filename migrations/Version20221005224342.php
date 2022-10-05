<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005224342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_detail (id INT AUTO_INCREMENT NOT NULL, identifier_link_id INT NOT NULL, tag VARCHAR(32) NOT NULL, addr LONGTEXT DEFAULT NULL, adr1 VARCHAR(60) DEFAULT NULL, adr2 VARCHAR(60) DEFAULT NULL, adr3 VARCHAR(60) DEFAULT NULL, city VARCHAR(60) DEFAULT NULL, stae VARCHAR(60) DEFAULT NULL, post VARCHAR(20) DEFAULT NULL, ctry VARCHAR(60) DEFAULT NULL, phon LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', email LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', fax LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', www LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', locked TINYINT(1) DEFAULT NULL, confidential TINYINT(1) DEFAULT NULL, privacy TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_1C9F08C1576DF789 (identifier_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fam (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE family (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', identifier_link_id INT NOT NULL, project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', husband_relation_id INT DEFAULT NULL, wife_relation_id INT DEFAULT NULL, media_id INT NOT NULL, rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, locked TINYINT(1) DEFAULT NULL, confidential TINYINT(1) DEFAULT NULL, privacy TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_A5E6215B576DF789 (identifier_link_id), INDEX IDX_A5E6215B166D1F9C (project_id), UNIQUE INDEX UNIQ_A5E6215B798F97CA (husband_relation_id), UNIQUE INDEX UNIQ_A5E6215B8A951AAD (wife_relation_id), UNIQUE INDEX UNIQ_A5E6215BEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file_reference (id INT AUTO_INCREMENT NOT NULL, media_record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(255) NOT NULL, INDEX IDX_20ACF665689DC682 (media_record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gedc (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gedcom_structure (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', parent_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, INDEX IDX_7F63A5AA166D1F9C (project_id), INDEX IDX_7F63A5AA727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE head (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE identifier_link (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE identifier_structure (id INT AUTO_INCREMENT NOT NULL, identifier_link_id INT NOT NULL, refn VARCHAR(255) DEFAULT NULL, uid BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', exid VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_7EB3A005576DF789 (identifier_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE indi (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, dummy VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE individual (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', identifier_link_id INT NOT NULL, project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', media_id INT NOT NULL, rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, sex VARCHAR(1) DEFAULT NULL, locked TINYINT(1) DEFAULT NULL, confidential TINYINT(1) DEFAULT NULL, privacy TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_8793FC17576DF789 (identifier_link_id), INDEX IDX_8793FC17166D1F9C (project_id), UNIQUE INDEX UNIQ_8793FC17EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_element (id INT AUTO_INCREMENT NOT NULL, file_reference_id INT NOT NULL, format VARCHAR(80) NOT NULL, medium VARCHAR(255) DEFAULT NULL, file VARCHAR(255) NOT NULL, sortorder INT NOT NULL, INDEX IDX_2097D870B5DB6523 (file_reference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_link (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', media_record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', media_id INT NOT NULL, title VARCHAR(80) DEFAULT NULL, crop VARCHAR(80) DEFAULT NULL, INDEX IDX_F5EB4622689DC682 (media_record_id), INDEX IDX_F5EB4622EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', identifier_link_id INT NOT NULL, project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, UNIQUE INDEX UNIQ_274D054F576DF789 (identifier_link_id), INDEX IDX_274D054F166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_element (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_structure (id INT AUTO_INCREMENT NOT NULL, note_element_id INT DEFAULT NULL, sortorder INT DEFAULT NULL, INDEX IDX_78A6D2757FB80314 (note_element_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_text (id INT AUTO_INCREMENT NOT NULL, note_structure_id INT DEFAULT NULL, mime VARCHAR(80) DEFAULT NULL, lang VARCHAR(30) DEFAULT NULL, text LONGTEXT NOT NULL, sortorder INT DEFAULT NULL, INDEX IDX_9BF1B69FB8C0CEB3 (note_structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personal_name_structure (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', personal_name VARCHAR(255) DEFAULT NULL, npfx VARCHAR(80) DEFAULT NULL, givn VARCHAR(80) DEFAULT NULL, nick VARCHAR(80) DEFAULT NULL, spfx VARCHAR(80) DEFAULT NULL, surn VARCHAR(80) DEFAULT NULL, nsfx VARCHAR(80) DEFAULT NULL, INDEX IDX_7549DFC7AE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personale_name_structure (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', identifier_link_id INT NOT NULL, project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, place VARCHAR(255) NOT NULL, latitude VARCHAR(30) DEFAULT NULL, longitude VARCHAR(30) DEFAULT NULL, UNIQUE INDEX UNIQ_39FA98F8576DF789 (identifier_link_id), INDEX IDX_39FA98F8166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(80) NOT NULL, url VARCHAR(30) NOT NULL, gedcom_filename VARCHAR(255) DEFAULT NULL, language VARCHAR(5) DEFAULT NULL, plac_form VARCHAR(80) DEFAULT NULL, workflow_place VARCHAR(30) DEFAULT NULL, UNIQUE INDEX UNIQ_2FB3D0EEF47645AE (url), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation (id INT AUTO_INCREMENT NOT NULL, individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', family_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', role VARCHAR(255) NOT NULL, pedi VARCHAR(16) DEFAULT NULL, stat VARCHAR(16) DEFAULT NULL, fsortorder INT DEFAULT NULL, csortorder INT DEFAULT NULL, INDEX IDX_62894749AE271C0D (individual_id), INDEX IDX_62894749C35E566A (family_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repository_record (id INT AUTO_INCREMENT NOT NULL, repo VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE submitter_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', identifier_link_id INT NOT NULL, project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, addr LONGTEXT DEFAULT NULL, adr1 VARCHAR(60) DEFAULT NULL, adr2 VARCHAR(60) DEFAULT NULL, adr3 VARCHAR(60) DEFAULT NULL, city VARCHAR(60) DEFAULT NULL, stae VARCHAR(60) DEFAULT NULL, post VARCHAR(20) DEFAULT NULL, ctry VARCHAR(60) DEFAULT NULL, phon LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', email LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', fax LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', www LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8EA7E5D576DF789 (identifier_link_id), INDEX IDX_8EA7E5D166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, parameter1 VARCHAR(80) NOT NULL, parameter2 INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_detail ADD CONSTRAINT FK_1C9F08C1576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B798F97CA FOREIGN KEY (husband_relation_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B8A951AAD FOREIGN KEY (wife_relation_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215BEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE file_reference ADD CONSTRAINT FK_20ACF665689DC682 FOREIGN KEY (media_record_id) REFERENCES media_record (id)');
        $this->addSql('ALTER TABLE gedcom_structure ADD CONSTRAINT FK_7F63A5AA166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE gedcom_structure ADD CONSTRAINT FK_7F63A5AA727ACA70 FOREIGN KEY (parent_id) REFERENCES gedcom_structure (id)');
        $this->addSql('ALTER TABLE identifier_structure ADD CONSTRAINT FK_7EB3A005576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE individual ADD CONSTRAINT FK_8793FC17576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('ALTER TABLE individual ADD CONSTRAINT FK_8793FC17166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE individual ADD CONSTRAINT FK_8793FC17EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE media_element ADD CONSTRAINT FK_2097D870B5DB6523 FOREIGN KEY (file_reference_id) REFERENCES file_reference (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_link ADD CONSTRAINT FK_F5EB4622689DC682 FOREIGN KEY (media_record_id) REFERENCES media_record (id)');
        $this->addSql('ALTER TABLE media_link ADD CONSTRAINT FK_F5EB4622EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_record ADD CONSTRAINT FK_274D054F576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('ALTER TABLE media_record ADD CONSTRAINT FK_274D054F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note_structure ADD CONSTRAINT FK_78A6D2757FB80314 FOREIGN KEY (note_element_id) REFERENCES note_element (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note_text ADD CONSTRAINT FK_9BF1B69FB8C0CEB3 FOREIGN KEY (note_structure_id) REFERENCES note_structure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personal_name_structure ADD CONSTRAINT FK_7549DFC7AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_record ADD CONSTRAINT FK_39FA98F8576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('ALTER TABLE place_record ADD CONSTRAINT FK_39FA98F8166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749C35E566A FOREIGN KEY (family_id) REFERENCES family (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE submitter_record ADD CONSTRAINT FK_8EA7E5D576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('ALTER TABLE submitter_record ADD CONSTRAINT FK_8EA7E5D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_detail DROP FOREIGN KEY FK_1C9F08C1576DF789');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B576DF789');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B166D1F9C');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B798F97CA');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B8A951AAD');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215BEA9FDD75');
        $this->addSql('ALTER TABLE file_reference DROP FOREIGN KEY FK_20ACF665689DC682');
        $this->addSql('ALTER TABLE gedcom_structure DROP FOREIGN KEY FK_7F63A5AA166D1F9C');
        $this->addSql('ALTER TABLE gedcom_structure DROP FOREIGN KEY FK_7F63A5AA727ACA70');
        $this->addSql('ALTER TABLE identifier_structure DROP FOREIGN KEY FK_7EB3A005576DF789');
        $this->addSql('ALTER TABLE individual DROP FOREIGN KEY FK_8793FC17576DF789');
        $this->addSql('ALTER TABLE individual DROP FOREIGN KEY FK_8793FC17166D1F9C');
        $this->addSql('ALTER TABLE individual DROP FOREIGN KEY FK_8793FC17EA9FDD75');
        $this->addSql('ALTER TABLE media_element DROP FOREIGN KEY FK_2097D870B5DB6523');
        $this->addSql('ALTER TABLE media_link DROP FOREIGN KEY FK_F5EB4622689DC682');
        $this->addSql('ALTER TABLE media_link DROP FOREIGN KEY FK_F5EB4622EA9FDD75');
        $this->addSql('ALTER TABLE media_record DROP FOREIGN KEY FK_274D054F576DF789');
        $this->addSql('ALTER TABLE media_record DROP FOREIGN KEY FK_274D054F166D1F9C');
        $this->addSql('ALTER TABLE note_structure DROP FOREIGN KEY FK_78A6D2757FB80314');
        $this->addSql('ALTER TABLE note_text DROP FOREIGN KEY FK_9BF1B69FB8C0CEB3');
        $this->addSql('ALTER TABLE personal_name_structure DROP FOREIGN KEY FK_7549DFC7AE271C0D');
        $this->addSql('ALTER TABLE place_record DROP FOREIGN KEY FK_39FA98F8576DF789');
        $this->addSql('ALTER TABLE place_record DROP FOREIGN KEY FK_39FA98F8166D1F9C');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749AE271C0D');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749C35E566A');
        $this->addSql('ALTER TABLE submitter_record DROP FOREIGN KEY FK_8EA7E5D576DF789');
        $this->addSql('ALTER TABLE submitter_record DROP FOREIGN KEY FK_8EA7E5D166D1F9C');
        $this->addSql('DROP TABLE event_detail');
        $this->addSql('DROP TABLE fam');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE file_reference');
        $this->addSql('DROP TABLE gedc');
        $this->addSql('DROP TABLE gedcom_structure');
        $this->addSql('DROP TABLE head');
        $this->addSql('DROP TABLE identifier_link');
        $this->addSql('DROP TABLE identifier_structure');
        $this->addSql('DROP TABLE indi');
        $this->addSql('DROP TABLE individual');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE media_element');
        $this->addSql('DROP TABLE media_link');
        $this->addSql('DROP TABLE media_record');
        $this->addSql('DROP TABLE note_element');
        $this->addSql('DROP TABLE note_structure');
        $this->addSql('DROP TABLE note_text');
        $this->addSql('DROP TABLE personal_name_structure');
        $this->addSql('DROP TABLE personale_name_structure');
        $this->addSql('DROP TABLE place_record');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE relation');
        $this->addSql('DROP TABLE repository_record');
        $this->addSql('DROP TABLE submitter_record');
        $this->addSql('DROP TABLE test');
    }
}
