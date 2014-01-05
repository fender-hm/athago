<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140105164419 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE pages ADD metatitle LONGTEXT DEFAULT NULL, ADD metadescription LONGTEXT DEFAULT NULL, ADD metakeywords LONGTEXT DEFAULT NULL");
        $this->addSql("ALTER TABLE sale ADD metatitle LONGTEXT DEFAULT NULL, ADD metadescription LONGTEXT DEFAULT NULL, ADD metakeywords LONGTEXT DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE pages DROP metatitle, DROP metadescription, DROP metakeywords");
        $this->addSql("ALTER TABLE sale DROP metatitle, DROP metadescription, DROP metakeywords");
    }
}
