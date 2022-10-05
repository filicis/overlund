<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005230114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B576DF789');
        $this->addSql('DROP INDEX UNIQ_A5E6215B576DF789 ON family');
        $this->addSql('ALTER TABLE family DROP identifier_link_id');
        $this->addSql('ALTER TABLE individual DROP FOREIGN KEY FK_8793FC17576DF789');
        $this->addSql('DROP INDEX UNIQ_8793FC17576DF789 ON individual');
        $this->addSql('ALTER TABLE individual DROP identifier_link_id');
        $this->addSql('ALTER TABLE media_record DROP FOREIGN KEY FK_274D054F576DF789');
        $this->addSql('DROP INDEX UNIQ_274D054F576DF789 ON media_record');
        $this->addSql('ALTER TABLE media_record DROP identifier_link_id');
        $this->addSql('ALTER TABLE place_record DROP FOREIGN KEY FK_39FA98F8576DF789');
        $this->addSql('DROP INDEX UNIQ_39FA98F8576DF789 ON place_record');
        $this->addSql('ALTER TABLE place_record DROP identifier_link_id');
        $this->addSql('ALTER TABLE submitter_record DROP FOREIGN KEY FK_8EA7E5D576DF789');
        $this->addSql('DROP INDEX UNIQ_8EA7E5D576DF789 ON submitter_record');
        $this->addSql('ALTER TABLE submitter_record DROP identifier_link_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family ADD identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215B576DF789 ON family (identifier_link_id)');
        $this->addSql('ALTER TABLE individual ADD identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE individual ADD CONSTRAINT FK_8793FC17576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8793FC17576DF789 ON individual (identifier_link_id)');
        $this->addSql('ALTER TABLE media_record ADD identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media_record ADD CONSTRAINT FK_274D054F576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_274D054F576DF789 ON media_record (identifier_link_id)');
        $this->addSql('ALTER TABLE place_record ADD identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE place_record ADD CONSTRAINT FK_39FA98F8576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_39FA98F8576DF789 ON place_record (identifier_link_id)');
        $this->addSql('ALTER TABLE submitter_record ADD identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE submitter_record ADD CONSTRAINT FK_8EA7E5D576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8EA7E5D576DF789 ON submitter_record (identifier_link_id)');
    }
}
