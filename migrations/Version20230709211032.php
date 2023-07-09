<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230709211032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ref_elementary_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ref_pokemon_type (id INT AUTO_INCREMENT NOT NULL, type_1 INT DEFAULT NULL, type_2 INT DEFAULT NULL, trainer_id INT DEFAULT NULL, niveau INT DEFAULT NULL, starter TINYINT(1) NOT NULL, sellPrice INT DEFAULT NULL, xp VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, last_trained DATETIME DEFAULT NULL, realxp INT DEFAULT NULL, INDEX IDX_5483EF999C6D843C (type_1), INDEX IDX_5483EF99564D586 (type_2), INDEX IDX_5483EF99FB08EDF6 (trainer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ref_pokemon_type ADD CONSTRAINT FK_5483EF999C6D843C FOREIGN KEY (type_1) REFERENCES ref_elementary_type (id)');
        $this->addSql('ALTER TABLE ref_pokemon_type ADD CONSTRAINT FK_5483EF99564D586 FOREIGN KEY (type_2) REFERENCES ref_elementary_type (id)');
        $this->addSql('ALTER TABLE ref_pokemon_type ADD CONSTRAINT FK_5483EF99FB08EDF6 FOREIGN KEY (trainer_id) REFERENCES trainer (id)');
        $this->addSql('DROP TABLE pokemons');
        $this->addSql('ALTER TABLE trainer CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE pokedolls pokedolls INT DEFAULT NULL');
        $this->addSql('DROP INDEX type_id ON zone');
        $this->addSql('ALTER TABLE zone ADD type_id INT NOT NULL, DROP type, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE Montagne montagne TINYINT(1) DEFAULT NULL, CHANGE Prairie prairie TINYINT(1) DEFAULT NULL, CHANGE Ville ville TINYINT(1) DEFAULT NULL, CHANGE Foret foret TINYINT(1) DEFAULT NULL, CHANGE Plage plage TINYINT(1) DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_A0EBC007C54C8C93 ON zone (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zone DROP FOREIGN KEY FK_A0EBC007C54C8C93');
        $this->addSql('CREATE TABLE pokemons (id INT AUTO_INCREMENT NOT NULL, type_1_id INT DEFAULT NULL, type_2_id INT DEFAULT NULL, trainer_id_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_trained VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_3FD8B03D27DC99F2 (type_1_id), INDEX IDX_3FD8B03D3203CF3A (trainer_id_id), INDEX IDX_3FD8B03D3569361C (type_2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ref_pokemon_type DROP FOREIGN KEY FK_5483EF999C6D843C');
        $this->addSql('ALTER TABLE ref_pokemon_type DROP FOREIGN KEY FK_5483EF99564D586');
        $this->addSql('ALTER TABLE ref_pokemon_type DROP FOREIGN KEY FK_5483EF99FB08EDF6');
        $this->addSql('DROP TABLE ref_elementary_type');
        $this->addSql('DROP TABLE ref_pokemon_type');
        $this->addSql('ALTER TABLE trainer CHANGE pokedolls pokedolls INT DEFAULT 100, CHANGE password password VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_A0EBC007C54C8C93 ON zone');
        $this->addSql('ALTER TABLE zone ADD type INT DEFAULT NULL, DROP type_id, CHANGE id id INT NOT NULL, CHANGE foret Foret INT DEFAULT NULL, CHANGE montagne Montagne INT DEFAULT NULL, CHANGE ville Ville INT DEFAULT NULL, CHANGE plage Plage INT DEFAULT NULL, CHANGE prairie Prairie INT DEFAULT NULL');
        $this->addSql('CREATE INDEX type_id ON zone (type)');
    }
}
