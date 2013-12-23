<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131223234540 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE sale_companies (sale_id INT NOT NULL, company_id INT NOT NULL, INDEX IDX_B45994204A7E4868 (sale_id), INDEX IDX_B4599420979B1AD6 (company_id), PRIMARY KEY(sale_id, company_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE sale_companies ADD CONSTRAINT FK_B45994204A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE sale_companies ADD CONSTRAINT FK_B4599420979B1AD6 FOREIGN KEY (company_id) REFERENCES sale_company (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("DROP TABLE sale_companies");
    }
}
