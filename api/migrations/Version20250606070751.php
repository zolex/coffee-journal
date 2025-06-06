<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250606070751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE roaster_origin (roaster_id INT NOT NULL, origin_id INT NOT NULL, PRIMARY KEY(roaster_id, origin_id))');
        $this->addSql('CREATE INDEX IDX_9A830CD6CA7ADAEA ON roaster_origin (roaster_id)');
        $this->addSql('CREATE INDEX IDX_9A830CD656A273CC ON roaster_origin (origin_id)');
        $this->addSql('ALTER TABLE roaster_origin ADD CONSTRAINT FK_9A830CD6CA7ADAEA FOREIGN KEY (roaster_id) REFERENCES roaster (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roaster_origin ADD CONSTRAINT FK_9A830CD656A273CC FOREIGN KEY (origin_id) REFERENCES origin (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roaster DROP country');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE roaster_origin DROP CONSTRAINT FK_9A830CD6CA7ADAEA');
        $this->addSql('ALTER TABLE roaster_origin DROP CONSTRAINT FK_9A830CD656A273CC');
        $this->addSql('DROP TABLE roaster_origin');
        $this->addSql('ALTER TABLE roaster ADD country VARCHAR(255) NOT NULL');
    }
}
