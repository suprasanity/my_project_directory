<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703073819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ref_pokemon_type DROP FOREIGN KEY FK_type_2');
        $this->addSql('ALTER TABLE ref_pokemon_type DROP FOREIGN KEY FK_trainer_id');
        $this->addSql('ALTER TABLE ref_pokemon_type DROP FOREIGN KEY FK_type_1');
        $this->addSql('DROP TABLE ref_elementary_type');
        $this->addSql('DROP TABLE ref_pokemon_type');
        $this->addSql('ALTER TABLE trainer CHANGE password password VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ref_elementary_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ref_pokemon_type (id INT AUTO_INCREMENT NOT NULL, trainer_id INT DEFAULT NULL, type_1 INT DEFAULT NULL, type_2 INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_trained DATETIME DEFAULT NULL, INDEX FK_trainer_id (trainer_id), INDEX FK_type_2 (type_2), INDEX FK_type_1 (type_1), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ref_pokemon_type ADD CONSTRAINT FK_type_2 FOREIGN KEY (type_2) REFERENCES ref_elementary_type (id)');
        $this->addSql('ALTER TABLE ref_pokemon_type ADD CONSTRAINT FK_trainer_id FOREIGN KEY (trainer_id) REFERENCES trainer (id)');
        $this->addSql('ALTER TABLE ref_pokemon_type ADD CONSTRAINT FK_type_1 FOREIGN KEY (type_1) REFERENCES ref_elementary_type (id)');
        $this->addSql('ALTER TABLE trainer CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL');
    }
}
