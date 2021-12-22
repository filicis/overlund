<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211222211714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personal_name_structure (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', rin VARCHAR(12) DEFAULT NULL, last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', crea VARCHAR(20) DEFAULT NULL, xref VARCHAR(20) DEFAULT NULL COMMENT \'Friendly Identifier\', personal_name VARCHAR(255) DEFAULT NULL, npfx LONGTEXT DEFAULT NULL, givn LONGTEXT DEFAULT NULL, nick LONGTEXT DEFAULT NULL, spfx LONGTEXT DEFAULT NULL, surn LONGTEXT DEFAULT NULL, nsfx LONGTEXT DEFAULT NULL, INDEX IDX_7549DFC7AE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personal_name_structure ADD CONSTRAINT FK_7549DFC7AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id)');
        $this->addSql('DROP TABLE name_structure');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE name_structure (id INT AUTO_INCREMENT NOT NULL, individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', personal_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_13F109A8AE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE name_structure ADD CONSTRAINT FK_13F109A8AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id)');
        $this->addSql('DROP TABLE personal_name_structure');
    }
}
