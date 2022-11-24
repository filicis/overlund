<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221124200743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media_record ADD locked TINYINT(1) DEFAULT NULL, ADD confidential TINYINT(1) DEFAULT NULL, ADD privacy TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE source_record ADD project_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\'');
        $this->addSql('ALTER TABLE source_record ADD CONSTRAINT FK_2DCBBA77166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_2DCBBA77166D1F9C ON source_record (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media_record DROP locked, DROP confidential, DROP privacy');
        $this->addSql('ALTER TABLE source_record DROP FOREIGN KEY FK_2DCBBA77166D1F9C');
        $this->addSql('DROP INDEX IDX_2DCBBA77166D1F9C ON source_record');
        $this->addSql('ALTER TABLE source_record DROP project_id');
    }
}
