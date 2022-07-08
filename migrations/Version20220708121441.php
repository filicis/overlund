<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220708121441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personal_name_structure DROP rin, DROP last_change, DROP crea, DROP xref');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personal_name_structure ADD rin VARCHAR(12) DEFAULT NULL, ADD last_change DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD crea VARCHAR(20) DEFAULT NULL, ADD xref VARCHAR(20) DEFAULT NULL');
    }
}
