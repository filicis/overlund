<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221001131448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE note_element (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_structure (id INT AUTO_INCREMENT NOT NULL, note_element_id INT DEFAULT NULL, sortorder INT DEFAULT NULL, INDEX IDX_78A6D2757FB80314 (note_element_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_text (id INT AUTO_INCREMENT NOT NULL, note_structure_id INT DEFAULT NULL, mime VARCHAR(80) DEFAULT NULL, lang VARCHAR(30) DEFAULT NULL, text LONGTEXT NOT NULL, sortorder INT DEFAULT NULL, INDEX IDX_9BF1B69FB8C0CEB3 (note_structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note_structure ADD CONSTRAINT FK_78A6D2757FB80314 FOREIGN KEY (note_element_id) REFERENCES note_element (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE note_text ADD CONSTRAINT FK_9BF1B69FB8C0CEB3 FOREIGN KEY (note_structure_id) REFERENCES note_structure (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_structure DROP FOREIGN KEY FK_78A6D2757FB80314');
        $this->addSql('ALTER TABLE note_text DROP FOREIGN KEY FK_9BF1B69FB8C0CEB3');
        $this->addSql('DROP TABLE note_element');
        $this->addSql('DROP TABLE note_structure');
        $this->addSql('DROP TABLE note_text');
    }
}
