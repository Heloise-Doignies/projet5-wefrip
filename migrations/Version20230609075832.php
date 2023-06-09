<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609075832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(255) NOT NULL, category_slug VARCHAR(255) DEFAULT NULL, category_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, user_creator_id INT NOT NULL, type_event_id INT NOT NULL, infos_location_id INT NOT NULL, event_name VARCHAR(255) NOT NULL, event_date VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', event_description LONGTEXT NOT NULL, event_image_name VARCHAR(255) DEFAULT NULL, coordinate_lat DOUBLE PRECISION NOT NULL, coordinate_lng DOUBLE PRECISION NOT NULL, event_slug VARCHAR(255) NOT NULL, event_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3BAE0AA7C645C84A (user_creator_id), INDEX IDX_3BAE0AA7BC08CF77 (type_event_id), UNIQUE INDEX UNIQ_3BAE0AA75CE9B6D9 (infos_location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user_participant (event_id INT NOT NULL, user_participant_id INT NOT NULL, INDEX IDX_5894414C71F7E88B (event_id), INDEX IDX_5894414CF699EF40 (user_participant_id), PRIMARY KEY(event_id, user_participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favori (id INT AUTO_INCREMENT NOT NULL, is_fav TINYINT(1) DEFAULT NULL, fav_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_location (id INT AUTO_INCREMENT NOT NULL, user_creator_id INT NOT NULL, address VARCHAR(255) NOT NULL, info_loc_description VARCHAR(255) DEFAULT NULL, info_loc_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_49ABF2A1C645C84A (user_creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_location_user_participant (info_location_id INT NOT NULL, user_participant_id INT NOT NULL, INDEX IDX_37AEFE85D9750B71 (info_location_id), INDEX IDX_37AEFE85F699EF40 (user_participant_id), PRIMARY KEY(info_location_id, user_participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorial (id INT AUTO_INCREMENT NOT NULL, tuto_name VARCHAR(255) DEFAULT NULL, tuto_description LONGTEXT DEFAULT NULL, tuto_file_name VARCHAR(255) DEFAULT NULL, tuto_video_name VARCHAR(255) DEFAULT NULL, tuto_image_name VARCHAR(255) DEFAULT NULL, tuto_support_type VARCHAR(255) DEFAULT NULL, tuto_slug VARCHAR(255) NOT NULL, tuto_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorial_favori (tutorial_id INT NOT NULL, favori_id INT NOT NULL, INDEX IDX_D98EFAC189366B7B (tutorial_id), INDEX IDX_D98EFAC1FF17033F (favori_id), PRIMARY KEY(tutorial_id, favori_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorial_category (tutorial_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_D652884189366B7B (tutorial_id), INDEX IDX_D652884112469DE2 (category_id), PRIMARY KEY(tutorial_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_event (id INT AUTO_INCREMENT NOT NULL, type_vide_dressing_id INT DEFAULT NULL, type_name VARCHAR(255) NOT NULL, type_description LONGTEXT DEFAULT NULL, type_slug VARCHAR(255) NOT NULL, type_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_35A28D506CF8280 (type_vide_dressing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_vide_dressing (id INT AUTO_INCREMENT NOT NULL, clothes_gender VARCHAR(255) NOT NULL, clothes_size VARCHAR(255) NOT NULL, vide_dressing_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_creator_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) DEFAULT NULL, avatar_name VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, user_slug VARCHAR(255) NOT NULL, user_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649C645C84A (user_creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_favori (user_id INT NOT NULL, favori_id INT NOT NULL, INDEX IDX_8AD7B9F1A76ED395 (user_id), INDEX IDX_8AD7B9F1FF17033F (favori_id), PRIMARY KEY(user_id, favori_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user_participant (user_id INT NOT NULL, user_participant_id INT NOT NULL, INDEX IDX_391E059A76ED395 (user_id), INDEX IDX_391E059F699EF40 (user_participant_id), PRIMARY KEY(user_id, user_participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_creator (id INT AUTO_INCREMENT NOT NULL, creator_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_participant (id INT AUTO_INCREMENT NOT NULL, participant_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7C645C84A FOREIGN KEY (user_creator_id) REFERENCES user_creator (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7BC08CF77 FOREIGN KEY (type_event_id) REFERENCES type_event (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA75CE9B6D9 FOREIGN KEY (infos_location_id) REFERENCES info_location (id)');
        $this->addSql('ALTER TABLE event_user_participant ADD CONSTRAINT FK_5894414C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user_participant ADD CONSTRAINT FK_5894414CF699EF40 FOREIGN KEY (user_participant_id) REFERENCES user_participant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE info_location ADD CONSTRAINT FK_49ABF2A1C645C84A FOREIGN KEY (user_creator_id) REFERENCES user_creator (id)');
        $this->addSql('ALTER TABLE info_location_user_participant ADD CONSTRAINT FK_37AEFE85D9750B71 FOREIGN KEY (info_location_id) REFERENCES info_location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE info_location_user_participant ADD CONSTRAINT FK_37AEFE85F699EF40 FOREIGN KEY (user_participant_id) REFERENCES user_participant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tutorial_favori ADD CONSTRAINT FK_D98EFAC189366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tutorial_favori ADD CONSTRAINT FK_D98EFAC1FF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tutorial_category ADD CONSTRAINT FK_D652884189366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tutorial_category ADD CONSTRAINT FK_D652884112469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE type_event ADD CONSTRAINT FK_35A28D506CF8280 FOREIGN KEY (type_vide_dressing_id) REFERENCES type_vide_dressing (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C645C84A FOREIGN KEY (user_creator_id) REFERENCES user_creator (id)');
        $this->addSql('ALTER TABLE user_favori ADD CONSTRAINT FK_8AD7B9F1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_favori ADD CONSTRAINT FK_8AD7B9F1FF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_participant ADD CONSTRAINT FK_391E059A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_participant ADD CONSTRAINT FK_391E059F699EF40 FOREIGN KEY (user_participant_id) REFERENCES user_participant (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7C645C84A');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7BC08CF77');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA75CE9B6D9');
        $this->addSql('ALTER TABLE event_user_participant DROP FOREIGN KEY FK_5894414C71F7E88B');
        $this->addSql('ALTER TABLE event_user_participant DROP FOREIGN KEY FK_5894414CF699EF40');
        $this->addSql('ALTER TABLE info_location DROP FOREIGN KEY FK_49ABF2A1C645C84A');
        $this->addSql('ALTER TABLE info_location_user_participant DROP FOREIGN KEY FK_37AEFE85D9750B71');
        $this->addSql('ALTER TABLE info_location_user_participant DROP FOREIGN KEY FK_37AEFE85F699EF40');
        $this->addSql('ALTER TABLE tutorial_favori DROP FOREIGN KEY FK_D98EFAC189366B7B');
        $this->addSql('ALTER TABLE tutorial_favori DROP FOREIGN KEY FK_D98EFAC1FF17033F');
        $this->addSql('ALTER TABLE tutorial_category DROP FOREIGN KEY FK_D652884189366B7B');
        $this->addSql('ALTER TABLE tutorial_category DROP FOREIGN KEY FK_D652884112469DE2');
        $this->addSql('ALTER TABLE type_event DROP FOREIGN KEY FK_35A28D506CF8280');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C645C84A');
        $this->addSql('ALTER TABLE user_favori DROP FOREIGN KEY FK_8AD7B9F1A76ED395');
        $this->addSql('ALTER TABLE user_favori DROP FOREIGN KEY FK_8AD7B9F1FF17033F');
        $this->addSql('ALTER TABLE user_user_participant DROP FOREIGN KEY FK_391E059A76ED395');
        $this->addSql('ALTER TABLE user_user_participant DROP FOREIGN KEY FK_391E059F699EF40');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user_participant');
        $this->addSql('DROP TABLE favori');
        $this->addSql('DROP TABLE info_location');
        $this->addSql('DROP TABLE info_location_user_participant');
        $this->addSql('DROP TABLE tutorial');
        $this->addSql('DROP TABLE tutorial_favori');
        $this->addSql('DROP TABLE tutorial_category');
        $this->addSql('DROP TABLE type_event');
        $this->addSql('DROP TABLE type_vide_dressing');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_favori');
        $this->addSql('DROP TABLE user_user_participant');
        $this->addSql('DROP TABLE user_creator');
        $this->addSql('DROP TABLE user_participant');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
