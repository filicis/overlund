<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929212817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B6C9A17CA');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215BBCCF1946');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B6C9A17CA FOREIGN KEY (_wife_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215BBCCF1946 FOREIGN KEY (_husb_id) REFERENCES relation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215BBCCF1946');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B6C9A17CA');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215BBCCF1946 FOREIGN KEY (_husb_id) REFERENCES relation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B6C9A17CA FOREIGN KEY (_wife_id) REFERENCES relation (id) ON DELETE CASCADE');
    }
}
