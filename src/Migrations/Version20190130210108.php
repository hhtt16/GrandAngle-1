<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130210108 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE phone phone VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE artist CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE artist_media DROP FOREIGN KEY artist_media_ibfk_1');
        $this->addSql('ALTER TABLE artist_media DROP FOREIGN KEY artist_media_ibfk_2');
        $this->addSql('ALTER TABLE artist_media ADD CONSTRAINT FK_A20915FB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_media ADD CONSTRAINT FK_A20915FEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_work DROP FOREIGN KEY media_work_ibfk_1');
        $this->addSql('ALTER TABLE media_work DROP FOREIGN KEY media_work_ibfk_2');
        $this->addSql('ALTER TABLE media_work ADD CONSTRAINT FK_9009B753EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_work ADD CONSTRAINT FK_9009B753BB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work CHANGE length length DOUBLE PRECISION DEFAULT NULL, CHANGE width width DOUBLE PRECISION DEFAULT NULL, CHANGE height height DOUBLE PRECISION DEFAULT NULL, CHANGE weight weight DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE work_exhibition DROP FOREIGN KEY work_exhibition_ibfk_1');
        $this->addSql('ALTER TABLE work_exhibition DROP FOREIGN KEY work_exhibition_ibfk_2');
        $this->addSql('ALTER TABLE work_exhibition ADD CONSTRAINT FK_A3569E5ABB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE work_exhibition ADD CONSTRAINT FK_A3569E5A2A7D4494 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE phone phone VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE artist_media DROP FOREIGN KEY FK_A20915FB7970CF8');
        $this->addSql('ALTER TABLE artist_media DROP FOREIGN KEY FK_A20915FEA9FDD75');
        $this->addSql('ALTER TABLE artist_media ADD CONSTRAINT artist_media_ibfk_1 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE artist_media ADD CONSTRAINT artist_media_ibfk_2 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE media_work DROP FOREIGN KEY FK_9009B753EA9FDD75');
        $this->addSql('ALTER TABLE media_work DROP FOREIGN KEY FK_9009B753BB3453DB');
        $this->addSql('ALTER TABLE media_work ADD CONSTRAINT media_work_ibfk_1 FOREIGN KEY (work_id) REFERENCES work (id)');
        $this->addSql('ALTER TABLE media_work ADD CONSTRAINT media_work_ibfk_2 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE phone phone VARCHAR(150) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE work CHANGE length length DOUBLE PRECISION DEFAULT \'NULL\', CHANGE width width DOUBLE PRECISION DEFAULT \'NULL\', CHANGE height height DOUBLE PRECISION DEFAULT \'NULL\', CHANGE weight weight DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE work_exhibition DROP FOREIGN KEY FK_A3569E5ABB3453DB');
        $this->addSql('ALTER TABLE work_exhibition DROP FOREIGN KEY FK_A3569E5A2A7D4494');
        $this->addSql('ALTER TABLE work_exhibition ADD CONSTRAINT work_exhibition_ibfk_1 FOREIGN KEY (exhibition_id) REFERENCES exhibition (id)');
        $this->addSql('ALTER TABLE work_exhibition ADD CONSTRAINT work_exhibition_ibfk_2 FOREIGN KEY (work_id) REFERENCES work (id)');
    }
}
