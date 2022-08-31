<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220828170912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family ADD locked TINYINT(1) NOT NULL, ADD confidential TINYINT(1) NOT NULL, ADD privacy TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE individual ADD locked TINYINT(1) NOT NULL, ADD confidential TINYINT(1) NOT NULL, ADD privacy TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family DROP locked, DROP confidential, DROP privacy');
        $this->addSql('ALTER TABLE individual DROP locked, DROP confidential, DROP privacy');
    }
}
