<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230715203448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car_category (car_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_897A2CC5C3C6F69F (car_id), INDEX IDX_897A2CC512469DE2 (category_id), PRIMARY KEY(car_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car_category ADD CONSTRAINT FK_897A2CC5C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_category ADD CONSTRAINT FK_897A2CC512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car ADD color VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_category DROP FOREIGN KEY FK_897A2CC5C3C6F69F');
        $this->addSql('ALTER TABLE car_category DROP FOREIGN KEY FK_897A2CC512469DE2');
        $this->addSql('DROP TABLE car_category');
        $this->addSql('DROP TABLE category');
        $this->addSql('ALTER TABLE car DROP color');
    }
}
