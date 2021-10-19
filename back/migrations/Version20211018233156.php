<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211018233156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE dance_rule_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE visitor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE dance_rule (id INT NOT NULL, genre VARCHAR(255) NOT NULL, body_rule VARCHAR(255) NOT NULL, hands_rule VARCHAR(255) NOT NULL, legs_rule VARCHAR(255) NOT NULL, head_rule VARCHAR(255) NOT NULL, relations JSONB DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE visitor (id INT NOT NULL, name VARCHAR(255) NOT NULL, genres JSONB NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE dance_rule_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE visitor_id_seq CASCADE');
        $this->addSql('DROP TABLE dance_rule');
        $this->addSql('DROP TABLE visitor');
    }
}
