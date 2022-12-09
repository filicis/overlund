<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209120011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_detail DROP addr, DROP adr1, DROP adr2, DROP adr3, DROP city, DROP stae, DROP post, DROP ctry, DROP phon, DROP email, DROP fax, DROP www');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event_detail ADD addr LONGTEXT DEFAULT NULL, ADD adr1 VARCHAR(60) DEFAULT NULL, ADD adr2 VARCHAR(60) DEFAULT NULL, ADD adr3 VARCHAR(60) DEFAULT NULL, ADD city VARCHAR(60) DEFAULT NULL, ADD stae VARCHAR(60) DEFAULT NULL, ADD post VARCHAR(20) DEFAULT NULL, ADD ctry VARCHAR(60) DEFAULT NULL, ADD phon LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD email LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD fax LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD www LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }
}
