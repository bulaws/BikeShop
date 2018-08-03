<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180725080457 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql("INSERT INTO product_category 
                            (name) 
                      VALUES ('Горні'),
                            ('Шосейні'),
                            ('Електровелосипеди'),
                            ('Дитячі'),
                            ('Ретро'),
                            ('Дуєтні')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM product_category");
    }
}
