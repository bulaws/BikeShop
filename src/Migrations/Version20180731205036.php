<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180731205036 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE page_content (id INT AUTO_INCREMENT NOT NULL, page_name VARCHAR(100) NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, update_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql("INSERT INTO page_content 
                            ( page_name, title, content, update_at) 
                      VALUES ('main', 'BikeShop', 'Lorem Ipsum - це текст-\"риба\", що використовується в друкарстві та дизайні. Lorem Ipsum є,
                фактично, стандартною \"рибою\" аж з XVI сторіччя, коли невідомий друкар взяв шрифтову гранку
                та склав на ній підбірку зразків шрифтів. \"Риба\" не тільки успішно пережила  століть, але й
                прижилася в електронному верстуванні, залишаючись по суті незмінною. Вона популяризувалась в 60-их
                роках минулого сторіччя завдяки виданню зразків шрифтів Letraset, які містили уривки з Lorem Ipsum,
                і вдруге - нещодавно завдяки програмам  верстування на кшталт Aldus Pagemaker,
                які використовували різні версії Lorem Ipsum.', now()),
                             ('service', 'Service', ' Для нас дуже важлива ділова репутація — ми відповідаємо за те, що продаємо і намагаємося
                йти клієнтові назустріч у вирішенні будь-яких спірних ситуацій. Наші товари і послуги
                високо оцінюються не тільки серед споживачів, але і в професійному колі. Ми даємо
                гарантію на кожен проданий нами велосипед. У нас Ви знайдете велосипеди відомих світових
                брендів і найякісніші аксесуари. Просто загляньте до нас і самі переконаєтеся в цьому.
                В магазині є веломайстерня. Наші майстри фахово проведуть ремонт вашого велосипеда. Все
                що потрібно починаючому і досвідченому велосипедистові ви знайдете у нас!', now()),
                             ('contact', 'Contact', ' м.Київ вул.Сармат тел. (044)-111-11-11 info@mail.com', now())");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql("DELETE FROM page_content");
        $this->addSql('DROP TABLE page_content');


    }
}
