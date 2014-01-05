<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140105171355 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE sliders_slides_ref");
        $this->addSql("ALTER TABLE sliders_slides ADD slider_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE sliders_slides ADD CONSTRAINT FK_91D195A72CCC9638 FOREIGN KEY (slider_id) REFERENCES sliders (id)");
        $this->addSql("CREATE INDEX IDX_91D195A72CCC9638 ON sliders_slides (slider_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE sliders_slides_ref (slider_id INT NOT NULL, slide_id INT NOT NULL, UNIQUE INDEX UNIQ_6D4B2B72DD5AFB87 (slide_id), INDEX IDX_6D4B2B722CCC9638 (slider_id), PRIMARY KEY(slider_id, slide_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE sliders_slides_ref ADD CONSTRAINT FK_6D4B2B722CCC9638 FOREIGN KEY (slider_id) REFERENCES sliders (id)");
        $this->addSql("ALTER TABLE sliders_slides_ref ADD CONSTRAINT FK_6D4B2B72DD5AFB87 FOREIGN KEY (slide_id) REFERENCES sliders_slides (id)");
        $this->addSql("ALTER TABLE sliders_slides DROP FOREIGN KEY FK_91D195A72CCC9638");
        $this->addSql("DROP INDEX IDX_91D195A72CCC9638 ON sliders_slides");
        $this->addSql("ALTER TABLE sliders_slides DROP slider_id");
    }
}
