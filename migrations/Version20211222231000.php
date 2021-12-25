<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211222231000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personal_name_structure CHANGE npfx npfx VARCHAR(80) DEFAULT NULL, CHANGE givn givn VARCHAR(80) DEFAULT NULL, CHANGE nick nick VARCHAR(80) DEFAULT NULL, CHANGE spfx spfx VARCHAR(80) DEFAULT NULL, CHANGE surn surn VARCHAR(80) DEFAULT NULL, CHANGE nsfx nsfx VARCHAR(80) DEFAULT NULL');
        $this->addSql('ALTER TABLE place_record ADD latitude VARCHAR(30) DEFAULT NULL, ADD longitude VARCHAR(30) DEFAULT NULL, DROP map');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personal_name_structure CHANGE npfx npfx LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE givn givn LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nick nick LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE spfx spfx LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE surn surn LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nsfx nsfx LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE place_record ADD map VARCHAR(80) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP latitude, DROP longitude');
    }
}
