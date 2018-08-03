<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180725083547 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO product 
                            (category_id, name, price, description, update_at) 
                      VALUES (2, 'Ardis', '3200', 'Greet and good for rest!', now()),
                            (3, 'Electra', '6300', 'Long time save battery!', now()),
                            (1, 'Alpha', '8000', 'Mountain rest!', now()),
                            (4, 'Tisa', '2500', 'Happy kids!', now()),
                            (5, 'Altair', '7600', 'Retro rest!', now()),
                            (6, 'Tandem', '8100', 'Time together!', now())");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM product");
    }
}
