<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818214335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B18D2F6B7');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215BC887F83B');
        $this->addSql('DROP INDEX UNIQ_A5E6215BC887F83B ON family');
        $this->addSql('DROP INDEX UNIQ_A5E6215B18D2F6B7 ON family');
        $this->addSql('ALTER TABLE family ADD _husb_id INT DEFAULT NULL, ADD _wife_id INT DEFAULT NULL, DROP husb_id, DROP wife_id');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215BBCCF1946 FOREIGN KEY (_husb_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B6C9A17CA FOREIGN KEY (_wife_id) REFERENCES relation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215BBCCF1946 ON family (_husb_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215B6C9A17CA ON family (_wife_id)');
        $this->addSql('ALTER TABLE relation ADD role VARCHAR(255) NOT NULL, DROP type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215BBCCF1946');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B6C9A17CA');
        $this->addSql('DROP INDEX UNIQ_A5E6215BBCCF1946 ON family');
        $this->addSql('DROP INDEX UNIQ_A5E6215B6C9A17CA ON family');
        $this->addSql('ALTER TABLE family ADD husb_id INT DEFAULT NULL, ADD wife_id INT DEFAULT NULL, DROP _husb_id, DROP _wife_id');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B18D2F6B7 FOREIGN KEY (wife_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215BC887F83B FOREIGN KEY (husb_id) REFERENCES relation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215BC887F83B ON family (husb_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215B18D2F6B7 ON family (wife_id)');
        $this->addSql('ALTER TABLE relation ADD type VARCHAR(4) NOT NULL, DROP role');
    }
}
