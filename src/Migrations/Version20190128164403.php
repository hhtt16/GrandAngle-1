<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190128164403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE work_type (id INT AUTO_INCREMENT NOT NULL, wording VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE phone phone VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE work ADD work_type_id INT NOT NULL, CHANGE length length DOUBLE PRECISION DEFAULT NULL, CHANGE width width DOUBLE PRECISION DEFAULT NULL, CHANGE height height DOUBLE PRECISION DEFAULT NULL, CHANGE weight weight DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E6880108734B1 FOREIGN KEY (work_type_id) REFERENCES work_type (id)');
        $this->addSql('CREATE INDEX IDX_534E6880108734B1 ON work (work_type_id)');
        $this->addSql('ALTER TABLE work_exhibition DROP FOREIGN KEY work_exhibition_ibfk_1');
        $this->addSql('ALTER TABLE work_exhibition DROP FOREIGN KEY work_exhibition_ibfk_2');
        $this->addSql('ALTER TABLE work_exhibition ADD CONSTRAINT FK_A3569E5ABB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_exhibition ADD CONSTRAINT FK_A3569E5A2A7D4494 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E6880108734B1');
        $this->addSql('DROP TABLE work_type');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE phone phone VARCHAR(150) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX IDX_534E6880108734B1 ON work');
        $this->addSql('ALTER TABLE work DROP work_type_id, CHANGE length length DOUBLE PRECISION DEFAULT \'NULL\', CHANGE width width DOUBLE PRECISION DEFAULT \'NULL\', CHANGE height height DOUBLE PRECISION DEFAULT \'NULL\', CHANGE weight weight DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE work_exhibition DROP FOREIGN KEY FK_A3569E5ABB3453DB');
        $this->addSql('ALTER TABLE work_exhibition DROP FOREIGN KEY FK_A3569E5A2A7D4494');
        $this->addSql('ALTER TABLE work_exhibition ADD CONSTRAINT work_exhibition_ibfk_1 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id)');
        $this->addSql('ALTER TABLE work_exhibition ADD CONSTRAINT work_exhibition_ibfk_2 FOREIGN KEY (work_id) REFERENCES work (id)');
    }
}
