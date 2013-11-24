<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131124215116 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE sliders_slides (id INT AUTO_INCREMENT NOT NULL, image_name VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sliders (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE sliders_slides_ref (slider_id INT NOT NULL, slide_id INT NOT NULL, INDEX IDX_6D4B2B722CCC9638 (slider_id), UNIQUE INDEX UNIQ_6D4B2B72DD5AFB87 (slide_id), PRIMARY KEY(slider_id, slide_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE sliders_slides_ref ADD CONSTRAINT FK_6D4B2B722CCC9638 FOREIGN KEY (slider_id) REFERENCES sliders (id)");
        $this->addSql("ALTER TABLE sliders_slides_ref ADD CONSTRAINT FK_6D4B2B72DD5AFB87 FOREIGN KEY (slide_id) REFERENCES sliders_slides (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE sliders_slides_ref DROP FOREIGN KEY FK_6D4B2B72DD5AFB87");
        $this->addSql("ALTER TABLE sliders_slides_ref DROP FOREIGN KEY FK_6D4B2B722CCC9638");
        $this->addSql("DROP TABLE sliders_slides");
        $this->addSql("DROP TABLE sliders");
        $this->addSql("DROP TABLE sliders_slides_ref");
    }
}
