<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005230849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE individual ADD identifier_link_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE individual ADD CONSTRAINT FK_8793FC17576DF789 FOREIGN KEY (identifier_link_id) REFERENCES identifier_link (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8793FC17576DF789 ON individual (identifier_link_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE individual DROP FOREIGN KEY FK_8793FC17576DF789');
        $this->addSql('DROP INDEX UNIQ_8793FC17576DF789 ON individual');
        $this->addSql('ALTER TABLE individual DROP identifier_link_id');
    }
}
