<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222113708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B798F97CA');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B8A951AAD');
        $this->addSql('DROP INDEX UNIQ_A5E6215B798F97CA ON family');
        $this->addSql('DROP INDEX UNIQ_A5E6215B8A951AAD ON family');
        $this->addSql('ALTER TABLE family DROP husband_relation_id, DROP wife_relation_id');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749C35E566A');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749C35E566A FOREIGN KEY (family_id) REFERENCES family (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family ADD husband_relation_id INT DEFAULT NULL, ADD wife_relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B798F97CA FOREIGN KEY (husband_relation_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B8A951AAD FOREIGN KEY (wife_relation_id) REFERENCES relation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215B798F97CA ON family (husband_relation_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215B8A951AAD ON family (wife_relation_id)');
        $this->addSql('ALTER TABLE relation DROP FOREIGN KEY FK_62894749C35E566A');
        $this->addSql('ALTER TABLE relation ADD CONSTRAINT FK_62894749C35E566A FOREIGN KEY (family_id) REFERENCES family (id) ON DELETE CASCADE');
    }
}
