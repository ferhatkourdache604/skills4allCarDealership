<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230716005806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE engine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_car DROP FOREIGN KEY FK_52FF4BC712469DE2');
        $this->addSql('ALTER TABLE category_car DROP FOREIGN KEY FK_52FF4BC7C3C6F69F');
        $this->addSql('DROP TABLE category_car');
        $this->addSql('ALTER TABLE car ADD engine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DE78C9C0A FOREIGN KEY (engine_id) REFERENCES engine (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DE78C9C0A ON car (engine_id)');
        $this->addSql('ALTER TABLE car_category ADD CONSTRAINT FK_897A2CC5C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_category ADD CONSTRAINT FK_897A2CC512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DE78C9C0A');
        $this->addSql('CREATE TABLE category_car (category_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_52FF4BC712469DE2 (category_id), INDEX IDX_52FF4BC7C3C6F69F (car_id), PRIMARY KEY(category_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category_car ADD CONSTRAINT FK_52FF4BC712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_car ADD CONSTRAINT FK_52FF4BC7C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE engine');
        $this->addSql('DROP INDEX IDX_773DE69DE78C9C0A ON car');
        $this->addSql('ALTER TABLE car DROP engine_id');
        $this->addSql('ALTER TABLE car_category DROP FOREIGN KEY FK_897A2CC5C3C6F69F');
        $this->addSql('ALTER TABLE car_category DROP FOREIGN KEY FK_897A2CC512469DE2');
    }
}
