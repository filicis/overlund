<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211218175246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE identifier_structure (id INT AUTO_INCREMENT NOT NULL, record_links_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', tag VARCHAR(20) NOT NULL, value VARCHAR(80) NOT NULL, type VARCHAR(80) NOT NULL, INDEX IDX_7EB3A005EEDD8A0C (record_links_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', project_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL COMMENT \'Friendly Identifier\', INDEX IDX_274D054F166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL COMMENT \'Friendly Identifier\', note LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE record_note_record (record_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', note_record_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', INDEX IDX_49164FFB4DFD750C (record_id), INDEX IDX_49164FFB5A5A9093 (note_record_id), PRIMARY KEY(record_id, note_record_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE repository_record (id INT AUTO_INCREMENT NOT NULL, repo VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source_citation (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', source_record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', page VARCHAR(80) DEFAULT NULL, quality VARCHAR(80) DEFAULT NULL, INDEX IDX_B99DAAAC2563E6C2 (source_record_id), INDEX IDX_B99DAAAC4DFD750C (record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL COMMENT \'Friendly Identifier\', source VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE identifier_structure ADD CONSTRAINT FK_7EB3A005EEDD8A0C FOREIGN KEY (record_links_id) REFERENCES record (id)');
        $this->addSql('ALTER TABLE media_record ADD CONSTRAINT FK_274D054F166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE record_note_record ADD CONSTRAINT FK_49164FFB4DFD750C FOREIGN KEY (record_id) REFERENCES record (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE record_note_record ADD CONSTRAINT FK_49164FFB5A5A9093 FOREIGN KEY (note_record_id) REFERENCES note_record (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE source_citation ADD CONSTRAINT FK_B99DAAAC2563E6C2 FOREIGN KEY (source_record_id) REFERENCES source_record (id)');
        $this->addSql('ALTER TABLE source_citation ADD CONSTRAINT FK_B99DAAAC4DFD750C FOREIGN KEY (record_id) REFERENCES record (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE record_note_record DROP FOREIGN KEY FK_49164FFB5A5A9093');
        $this->addSql('ALTER TABLE identifier_structure DROP FOREIGN KEY FK_7EB3A005EEDD8A0C');
        $this->addSql('ALTER TABLE record_note_record DROP FOREIGN KEY FK_49164FFB4DFD750C');
        $this->addSql('ALTER TABLE source_citation DROP FOREIGN KEY FK_B99DAAAC4DFD750C');
        $this->addSql('ALTER TABLE source_citation DROP FOREIGN KEY FK_B99DAAAC2563E6C2');
        $this->addSql('DROP TABLE identifier_structure');
        $this->addSql('DROP TABLE media_record');
        $this->addSql('DROP TABLE note_record');
        $this->addSql('DROP TABLE record');
        $this->addSql('DROP TABLE record_note_record');
        $this->addSql('DROP TABLE repository_record');
        $this->addSql('DROP TABLE source_citation');
        $this->addSql('DROP TABLE source_record');
    }
}
