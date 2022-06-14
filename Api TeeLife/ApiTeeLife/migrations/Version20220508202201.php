<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508202201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diplome ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE institution ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit ADD addictif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE produit_rayon ADD id_rayon_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit_rayon ADD CONSTRAINT FK_E579DBA883FBC2C7 FOREIGN KEY (id_rayon_id) REFERENCES rayon_magasin (id)');
        $this->addSql('CREATE INDEX IDX_E579DBA883FBC2C7 ON produit_rayon (id_rayon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diplome DROP image');
        $this->addSql('ALTER TABLE institution DROP image');
        $this->addSql('ALTER TABLE produit DROP addictif');
        $this->addSql('ALTER TABLE produit_rayon DROP FOREIGN KEY FK_E579DBA883FBC2C7');
        $this->addSql('DROP INDEX IDX_E579DBA883FBC2C7 ON produit_rayon');
        $this->addSql('ALTER TABLE produit_rayon DROP id_rayon_id');
    }
}
