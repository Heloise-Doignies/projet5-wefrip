<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230620075946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA75CE9B6D9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C645C84A');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7C645C84A');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tutorial (user_id INT NOT NULL, tutorial_id INT NOT NULL, INDEX IDX_26E61BE9A76ED395 (user_id), INDEX IDX_26E61BE989366B7B (tutorial_id), PRIMARY KEY(user_id, tutorial_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tutorial ADD CONSTRAINT FK_26E61BE9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tutorial ADD CONSTRAINT FK_26E61BE989366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_participant DROP FOREIGN KEY FK_391E059A76ED395');
        $this->addSql('ALTER TABLE user_user_participant DROP FOREIGN KEY FK_391E059F699EF40');
        $this->addSql('ALTER TABLE event_user_participant DROP FOREIGN KEY FK_5894414C71F7E88B');
        $this->addSql('ALTER TABLE event_user_participant DROP FOREIGN KEY FK_5894414CF699EF40');
        $this->addSql('ALTER TABLE info_location DROP FOREIGN KEY FK_49ABF2A1C645C84A');
        $this->addSql('ALTER TABLE tutorial_favori DROP FOREIGN KEY FK_D98EFAC189366B7B');
        $this->addSql('ALTER TABLE tutorial_favori DROP FOREIGN KEY FK_D98EFAC1FF17033F');
        $this->addSql('ALTER TABLE user_favori DROP FOREIGN KEY FK_8AD7B9F1A76ED395');
        $this->addSql('ALTER TABLE user_favori DROP FOREIGN KEY FK_8AD7B9F1FF17033F');
        $this->addSql('ALTER TABLE info_location_user_participant DROP FOREIGN KEY FK_37AEFE85D9750B71');
        $this->addSql('ALTER TABLE info_location_user_participant DROP FOREIGN KEY FK_37AEFE85F699EF40');
        $this->addSql('DROP TABLE favori');
        $this->addSql('DROP TABLE user_user_participant');
        $this->addSql('DROP TABLE event_user_participant');
        $this->addSql('DROP TABLE info_location');
        $this->addSql('DROP TABLE tutorial_favori');
        $this->addSql('DROP TABLE user_participant');
        $this->addSql('DROP TABLE user_favori');
        $this->addSql('DROP TABLE user_creator');
        $this->addSql('DROP TABLE info_location_user_participant');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA75CE9B6D9 ON event');
        $this->addSql('DROP INDEX IDX_3BAE0AA7C645C84A ON event');
        $this->addSql('ALTER TABLE event ADD creator_id INT DEFAULT NULL, ADD info_location LONGTEXT NOT NULL, DROP user_creator_id, DROP infos_location_id');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA761220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA761220EA6 ON event (creator_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649C645C84A ON user');
        $this->addSql('ALTER TABLE user DROP user_creator_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favori (id INT AUTO_INCREMENT NOT NULL, is_fav TINYINT(1) DEFAULT NULL, fav_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_user_participant (user_id INT NOT NULL, user_participant_id INT NOT NULL, INDEX IDX_391E059A76ED395 (user_id), INDEX IDX_391E059F699EF40 (user_participant_id), PRIMARY KEY(user_id, user_participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE event_user_participant (event_id INT NOT NULL, user_participant_id INT NOT NULL, INDEX IDX_5894414C71F7E88B (event_id), INDEX IDX_5894414CF699EF40 (user_participant_id), PRIMARY KEY(event_id, user_participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE info_location (id INT AUTO_INCREMENT NOT NULL, user_creator_id INT NOT NULL, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, info_loc_description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, info_loc_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_49ABF2A1C645C84A (user_creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tutorial_favori (tutorial_id INT NOT NULL, favori_id INT NOT NULL, INDEX IDX_D98EFAC189366B7B (tutorial_id), INDEX IDX_D98EFAC1FF17033F (favori_id), PRIMARY KEY(tutorial_id, favori_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_participant (id INT AUTO_INCREMENT NOT NULL, participant_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_favori (user_id INT NOT NULL, favori_id INT NOT NULL, INDEX IDX_8AD7B9F1A76ED395 (user_id), INDEX IDX_8AD7B9F1FF17033F (favori_id), PRIMARY KEY(user_id, favori_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_creator (id INT AUTO_INCREMENT NOT NULL, creator_updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE info_location_user_participant (info_location_id INT NOT NULL, user_participant_id INT NOT NULL, INDEX IDX_37AEFE85D9750B71 (info_location_id), INDEX IDX_37AEFE85F699EF40 (user_participant_id), PRIMARY KEY(info_location_id, user_participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_user_participant ADD CONSTRAINT FK_391E059A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_participant ADD CONSTRAINT FK_391E059F699EF40 FOREIGN KEY (user_participant_id) REFERENCES user_participant (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user_participant ADD CONSTRAINT FK_5894414C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user_participant ADD CONSTRAINT FK_5894414CF699EF40 FOREIGN KEY (user_participant_id) REFERENCES user_participant (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE info_location ADD CONSTRAINT FK_49ABF2A1C645C84A FOREIGN KEY (user_creator_id) REFERENCES user_creator (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE tutorial_favori ADD CONSTRAINT FK_D98EFAC189366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tutorial_favori ADD CONSTRAINT FK_D98EFAC1FF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_favori ADD CONSTRAINT FK_8AD7B9F1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_favori ADD CONSTRAINT FK_8AD7B9F1FF17033F FOREIGN KEY (favori_id) REFERENCES favori (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE info_location_user_participant ADD CONSTRAINT FK_37AEFE85D9750B71 FOREIGN KEY (info_location_id) REFERENCES info_location (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE info_location_user_participant ADD CONSTRAINT FK_37AEFE85F699EF40 FOREIGN KEY (user_participant_id) REFERENCES user_participant (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('ALTER TABLE user_tutorial DROP FOREIGN KEY FK_26E61BE9A76ED395');
        $this->addSql('ALTER TABLE user_tutorial DROP FOREIGN KEY FK_26E61BE989366B7B');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE user_tutorial');
        $this->addSql('ALTER TABLE user ADD user_creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C645C84A FOREIGN KEY (user_creator_id) REFERENCES user_creator (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C645C84A ON user (user_creator_id)');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA761220EA6');
        $this->addSql('DROP INDEX IDX_3BAE0AA761220EA6 ON event');
        $this->addSql('ALTER TABLE event ADD infos_location_id INT DEFAULT NULL, DROP info_location, CHANGE creator_id user_creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA75CE9B6D9 FOREIGN KEY (infos_location_id) REFERENCES info_location (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7C645C84A FOREIGN KEY (user_creator_id) REFERENCES user_creator (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA75CE9B6D9 ON event (infos_location_id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7C645C84A ON event (user_creator_id)');
    }
}
