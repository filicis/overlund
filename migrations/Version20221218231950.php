<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221218231950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE name_structure (id INT AUTO_INCREMENT NOT NULL, individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', personal_name VARCHAR(255) DEFAULT NULL, name_type VARCHAR(60) DEFAULT NULL, name_pieces_npfx VARCHAR(255) DEFAULT NULL, name_pieces_givn VARCHAR(255) DEFAULT NULL, name_pieces_nick VARCHAR(255) DEFAULT NULL, name_pieces_spfx VARCHAR(255) DEFAULT NULL, name_pieces_surn VARCHAR(255) DEFAULT NULL, name_pieces_nsfx VARCHAR(255) DEFAULT NULL, INDEX IDX_13F109A8AE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE name_translation (id INT AUTO_INCREMENT NOT NULL, personal_name VARCHAR(255) DEFAULT NULL, language VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE name_structure ADD CONSTRAINT FK_13F109A8AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id)');
        $this->addSql('ALTER TABLE personal_name_structure DROP FOREIGN KEY FK_7549DFC7AE271C0D');
        $this->addSql('DROP TABLE personal_name_structure');
        $this->addSql('DROP TABLE personale_name_structure');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personal_name_structure (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', personal_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, npfx VARCHAR(80) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, givn VARCHAR(80) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nick VARCHAR(80) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, spfx VARCHAR(80) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, surn VARCHAR(80) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nsfx VARCHAR(80) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_7549DFC7AE271C0D (individual_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE personale_name_structure (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE personal_name_structure ADD CONSTRAINT FK_7549DFC7AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE name_structure DROP FOREIGN KEY FK_13F109A8AE271C0D');
        $this->addSql('DROP TABLE name_structure');
        $this->addSql('DROP TABLE name_translation');
    }
}
