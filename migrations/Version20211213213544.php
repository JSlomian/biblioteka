<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211213213544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239CB9DB6B8');
        $this->addSql('ALTER TABLE reservations CHANGE uemail uemail INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239CB9DB6B8 FOREIGN KEY (uemail) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239CB9DB6B8');
        $this->addSql('ALTER TABLE reservations CHANGE uemail uemail VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239CB9DB6B8 FOREIGN KEY (uemail) REFERENCES user (email)');
    }
}
