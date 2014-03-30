<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140330195306 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
//        $this->addSql("ALTER TABLE sale ADD slug VARCHAR(128) NOT NULL");
        $stat = $this->connection->prepare('SELECT * FROM sale');
        $stat->execute();
        while ($row = $stat->fetch()) {
            $this->addSql("UPDATE sale SET slug = '" . uniqid() . "'");
        }
        $this->addSql("CREATE UNIQUE INDEX UNIQ_E54BC005989D9B62 ON sale (slug)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP INDEX UNIQ_E54BC005989D9B62 ON sale");
        $this->addSql("ALTER TABLE sale DROP slug");
    }
}
