<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211219113753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_structure (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', place_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL COMMENT \'Friendly Identifier\', agency VARCHAR(80) NOT NULL, religion VARCHAR(80) NOT NULL, cause VARCHAR(80) NOT NULL, tag VARCHAR(22) NOT NULL, text VARCHAR(80) DEFAULT NULL, INDEX IDX_E99409D7DA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_structure ADD CONSTRAINT FK_E99409D7DA6A219 FOREIGN KEY (place_id) REFERENCES place_record (id)');
        $this->addSql('DROP TABLE event_superclass');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event_superclass (id INT AUTO_INCREMENT NOT NULL, agency VARCHAR(80) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, religion VARCHAR(80) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, cause VARCHAR(80) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, tag VARCHAR(22) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, text VARCHAR(80) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE event_structure');
    }
}
