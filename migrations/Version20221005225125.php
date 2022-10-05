<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005225125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_detail CHANGE identifier_link_id identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE family CHANGE identifier_link_id identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE individual CHANGE identifier_link_id identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media_record CHANGE identifier_link_id identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE place_record CHANGE identifier_link_id identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE submitter_record CHANGE identifier_link_id identifier_link_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_detail CHANGE identifier_link_id identifier_link_id INT NOT NULL');
        $this->addSql('ALTER TABLE family CHANGE identifier_link_id identifier_link_id INT NOT NULL');
        $this->addSql('ALTER TABLE individual CHANGE identifier_link_id identifier_link_id INT NOT NULL');
        $this->addSql('ALTER TABLE media_record CHANGE identifier_link_id identifier_link_id INT NOT NULL');
        $this->addSql('ALTER TABLE place_record CHANGE identifier_link_id identifier_link_id INT NOT NULL');
        $this->addSql('ALTER TABLE submitter_record CHANGE identifier_link_id identifier_link_id INT NOT NULL');
    }
}
