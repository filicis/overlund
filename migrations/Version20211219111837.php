<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211219111837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_superclass (id INT AUTO_INCREMENT NOT NULL, agency VARCHAR(80) NOT NULL, religion VARCHAR(80) NOT NULL, cause VARCHAR(80) NOT NULL, tag VARCHAR(22) NOT NULL, text VARCHAR(80) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_link (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', media_record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', record_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(80) DEFAULT NULL, crop VARCHAR(80) DEFAULT NULL, INDEX IDX_F5EB4622689DC682 (media_record_id), INDEX IDX_F5EB46224DFD750C (record_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media_link ADD CONSTRAINT FK_F5EB4622689DC682 FOREIGN KEY (media_record_id) REFERENCES media_record (id)');
        $this->addSql('ALTER TABLE media_link ADD CONSTRAINT FK_F5EB46224DFD750C FOREIGN KEY (record_id) REFERENCES record (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE event_superclass');
        $this->addSql('DROP TABLE media_link');
    }
}
