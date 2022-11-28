<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221128204514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_detail ADD agency VARCHAR(255) DEFAULT NULL, ADD religion VARCHAR(255) DEFAULT NULL, ADD cause VARCHAR(255) DEFAULT NULL, ADD date VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE family CHANGE media_id media_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE file_reference ADD medium VARCHAR(80) DEFAULT NULL');
        $this->addSql('ALTER TABLE individual CHANGE media_id media_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media_element DROP medium');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_detail DROP agency, DROP religion, DROP cause, DROP date');
        $this->addSql('ALTER TABLE family CHANGE media_id media_id INT NOT NULL');
        $this->addSql('ALTER TABLE file_reference DROP medium');
        $this->addSql('ALTER TABLE individual CHANGE media_id media_id INT NOT NULL');
        $this->addSql('ALTER TABLE media_element ADD medium VARCHAR(255) DEFAULT NULL');
    }
}
