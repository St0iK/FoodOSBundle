<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170314112131 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ProductCategory (Product_id INT NOT NULL, Category_id INT NOT NULL, INDEX IDX_D26EBFC4AD9658A (Product_id), INDEX IDX_D26EBFC494DA1235 (Category_id), PRIMARY KEY(Product_id, Category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ProductCategory ADD CONSTRAINT FK_D26EBFC4AD9658A FOREIGN KEY (Product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE ProductCategory ADD CONSTRAINT FK_D26EBFC494DA1235 FOREIGN KEY (Category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('ALTER TABLE category CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE weight weight INT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE weight weight INT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE price price NUMERIC(7, 2) DEFAULT NULL, CHANGE created created DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_category (product_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_CDFC73564584665A (product_id), INDEX IDX_CDFC735612469DE2 (category_id), PRIMARY KEY(product_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC735612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category ADD CONSTRAINT FK_CDFC73564584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE ProductCategory');
        $this->addSql('ALTER TABLE category CHANGE title title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE weight weight INT NOT NULL, CHANGE description description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, CHANGE created created DATETIME NOT NULL, CHANGE updated updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE fos_user DROP first_name, DROP last_name');
        $this->addSql('ALTER TABLE product CHANGE title title VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE weight weight INT NOT NULL, CHANGE description description LONGTEXT NOT NULL COLLATE utf8_unicode_ci, CHANGE price price NUMERIC(7, 2) NOT NULL, CHANGE created created DATETIME NOT NULL, CHANGE updated updated DATETIME NOT NULL');
    }
}
