<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131221214647 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE realistate_image (id INT AUTO_INCREMENT NOT NULL, realistate_id INT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, tmp VARCHAR(255) DEFAULT NULL, INDEX IDX_298D4C9BAF96ED04 (realistate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE realistate (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE realistate_image ADD CONSTRAINT FK_298D4C9BAF96ED04 FOREIGN KEY (realistate_id) REFERENCES realistate (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE realistate_image DROP FOREIGN KEY FK_298D4C9BAF96ED04");
        $this->addSql("DROP TABLE realistate_image");
        $this->addSql("DROP TABLE realistate");
    }
}
