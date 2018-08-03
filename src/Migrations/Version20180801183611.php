<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180801183611 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F03DE18E50B');
        $this->addSql('DROP INDEX UNIQ_64617F03DE18E50B ON product_image');
        $this->addSql('ALTER TABLE product_image CHANGE path path VARCHAR(255) NOT NULL, CHANGE product_id_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F034584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64617F034584665A ON product_image (product_id)');
        $this->addSql("INSERT INTO product_image
                                    ( path,product_id)
                            VALUES ('productImg/bike1.jpeg',7),
                                    ('productImg/bike5.png',8),
                                    ('productImg/bike3.jpeg',9),
                                    ('productImg/bike4.jpeg',10),
                                    ('productImg/bike2.jpeg',11),
                                    ('productImg/bike6.png',12)");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("DELETE FROM product_image");
        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F034584665A');
        $this->addSql('DROP INDEX UNIQ_64617F034584665A ON product_image');
        $this->addSql('ALTER TABLE product_image CHANGE path path VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE product_id product_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F03DE18E50B FOREIGN KEY (product_id_id) REFERENCES product_category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64617F03DE18E50B ON product_image (product_id_id)');
    }
}
