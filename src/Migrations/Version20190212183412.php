<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190212183412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL, CHANGE phone phone VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE artist CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE work CHANGE length length DOUBLE PRECISION DEFAULT NULL, CHANGE width width DOUBLE PRECISION DEFAULT NULL, CHANGE height height DOUBLE PRECISION DEFAULT NULL, CHANGE weight weight DOUBLE PRECISION DEFAULT NULL, CHANGE delivery_date delivery_date DATE DEFAULT NULL, CHANGE exit_date exit_date DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE phone phone VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE photo photo LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE phone phone VARCHAR(150) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE work CHANGE length length DOUBLE PRECISION DEFAULT \'NULL\', CHANGE width width DOUBLE PRECISION DEFAULT \'NULL\', CHANGE height height DOUBLE PRECISION DEFAULT \'NULL\', CHANGE weight weight DOUBLE PRECISION DEFAULT \'NULL\', CHANGE delivery_date delivery_date DATE DEFAULT \'NULL\', CHANGE exit_date exit_date DATE DEFAULT \'NULL\'');
    }
}
