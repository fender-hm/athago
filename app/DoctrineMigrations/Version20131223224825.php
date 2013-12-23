<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131223224825 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE sale_company (id INT AUTO_INCREMENT NOT NULL, sale_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, logoName VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_3AA1CBDD4A7E4868 (sale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sale_image (id INT AUTO_INCREMENT NOT NULL, sale_id INT DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, tmp VARCHAR(255) DEFAULT NULL, INDEX IDX_15E15CDC4A7E4868 (sale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sale (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, fullTitle VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE sale_company ADD CONSTRAINT FK_3AA1CBDD4A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id)");
        $this->addSql("ALTER TABLE sale_image ADD CONSTRAINT FK_15E15CDC4A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE sale_company DROP FOREIGN KEY FK_3AA1CBDD4A7E4868");
        $this->addSql("ALTER TABLE sale_image DROP FOREIGN KEY FK_15E15CDC4A7E4868");
        $this->addSql("DROP TABLE sale_company");
        $this->addSql("DROP TABLE sale_image");
        $this->addSql("DROP TABLE sale");
    }
}
