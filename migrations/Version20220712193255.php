<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220712193255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE relation (id INT AUTO_INCREMENT NOT NULL, individual_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', family_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', type VARCHAR(4) NOT NULL, pedi VARCHAR(16) DEFAULT NULL, stat VARCHAR(16) DEFAULT NULL, INDEX IDX_62894749AE271C0D (individual_id), INDEX IDX_62894749C35E566A (family_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id)');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749C35E566A FOREIGN KEY (family_id) REFERENCES family (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE relation');
    }
}
