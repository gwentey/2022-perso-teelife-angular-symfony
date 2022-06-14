<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220514163142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE composition_panier (id INT AUTO_INCREMENT NOT NULL, id_magasin_id INT DEFAULT NULL, id_personnage_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_E4CB11E28583EA34 (id_magasin_id), INDEX IDX_E4CB11E2E0198227 (id_personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composition_panier_produit_rayon (composition_panier_id INT NOT NULL, produit_rayon_id INT NOT NULL, INDEX IDX_7BA2EC849348F932 (composition_panier_id), INDEX IDX_7BA2EC84FA3F1C41 (produit_rayon_id), PRIMARY KEY(composition_panier_id, produit_rayon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composition_panier ADD CONSTRAINT FK_E4CB11E28583EA34 FOREIGN KEY (id_magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE composition_panier ADD CONSTRAINT FK_E4CB11E2E0198227 FOREIGN KEY (id_personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE composition_panier_produit_rayon ADD CONSTRAINT FK_7BA2EC849348F932 FOREIGN KEY (composition_panier_id) REFERENCES composition_panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composition_panier_produit_rayon ADD CONSTRAINT FK_7BA2EC84FA3F1C41 FOREIGN KEY (produit_rayon_id) REFERENCES produit_rayon (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B386CC499D ON utilisateur (pseudo)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE composition_panier_produit_rayon DROP FOREIGN KEY FK_7BA2EC849348F932');
        $this->addSql('DROP TABLE composition_panier');
        $this->addSql('DROP TABLE composition_panier_produit_rayon');
        $this->addSql('DROP INDEX UNIQ_1D1C63B386CC499D ON utilisateur');
    }
}
