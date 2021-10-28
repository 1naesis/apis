<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211028161926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE device_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, phone VARCHAR(20) NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, state VARCHAR(20) DEFAULT NULL, operator VARCHAR(20) DEFAULT NULL, region VARCHAR(64) DEFAULT NULL, names VARCHAR(255) DEFAULT NULL, vk VARCHAR(128) DEFAULT NULL, insta VARCHAR(128) DEFAULT NULL, fb VARCHAR(128) DEFAULT NULL, email VARCHAR(64) DEFAULT NULL, day_birdth VARCHAR(16) DEFAULT NULL, tg VARCHAR(128) DEFAULT NULL, whatsapp VARCHAR(128) DEFAULT NULL, viber VARCHAR(128) DEFAULT NULL, ok VARCHAR(128) DEFAULT NULL, adress VARCHAR(700) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE device (id INT NOT NULL, uid VARCHAR(25) NOT NULL, try SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX unique_map_idx ON device (uid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE device_id_seq CASCADE');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE device');
    }
}
