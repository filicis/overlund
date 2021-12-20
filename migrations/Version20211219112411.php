<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211219112411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE place_record (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL COMMENT \'Friendly Identifier\', place VARCHAR(255) NOT NULL, map VARCHAR(80) DEFAULT NULL, INDEX search_idx (place), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE place_record');
    }
}
