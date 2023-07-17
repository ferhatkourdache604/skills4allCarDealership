<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230715201651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_car (category_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_52FF4BC712469DE2 (category_id), INDEX IDX_52FF4BC7C3C6F69F (car_id), PRIMARY KEY(category_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_car ADD CONSTRAINT FK_52FF4BC712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_car ADD CONSTRAINT FK_52FF4BC7C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_car DROP FOREIGN KEY FK_52FF4BC712469DE2');
        $this->addSql('ALTER TABLE category_car DROP FOREIGN KEY FK_52FF4BC7C3C6F69F');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_car');
    }
}
