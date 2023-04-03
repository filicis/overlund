<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230104200118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address_structure (id INT AUTO_INCREMENT NOT NULL, addr LONGTEXT DEFAULT NULL, adr1 VARCHAR(60) DEFAULT NULL, adr2 VARCHAR(60) DEFAULT NULL, adr3 VARCHAR(60) DEFAULT NULL, city VARCHAR(60) DEFAULT NULL, stae VARCHAR(60) DEFAULT NULL, post VARCHAR(20) DEFAULT NULL, ctry VARCHAR(60) DEFAULT NULL, phon LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', email LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', fax LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', www LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alia_structure (id INT AUTO_INCREMENT NOT NULL, individual_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', indi_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', phrase VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B19695DDAE271C0D (individual_id), INDEX IDX_B19695DD220CD44 (indi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE anci_structure (id INT AUTO_INCREMENT NOT NULL, submitter_record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', UNIQUE INDEX UNIQ_813E29B2F34627C5 (submitter_record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_link (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE association_structure (id INT AUTO_INCREMENT NOT NULL, individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', association_link_id INT NOT NULL, phrase VARCHAR(255) DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_CBE63E9FAE271C0D (individual_id), INDEX IDX_CBE63E9F63F692DB (association_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE callnumber (id INT AUTO_INCREMENT NOT NULL, source_repository_citation_id INT NOT NULL, callnumber VARCHAR(255) NOT NULL, medium VARCHAR(255) NOT NULL, INDEX IDX_7E426F70BECB516E (source_repository_citation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citation_link (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE citation_structure (id INT AUTO_INCREMENT NOT NULL, source_record_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', citation_link_id INT NOT NULL, page VARCHAR(255) NOT NULL, date VARCHAR(255) NOT NULL, event VARCHAR(255) DEFAULT NULL, role VARCHAR(255) NOT NULL, quality VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6B4134172563E6C2 (source_record_id), INDEX IDX_6B413417EC8E34B1 (citation_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_detail (id INT AUTO_INCREMENT NOT NULL, tag VARCHAR(32) NOT NULL, agency VARCHAR(255) DEFAULT NULL, religion VARCHAR(255) DEFAULT NULL, cause VARCHAR(255) DEFAULT NULL, date VARCHAR(255) DEFAULT NULL, locked TINYINT(1) DEFAULT NULL, confidential TINYINT(1) DEFAULT NULL, privacy TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE family (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', husb_id INT DEFAULT NULL, wife_id INT DEFAULT NULL, identifier_link_id INT DEFAULT NULL, media_id INT DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, locked TINYINT(1) DEFAULT NULL, confidential TINYINT(1) DEFAULT NULL, privacy TINYINT(1) DEFAULT NULL, INDEX IDX_A5E6215B166D1F9C (project_id), UNIQUE INDEX UNIQ_A5E6215BC887F83B (husb_id), UNIQUE INDEX UNIQ_A5E6215B18D2F6B7 (wife_id), UNIQUE INDEX UNIQ_A5E6215B576DF789 (identifier_link_id), UNIQUE INDEX UNIQ_A5E6215BEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file_reference (id INT AUTO_INCREMENT NOT NULL, media_record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(255) NOT NULL, medium VARCHAR(80) DEFAULT NULL, INDEX IDX_20ACF665689DC682 (media_record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gedc (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gedcom_structure (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', parent_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, INDEX IDX_7F63A5AA166D1F9C (project_id), INDEX IDX_7F63A5AA727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE head (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', level INT NOT NULL, xref VARCHAR(32) DEFAULT NULL, tag VARCHAR(32) NOT NULL, pointer VARCHAR(20) DEFAULT NULL, escape VARCHAR(32) DEFAULT NULL, value LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE identifier_link (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE identifier_structure (id INT AUTO_INCREMENT NOT NULL, identifier_link_id INT NOT NULL, refn VARCHAR(255) DEFAULT NULL, uid BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', exid VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_7EB3A005576DF789 (identifier_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE individual (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', identifier_link_id INT DEFAULT NULL, media_id INT DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, sex VARCHAR(1) DEFAULT NULL, locked TINYINT(1) DEFAULT NULL, confidential TINYINT(1) DEFAULT NULL, privacy TINYINT(1) DEFAULT NULL, INDEX IDX_8793FC17166D1F9C (project_id), UNIQUE INDEX UNIQ_8793FC17576DF789 (identifier_link_id), UNIQUE INDEX UNIQ_8793FC17EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_element (id INT AUTO_INCREMENT NOT NULL, file_reference_id INT NOT NULL, format VARCHAR(80) NOT NULL, file VARCHAR(255) NOT NULL, sortorder INT NOT NULL, INDEX IDX_2097D870B5DB6523 (file_reference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_link (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', media_record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', media_id INT NOT NULL, title VARCHAR(80) DEFAULT NULL, crop VARCHAR(80) DEFAULT NULL, INDEX IDX_F5EB4622689DC682 (media_record_id), INDEX IDX_F5EB4622EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mediarecord (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', identifier_link_id INT DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, locked TINYINT(1) DEFAULT NULL, confidential TINYINT(1) DEFAULT NULL, privacy TINYINT(1) DEFAULT NULL, INDEX IDX_E15B7BC166D1F9C (project_id), UNIQUE INDEX UNIQ_E15B7BC576DF789 (identifier_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE name_structure (id INT AUTO_INCREMENT NOT NULL, individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', personal_name VARCHAR(255) DEFAULT NULL, name_type VARCHAR(60) DEFAULT NULL, name_pieces_npfx VARCHAR(255) DEFAULT NULL, name_pieces_givn VARCHAR(255) DEFAULT NULL, name_pieces_nick VARCHAR(255) DEFAULT NULL, name_pieces_spfx VARCHAR(255) DEFAULT NULL, name_pieces_surn VARCHAR(255) DEFAULT NULL, name_pieces_nsfx VARCHAR(255) DEFAULT NULL, INDEX IDX_13F109A8AE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE name_translation (id INT AUTO_INCREMENT NOT NULL, personal_name VARCHAR(255) DEFAULT NULL, language VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_element (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_structure (id INT AUTO_INCREMENT NOT NULL, note_element_id INT DEFAULT NULL, sortorder INT DEFAULT NULL, INDEX IDX_78A6D2757FB80314 (note_element_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_text (id INT AUTO_INCREMENT NOT NULL, note_structure_id INT DEFAULT NULL, mime VARCHAR(80) DEFAULT NULL, lang VARCHAR(30) DEFAULT NULL, text LONGTEXT NOT NULL, sortorder INT DEFAULT NULL, INDEX IDX_9BF1B69FB8C0CEB3 (note_structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_form (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, title VARCHAR(80) NOT NULL, form VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, place VARCHAR(255) NOT NULL, latitude VARCHAR(30) DEFAULT NULL, longitude VARCHAR(30) DEFAULT NULL, INDEX IDX_39FA98F8166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(80) NOT NULL, url VARCHAR(30) NOT NULL, gedcom_filename VARCHAR(255) DEFAULT NULL, language VARCHAR(5) DEFAULT NULL, plac_form VARCHAR(80) DEFAULT NULL, workflow_place VARCHAR(30) DEFAULT NULL, UNIQUE INDEX UNIQ_2FB3D0EEF47645AE (url), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation (id INT AUTO_INCREMENT NOT NULL, family_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', role VARCHAR(255) NOT NULL, pedi VARCHAR(16) DEFAULT NULL, stat VARCHAR(16) DEFAULT NULL, fsortorder INT DEFAULT NULL, csortorder INT DEFAULT NULL, INDEX IDX_62894749C35E566A (family_id), INDEX IDX_62894749AE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repositoryrecord (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', identifier_link_id INT DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_BF6E3760166D1F9C (project_id), UNIQUE INDEX UNIQ_BF6E3760576DF789 (identifier_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source_repository_citation (id INT AUTO_INCREMENT NOT NULL, repository_record_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', source_record_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', INDEX IDX_9A26AA7E9587F804 (repository_record_id), INDEX IDX_9A26AA7E2563E6C2 (source_record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sourcerecord (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', identifier_link_id INT DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, author VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, abbreviation VARCHAR(255) DEFAULT NULL, publication VARCHAR(255) DEFAULT NULL, INDEX IDX_8804A832166D1F9C (project_id), UNIQUE INDEX UNIQ_8804A832576DF789 (identifier_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE submitter_link (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE submitter_structure (id INT AUTO_INCREMENT NOT NULL, submitter_record_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', submitter_link_id INT NOT NULL, UNIQUE INDEX UNIQ_D1BA6523F34627C5 (submitter_record_id), INDEX IDX_D1BA65233FE5520B (submitter_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE submitterrecord (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', identifier_link_id INT DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL, INDEX IDX_C6122280166D1F9C (project_id), UNIQUE INDEX UNIQ_C6122280576DF789 (identifier_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, parameter1 VARCHAR(80) NOT NULL, parameter2 INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alia_structure ADD CONSTRAINT FK_B19695DDAE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id)');
        $this->addSql('ALTER TABLE alia_structure ADD CONSTRAINT FK_B19695DD220CD44 FOREIGN KEY (indi_id) REFERENCES individual (id)');
        $this->addSql('ALTER TABLE anci_structure ADD CONSTRAINT FK_813E29B2F34627C5 FOREIGN KEY (submitter_record_id) REFERENCES submitterrecord (id)');
        $this->addSql('ALTER TABLE association_structure ADD CONSTRAINT FK_CBE63E9FAE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id)');
        $this->addSql('ALTER TABLE association_structure ADD CONSTRAINT FK_CBE63E9F63F692DB FOREIGN KEY (association_link_id) REFERENCES association_link (id)');
        $this->addSql('ALTER TABLE callnumber ADD CONSTRAINT FK_7E426F70BECB516E FOREIGN KEY (source_repository_citation_id) REFERENCES source_repository_citation (id)');
        $this->addSql('ALTER TABLE citation_structure ADD CONSTRAINT FK_6B4134172563E6C2 FOREIGN KEY (source_record_id) REFERENCES sourcerecord (id)');
        $this->addSql('ALTER TABLE citation_structure ADD CONSTRAINT FK_6B413417EC8E34B1 FOREIGN KEY (citation_link_id) REFERENCES citation_link (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215BC887F83B FOREIGN KEY (husb_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B18D2F6B7 FOREIGN KEY (wife_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215BEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE file_reference ADD CONSTRAINT FK_20ACF665689DC682 FOREIGN KEY (media_record_id) REFERENCES mediarecord (id)');
        $this->addSql('ALTER TABLE gedcom_structure ADD CONSTRAINT FK_7F63A5AA166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE gedcom_structure ADD CONSTRAINT FK_7F63A5AA727ACA70 FOREIGN KEY (parent_id) REFERENCES gedcom_structure (id)');
        $this->addSql('ALTER TABLE identifier_structure ADD CONSTRAINT FK_7EB3A005576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE individual ADD CONSTRAINT FK_8793FC17166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE individual ADD CONSTRAINT FK_8793FC17576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE individual ADD CONSTRAINT FK_8793FC17EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE media_element ADD CONSTRAINT FK_2097D870B5DB6523 FOREIGN KEY (file_reference_id) REFERENCES file_reference (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_link ADD CONSTRAINT FK_F5EB4622689DC682 FOREIGN KEY (media_record_id) REFERENCES mediarecord (id)');
        $this->addSql('ALTER TABLE media_link ADD CONSTRAINT FK_F5EB4622EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mediarecord ADD CONSTRAINT FK_E15B7BC166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mediarecord ADD CONSTRAINT FK_E15B7BC576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE name_structure ADD CONSTRAINT FK_13F109A8AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id)');
        $this->addSql('ALTER TABLE note_structure ADD CONSTRAINT FK_78A6D2757FB80314 FOREIGN KEY (note_element_id) REFERENCES note_element (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note_text ADD CONSTRAINT FK_9BF1B69FB8C0CEB3 FOREIGN KEY (note_structure_id) REFERENCES note_structure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place_record ADD CONSTRAINT FK_39FA98F8166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749C35E566A FOREIGN KEY (family_id) REFERENCES family (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE repositoryrecord ADD CONSTRAINT FK_BF6E3760166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE repositoryrecord ADD CONSTRAINT FK_BF6E3760576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE source_repository_citation ADD CONSTRAINT FK_9A26AA7E9587F804 FOREIGN KEY (repository_record_id) REFERENCES repositoryrecord (id)');
        $this->addSql('ALTER TABLE source_repository_citation ADD CONSTRAINT FK_9A26AA7E2563E6C2 FOREIGN KEY (source_record_id) REFERENCES sourcerecord (id)');
        $this->addSql('ALTER TABLE sourcerecord ADD CONSTRAINT FK_8804A832166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE sourcerecord ADD CONSTRAINT FK_8804A832576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE submitter_structure ADD CONSTRAINT FK_D1BA6523F34627C5 FOREIGN KEY (submitter_record_id) REFERENCES submitterrecord (id)');
        $this->addSql('ALTER TABLE submitter_structure ADD CONSTRAINT FK_D1BA65233FE5520B FOREIGN KEY (submitter_link_id) REFERENCES submitter_link (id)');
        $this->addSql('ALTER TABLE submitterrecord ADD CONSTRAINT FK_C6122280166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE submitterrecord ADD CONSTRAINT FK_C6122280576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alia_structure DROP FOREIGN KEY FK_B19695DDAE271C0D');
        $this->addSql('ALTER TABLE alia_structure DROP FOREIGN KEY FK_B19695DD220CD44');
        $this->addSql('ALTER TABLE anci_structure DROP FOREIGN KEY FK_813E29B2F34627C5');
        $this->addSql('ALTER TABLE association_structure DROP FOREIGN KEY FK_CBE63E9FAE271C0D');
        $this->addSql('ALTER TABLE association_structure DROP FOREIGN KEY FK_CBE63E9F63F692DB');
        $this->addSql('ALTER TABLE callnumber DROP FOREIGN KEY FK_7E426F70BECB516E');
        $this->addSql('ALTER TABLE citation_structure DROP FOREIGN KEY FK_6B4134172563E6C2');
        $this->addSql('ALTER TABLE citation_structure DROP FOREIGN KEY FK_6B413417EC8E34B1');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B166D1F9C');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215BC887F83B');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B18D2F6B7');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B576DF789');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215BEA9FDD75');
        $this->addSql('ALTER TABLE file_reference DROP FOREIGN KEY FK_20ACF665689DC682');
        $this->addSql('ALTER TABLE gedcom_structure DROP FOREIGN KEY FK_7F63A5AA166D1F9C');
        $this->addSql('ALTER TABLE gedcom_structure DROP FOREIGN KEY FK_7F63A5AA727ACA70');
        $this->addSql('ALTER TABLE identifier_structure DROP FOREIGN KEY FK_7EB3A005576DF789');
        $this->addSql('ALTER TABLE individual DROP FOREIGN KEY FK_8793FC17166D1F9C');
        $this->addSql('ALTER TABLE individual DROP FOREIGN KEY FK_8793FC17576DF789');
        $this->addSql('ALTER TABLE individual DROP FOREIGN KEY FK_8793FC17EA9FDD75');
        $this->addSql('ALTER TABLE media_element DROP FOREIGN KEY FK_2097D870B5DB6523');
        $this->addSql('ALTER TABLE media_link DROP FOREIGN KEY FK_F5EB4622689DC682');
        $this->addSql('ALTER TABLE media_link DROP FOREIGN KEY FK_F5EB4622EA9FDD75');
        $this->addSql('ALTER TABLE mediarecord DROP FOREIGN KEY FK_E15B7BC166D1F9C');
        $this->addSql('ALTER TABLE mediarecord DROP FOREIGN KEY FK_E15B7BC576DF789');
        $this->addSql('ALTER TABLE name_structure DROP FOREIGN KEY FK_13F109A8AE271C0D');
        $this->addSql('ALTER TABLE note_structure DROP FOREIGN KEY FK_78A6D2757FB80314');
        $this->addSql('ALTER TABLE note_text DROP FOREIGN KEY FK_9BF1B69FB8C0CEB3');
        $this->addSql('ALTER TABLE place_record DROP FOREIGN KEY FK_39FA98F8166D1F9C');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749C35E566A');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749AE271C0D');
        $this->addSql('ALTER TABLE repositoryrecord DROP FOREIGN KEY FK_BF6E3760166D1F9C');
        $this->addSql('ALTER TABLE repositoryrecord DROP FOREIGN KEY FK_BF6E3760576DF789');
        $this->addSql('ALTER TABLE source_repository_citation DROP FOREIGN KEY FK_9A26AA7E9587F804');
        $this->addSql('ALTER TABLE source_repository_citation DROP FOREIGN KEY FK_9A26AA7E2563E6C2');
        $this->addSql('ALTER TABLE sourcerecord DROP FOREIGN KEY FK_8804A832166D1F9C');
        $this->addSql('ALTER TABLE sourcerecord DROP FOREIGN KEY FK_8804A832576DF789');
        $this->addSql('ALTER TABLE submitter_structure DROP FOREIGN KEY FK_D1BA6523F34627C5');
        $this->addSql('ALTER TABLE submitter_structure DROP FOREIGN KEY FK_D1BA65233FE5520B');
        $this->addSql('ALTER TABLE submitterrecord DROP FOREIGN KEY FK_C6122280166D1F9C');
        $this->addSql('ALTER TABLE submitterrecord DROP FOREIGN KEY FK_C6122280576DF789');
        $this->addSql('DROP TABLE address_structure');
        $this->addSql('DROP TABLE alia_structure');
        $this->addSql('DROP TABLE anci_structure');
        $this->addSql('DROP TABLE association_link');
        $this->addSql('DROP TABLE association_structure');
        $this->addSql('DROP TABLE callnumber');
        $this->addSql('DROP TABLE citation_link');
        $this->addSql('DROP TABLE citation_structure');
        $this->addSql('DROP TABLE event_detail');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE file_reference');
        $this->addSql('DROP TABLE gedc');
        $this->addSql('DROP TABLE gedcom_structure');
        $this->addSql('DROP TABLE head');
        $this->addSql('DROP TABLE identifier_link');
        $this->addSql('DROP TABLE identifier_structure');
        $this->addSql('DROP TABLE individual');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE media_element');
        $this->addSql('DROP TABLE media_link');
        $this->addSql('DROP TABLE mediarecord');
        $this->addSql('DROP TABLE name_structure');
        $this->addSql('DROP TABLE name_translation');
        $this->addSql('DROP TABLE note_element');
        $this->addSql('DROP TABLE note_structure');
        $this->addSql('DROP TABLE note_text');
        $this->addSql('DROP TABLE place_form');
        $this->addSql('DROP TABLE place_record');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE relation');
        $this->addSql('DROP TABLE repositoryrecord');
        $this->addSql('DROP TABLE source_repository_citation');
        $this->addSql('DROP TABLE sourcerecord');
        $this->addSql('DROP TABLE submitter_link');
        $this->addSql('DROP TABLE submitter_structure');
        $this->addSql('DROP TABLE submitterrecord');
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE user');
    }
}
