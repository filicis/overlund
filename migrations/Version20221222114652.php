<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222114652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_628947493256915B');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749C35E566A');
        $this->addSql('DROP INDEX IDX_628947493256915B ON relation');
        $this->addSql('ALTER TABLE relation ADD individual_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', DROP relation_id');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749AE271C0D FOREIGN KEY (individual_id) REFERENCES individual (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749C35E566A FOREIGN KEY (family_id) REFERENCES family (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_62894749AE271C0D ON relation (individual_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749AE271C0D');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749C35E566A');
        $this->addSql('DROP INDEX IDX_62894749AE271C0D ON relation');
        $this->addSql('ALTER TABLE relation ADD relation_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', DROP individual_id');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_628947493256915B FOREIGN KEY (relation_id) REFERENCES individual (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749C35E566A FOREIGN KEY (family_id) REFERENCES family (id)');
        $this->addSql('CREATE INDEX IDX_628947493256915B ON relation (relation_id)');
    }
}
