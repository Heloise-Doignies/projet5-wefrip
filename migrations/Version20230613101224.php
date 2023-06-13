<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613101224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE user_creator_id user_creator_id INT DEFAULT NULL, CHANGE type_event_id type_event_id INT DEFAULT NULL, CHANGE infos_location_id infos_location_id INT DEFAULT NULL, CHANGE event_date event_date VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:dateinterval)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event CHANGE user_creator_id user_creator_id INT NOT NULL, CHANGE type_event_id type_event_id INT NOT NULL, CHANGE infos_location_id infos_location_id INT NOT NULL, CHANGE event_date event_date VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\'');
    }
}
