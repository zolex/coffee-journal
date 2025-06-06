<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250606045610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee_bean ADD coffee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE coffee_bean ADD CONSTRAINT FK_898BCA7178CD6D6E FOREIGN KEY (coffee_id) REFERENCES coffee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_898BCA7178CD6D6E ON coffee_bean (coffee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee_bean DROP CONSTRAINT FK_898BCA7178CD6D6E');
        $this->addSql('DROP INDEX IDX_898BCA7178CD6D6E');
        $this->addSql('ALTER TABLE coffee_bean DROP coffee_id');
    }
}
