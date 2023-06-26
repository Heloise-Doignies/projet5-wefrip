<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230626125821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_event DROP FOREIGN KEY FK_35A28D506CF8280');
        $this->addSql('DROP TABLE type_vide_dressing');
        $this->addSql('DROP INDEX UNIQ_35A28D506CF8280 ON type_event');
        $this->addSql('ALTER TABLE type_event DROP type_vide_dressing_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_vide_dressing (id INT AUTO_INCREMENT NOT NULL, clothes_gender VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, clothes_size VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE type_event ADD type_vide_dressing_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_event ADD CONSTRAINT FK_35A28D506CF8280 FOREIGN KEY (type_vide_dressing_id) REFERENCES type_vide_dressing (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_35A28D506CF8280 ON type_event (type_vide_dressing_id)');
    }
}
