<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211213195548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239912D8C94');
        $this->addSql('DROP INDEX IDX_4DA239912D8C94 ON reservations');
        $this->addSql('ALTER TABLE reservations ADD uemail VARCHAR(180) DEFAULT NULL, DROP uemail_id');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239CB9DB6B8 FOREIGN KEY (uemail) REFERENCES user (email)');
        $this->addSql('CREATE INDEX IDX_4DA239CB9DB6B8 ON reservations (uemail)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239CB9DB6B8');
        $this->addSql('DROP INDEX IDX_4DA239CB9DB6B8 ON reservations');
        $this->addSql('ALTER TABLE reservations ADD uemail_id INT DEFAULT NULL, DROP uemail');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239912D8C94 FOREIGN KEY (uemail_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4DA239912D8C94 ON reservations (uemail_id)');
    }
}
