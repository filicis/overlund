<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220929214927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B6C9A17CA');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215BBCCF1946');
        $this->addSql('DROP INDEX UNIQ_A5E6215B6C9A17CA ON family');
        $this->addSql('DROP INDEX UNIQ_A5E6215BBCCF1946 ON family');
        $this->addSql('ALTER TABLE family ADD husband_relation_id INT DEFAULT NULL, ADD wife_relation_id INT DEFAULT NULL, DROP _husb_id, DROP _wife_id');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B798F97CA FOREIGN KEY (husband_relation_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B8A951AAD FOREIGN KEY (wife_relation_id) REFERENCES relation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215B798F97CA ON family (husband_relation_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215B8A951AAD ON family (wife_relation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B798F97CA');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B8A951AAD');
        $this->addSql('DROP INDEX UNIQ_A5E6215B798F97CA ON family');
        $this->addSql('DROP INDEX UNIQ_A5E6215B8A951AAD ON family');
        $this->addSql('ALTER TABLE family ADD _husb_id INT DEFAULT NULL, ADD _wife_id INT DEFAULT NULL, DROP husband_relation_id, DROP wife_relation_id');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B6C9A17CA FOREIGN KEY (_wife_id) REFERENCES relation (id)');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215BBCCF1946 FOREIGN KEY (_husb_id) REFERENCES relation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215B6C9A17CA ON family (_wife_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A5E6215BBCCF1946 ON family (_husb_id)');
    }
}
