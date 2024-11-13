<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241113010736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture ADD nombre_proprietaires INT NOT NULL, ADD annee_mise_en_circulation INT NOT NULL, DROP nombre_proprietaire, DROP annee_circulation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture ADD nombre_proprietaire INT NOT NULL, ADD annee_circulation INT NOT NULL, DROP nombre_proprietaires, DROP annee_mise_en_circulation');
    }
}
