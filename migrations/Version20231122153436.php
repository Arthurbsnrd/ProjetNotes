<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122153436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON note');
        $this->addSql('ALTER TABLE note ADD matiere VARCHAR(255) NOT NULL, ADD coef_matiere VARCHAR(255) NOT NULL, DROP id, CHANGE date_d_ajout date_ajout DATETIME NOT NULL');
        $this->addSql('ALTER TABLE note ADD PRIMARY KEY (date_ajout)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note ADD id INT AUTO_INCREMENT NOT NULL, DROP matiere, DROP coef_matiere, CHANGE date_ajout date_d_ajout DATETIME NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
