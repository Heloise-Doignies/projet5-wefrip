<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230614082324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE user_creator_id user_creator_id INT DEFAULT NULL, CHANGE type_event_id type_event_id INT DEFAULT NULL, CHANGE infos_location_id infos_location_id INT DEFAULT NULL, CHANGE event_date event_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL, CHANGE user_slug user_slug VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP is_verified, CHANGE user_slug user_slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE event CHANGE user_creator_id user_creator_id INT NOT NULL, CHANGE type_event_id type_event_id INT NOT NULL, CHANGE infos_location_id infos_location_id INT NOT NULL, CHANGE event_date event_date VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\'');
    }
}
