<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250606045308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee_bean DROP CONSTRAINT fk_898bca7178cd6d6e');
        $this->addSql('DROP INDEX idx_898bca7178cd6d6e');
        $this->addSql('ALTER TABLE coffee_bean DROP coffee_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee_bean ADD coffee_id INT NOT NULL');
        $this->addSql('ALTER TABLE coffee_bean ADD CONSTRAINT fk_898bca7178cd6d6e FOREIGN KEY (coffee_id) REFERENCES coffee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_898bca7178cd6d6e ON coffee_bean (coffee_id)');
    }
}
