<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190201074933 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password VARCHAR(255) NOT NULL, lastname VARCHAR(150) NOT NULL, firstname VARCHAR(150) NOT NULL, photo LONGTEXT DEFAULT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, phone VARCHAR(150) DEFAULT NULL, hire_date DATE NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, lastname VARCHAR(150) NOT NULL, firstname VARCHAR(150) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(50) DEFAULT NULL, birth_date DATE NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_1599687A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_media (artist_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_A20915FB7970CF8 (artist_id), INDEX IDX_A20915FEA9FDD75 (media_id), PRIMARY KEY(artist_id, media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exhibition (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, map LONGTEXT NOT NULL, begin_date DATE NOT NULL, end_date DATE NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B8353389A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, link LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_work (media_id INT NOT NULL, work_id INT NOT NULL, INDEX IDX_9009B753EA9FDD75 (media_id), INDEX IDX_9009B753BB3453DB (work_id), PRIMARY KEY(media_id, work_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B6BD307FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, work_type_id INT NOT NULL, artist_id INT NOT NULL, length DOUBLE PRECISION DEFAULT NULL, width DOUBLE PRECISION DEFAULT NULL, height DOUBLE PRECISION DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, delivery_date DATE DEFAULT NULL, exit_date DATE DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_534E6880A76ED395 (user_id), INDEX IDX_534E6880108734B1 (work_type_id), INDEX IDX_534E6880B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_exhibition (work_id INT NOT NULL, exhibition_id INT NOT NULL, INDEX IDX_A3569E5ABB3453DB (work_id), INDEX IDX_A3569E5A2A7D4494 (exhibition_id), PRIMARY KEY(work_id, exhibition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work_type (id INT AUTO_INCREMENT NOT NULL, wording VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE artist_media ADD CONSTRAINT FK_A20915FB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_media ADD CONSTRAINT FK_A20915FEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exhibition ADD CONSTRAINT FK_B8353389A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE media_work ADD CONSTRAINT FK_9009B753EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_work ADD CONSTRAINT FK_9009B753BB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E6880A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E6880108734B1 FOREIGN KEY (work_type_id) REFERENCES work_type (id)');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E6880B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE work_exhibition ADD CONSTRAINT FK_A3569E5ABB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_exhibition ADD CONSTRAINT FK_A3569E5A2A7D4494 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687A76ED395');
        $this->addSql('ALTER TABLE exhibition DROP FOREIGN KEY FK_B8353389A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E6880A76ED395');
        $this->addSql('ALTER TABLE artist_media DROP FOREIGN KEY FK_A20915FB7970CF8');
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E6880B7970CF8');
        $this->addSql('ALTER TABLE work_exhibition DROP FOREIGN KEY FK_A3569E5A2A7D4494');
        $this->addSql('ALTER TABLE artist_media DROP FOREIGN KEY FK_A20915FEA9FDD75');
        $this->addSql('ALTER TABLE media_work DROP FOREIGN KEY FK_9009B753EA9FDD75');
        $this->addSql('ALTER TABLE media_work DROP FOREIGN KEY FK_9009B753BB3453DB');
        $this->addSql('ALTER TABLE work_exhibition DROP FOREIGN KEY FK_A3569E5ABB3453DB');
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E6880108734B1');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artist_media');
        $this->addSql('DROP TABLE exhibition');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE media_work');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE work');
        $this->addSql('DROP TABLE work_exhibition');
        $this->addSql('DROP TABLE work_type');
    }
}
