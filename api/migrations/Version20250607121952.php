<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250607121952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bean_type (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE coffee (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, roaster_id INT NOT NULL, roast_level_id INT DEFAULT NULL, rating_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_538529B3CA7ADAEA ON coffee (roaster_id)');
        $this->addSql('CREATE INDEX IDX_538529B34FD42A5A ON coffee (roast_level_id)');
        $this->addSql('CREATE INDEX IDX_538529B3A32EFC6 ON coffee (rating_id)');
        $this->addSql('CREATE TABLE coffee_origin (coffee_id INT NOT NULL, origin_id INT NOT NULL, PRIMARY KEY(coffee_id, origin_id))');
        $this->addSql('CREATE INDEX IDX_B6422FF078CD6D6E ON coffee_origin (coffee_id)');
        $this->addSql('CREATE INDEX IDX_B6422FF056A273CC ON coffee_origin (origin_id)');
        $this->addSql('CREATE TABLE coffee_bean (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, percent INT NOT NULL, coffee_id INT DEFAULT NULL, type_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_898BCA7178CD6D6E ON coffee_bean (coffee_id)');
        $this->addSql('CREATE INDEX IDX_898BCA71C54C8C93 ON coffee_bean (type_id)');
        $this->addSql('CREATE TABLE ingredient (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE journal (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, powder_weight NUMERIC(5, 2) NOT NULL, brewed_weight NUMERIC(5, 2) NOT NULL, pressure NUMERIC(4, 2) NOT NULL, duration NUMERIC(4, 2) NOT NULL, temperature INT NOT NULL, grind_level NUMERIC(5, 2) NOT NULL, grind_duration NUMERIC(4, 2) NOT NULL, date DATE NOT NULL, bean_age INT DEFAULT NULL, type_id INT NOT NULL, coffee_id INT NOT NULL, rating_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C1A7E74DC54C8C93 ON journal (type_id)');
        $this->addSql('CREATE INDEX IDX_C1A7E74D78CD6D6E ON journal (coffee_id)');
        $this->addSql('CREATE INDEX IDX_C1A7E74DA32EFC6 ON journal (rating_id)');
        $this->addSql('CREATE TABLE origin (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rating (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE recipe (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, info VARCHAR(255) DEFAULT NULL, preparation TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE recipe_ingredient (recipe_id INT NOT NULL, ingredient_id INT NOT NULL, PRIMARY KEY(recipe_id, ingredient_id))');
        $this->addSql('CREATE INDEX IDX_22D1FE1359D8A214 ON recipe_ingredient (recipe_id)');
        $this->addSql('CREATE INDEX IDX_22D1FE13933FE08C ON recipe_ingredient (ingredient_id)');
        $this->addSql('CREATE TABLE roast_level (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, level VARCHAR(255) DEFAULT \'medium\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE roaster (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, rating_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3798BD02A32EFC6 ON roaster (rating_id)');
        $this->addSql('CREATE TABLE roaster_origin (roaster_id INT NOT NULL, origin_id INT NOT NULL, PRIMARY KEY(roaster_id, origin_id))');
        $this->addSql('CREATE INDEX IDX_9A830CD6CA7ADAEA ON roaster_origin (roaster_id)');
        $this->addSql('CREATE INDEX IDX_9A830CD656A273CC ON roaster_origin (origin_id)');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3CA7ADAEA FOREIGN KEY (roaster_id) REFERENCES roaster (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B34FD42A5A FOREIGN KEY (roast_level_id) REFERENCES roast_level (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3A32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE coffee_origin ADD CONSTRAINT FK_B6422FF078CD6D6E FOREIGN KEY (coffee_id) REFERENCES coffee (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE coffee_origin ADD CONSTRAINT FK_B6422FF056A273CC FOREIGN KEY (origin_id) REFERENCES origin (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE coffee_bean ADD CONSTRAINT FK_898BCA7178CD6D6E FOREIGN KEY (coffee_id) REFERENCES coffee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE coffee_bean ADD CONSTRAINT FK_898BCA71C54C8C93 FOREIGN KEY (type_id) REFERENCES bean_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74DC54C8C93 FOREIGN KEY (type_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74D78CD6D6E FOREIGN KEY (coffee_id) REFERENCES coffee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE journal ADD CONSTRAINT FK_C1A7E74DA32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_ingredient ADD CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roaster ADD CONSTRAINT FK_3798BD02A32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roaster_origin ADD CONSTRAINT FK_9A830CD6CA7ADAEA FOREIGN KEY (roaster_id) REFERENCES roaster (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE roaster_origin ADD CONSTRAINT FK_9A830CD656A273CC FOREIGN KEY (origin_id) REFERENCES origin (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee DROP CONSTRAINT FK_538529B3CA7ADAEA');
        $this->addSql('ALTER TABLE coffee DROP CONSTRAINT FK_538529B34FD42A5A');
        $this->addSql('ALTER TABLE coffee DROP CONSTRAINT FK_538529B3A32EFC6');
        $this->addSql('ALTER TABLE coffee_origin DROP CONSTRAINT FK_B6422FF078CD6D6E');
        $this->addSql('ALTER TABLE coffee_origin DROP CONSTRAINT FK_B6422FF056A273CC');
        $this->addSql('ALTER TABLE coffee_bean DROP CONSTRAINT FK_898BCA7178CD6D6E');
        $this->addSql('ALTER TABLE coffee_bean DROP CONSTRAINT FK_898BCA71C54C8C93');
        $this->addSql('ALTER TABLE journal DROP CONSTRAINT FK_C1A7E74DC54C8C93');
        $this->addSql('ALTER TABLE journal DROP CONSTRAINT FK_C1A7E74D78CD6D6E');
        $this->addSql('ALTER TABLE journal DROP CONSTRAINT FK_C1A7E74DA32EFC6');
        $this->addSql('ALTER TABLE recipe_ingredient DROP CONSTRAINT FK_22D1FE1359D8A214');
        $this->addSql('ALTER TABLE recipe_ingredient DROP CONSTRAINT FK_22D1FE13933FE08C');
        $this->addSql('ALTER TABLE roaster DROP CONSTRAINT FK_3798BD02A32EFC6');
        $this->addSql('ALTER TABLE roaster_origin DROP CONSTRAINT FK_9A830CD6CA7ADAEA');
        $this->addSql('ALTER TABLE roaster_origin DROP CONSTRAINT FK_9A830CD656A273CC');
        $this->addSql('DROP TABLE bean_type');
        $this->addSql('DROP TABLE coffee');
        $this->addSql('DROP TABLE coffee_origin');
        $this->addSql('DROP TABLE coffee_bean');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE journal');
        $this->addSql('DROP TABLE origin');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_ingredient');
        $this->addSql('DROP TABLE roast_level');
        $this->addSql('DROP TABLE roaster');
        $this->addSql('DROP TABLE roaster_origin');
    }
}
