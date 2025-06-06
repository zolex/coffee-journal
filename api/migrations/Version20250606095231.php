<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250606095231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee ADD rating_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3A32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_538529B3A32EFC6 ON coffee (rating_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee DROP CONSTRAINT FK_538529B3A32EFC6');
        $this->addSql('DROP INDEX IDX_538529B3A32EFC6');
        $this->addSql('ALTER TABLE coffee DROP rating_id');
    }
}
