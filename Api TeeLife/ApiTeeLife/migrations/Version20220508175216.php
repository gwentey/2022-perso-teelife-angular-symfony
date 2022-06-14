<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508175216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addictions_personnage (id INT AUTO_INCREMENT NOT NULL, id_personnage_id INT DEFAULT NULL, id_produit_id INT DEFAULT NULL, INDEX IDX_41F8644FE0198227 (id_personnage_id), INDEX IDX_41F8644FAABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE banque (id INT AUTO_INCREMENT NOT NULL, id_entreprise_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_B1F6CB3C1A867E8F (id_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte_bancaire (id INT AUTO_INCREMENT NOT NULL, id_personnage_id INT NOT NULL, id_banque_id INT DEFAULT NULL, solde BIGINT NOT NULL, INDEX IDX_50BC21DEE0198227 (id_personnage_id), INDEX IDX_50BC21DEB7D53CFE (id_banque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte_bancaire_interraction (id INT AUTO_INCREMENT NOT NULL, numero_cb_id INT DEFAULT NULL, montant BIGINT NOT NULL, negatif_ou_positif TINYINT(1) NOT NULL, INDEX IDX_201A37FBBFC0F217 (numero_cb_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplome (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplomes_personnage (id INT AUTO_INCREMENT NOT NULL, id_personnage_id INT NOT NULL, id_diplome_id INT NOT NULL, INDEX IDX_B24C548CE0198227 (id_personnage_id), INDEX IDX_B24C548C8372D935 (id_diplome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, id_createur_id INT NOT NULL, id_ville_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_D19FA606BB0CC12 (id_createur_id), INDEX IDX_D19FA60F7E4ECA3 (id_ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE institution (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interactions_personnage (id INT AUTO_INCREMENT NOT NULL, id_personnage_id INT NOT NULL, bisous BIGINT NOT NULL, calins BIGINT NOT NULL, charmes BIGINT NOT NULL, sourires BIGINT NOT NULL, clins_doeil BIGINT NOT NULL, mains_serrees BIGINT NOT NULL, gifles BIGINT NOT NULL, corche_pieds BIGINT NOT NULL, UNIQUE INDEX UNIQ_5DB5C4C4E0198227 (id_personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE magasin (id INT AUTO_INCREMENT NOT NULL, id_entreprise_id INT NOT NULL, nom VARCHAR(255) NOT NULL, presentation_courte VARCHAR(255) DEFAULT NULL, image_affichage VARCHAR(255) DEFAULT NULL, image_couverture VARCHAR(255) DEFAULT NULL, presentation VARCHAR(255) DEFAULT NULL, INDEX IDX_54AF5F271A867E8F (id_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, id_ville_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, INDEX IDX_6AEA486DC6EE5C49 (id_utilisateur_id), INDEX IDX_6AEA486DF7E4ECA3 (id_ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_rayon (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT DEFAULT NULL, quantite BIGINT NOT NULL, prix NUMERIC(10, 2) NOT NULL, INDEX IDX_E579DBA8AABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rayon_magasin (id INT AUTO_INCREMENT NOT NULL, id_magasin_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_12CCA7A48583EA34 (id_magasin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sante_personnage (id INT AUTO_INCREMENT NOT NULL, id_personnage_id INT NOT NULL, vitalite BIGINT NOT NULL, faim BIGINT NOT NULL, soif BIGINT NOT NULL, sante BIGINT NOT NULL, physique BIGINT NOT NULL, bonheur BIGINT NOT NULL, gentilesse BIGINT NOT NULL, proprete BIGINT NOT NULL, maladie BIGINT NOT NULL, urine BIGINT NOT NULL, selles BIGINT NOT NULL, dechets BIGINT NOT NULL, UNIQUE INDEX UNIQ_E0C0CEFE0198227 (id_personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE situation_personnage (id INT AUTO_INCREMENT NOT NULL, id_personnage_id INT NOT NULL, argent_liquide NUMERIC(10, 2) NOT NULL, goldentee BIGINT NOT NULL, argent_sale NUMERIC(10, 2) NOT NULL, UNIQUE INDEX UNIQ_3BEF811BE0198227 (id_personnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE addictions_personnage ADD CONSTRAINT FK_41F8644FE0198227 FOREIGN KEY (id_personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE addictions_personnage ADD CONSTRAINT FK_41F8644FAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE banque ADD CONSTRAINT FK_B1F6CB3C1A867E8F FOREIGN KEY (id_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE compte_bancaire ADD CONSTRAINT FK_50BC21DEE0198227 FOREIGN KEY (id_personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE compte_bancaire ADD CONSTRAINT FK_50BC21DEB7D53CFE FOREIGN KEY (id_banque_id) REFERENCES banque (id)');
        $this->addSql('ALTER TABLE compte_bancaire_interraction ADD CONSTRAINT FK_201A37FBBFC0F217 FOREIGN KEY (numero_cb_id) REFERENCES compte_bancaire (id)');
        $this->addSql('ALTER TABLE diplomes_personnage ADD CONSTRAINT FK_B24C548CE0198227 FOREIGN KEY (id_personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE diplomes_personnage ADD CONSTRAINT FK_B24C548C8372D935 FOREIGN KEY (id_diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA606BB0CC12 FOREIGN KEY (id_createur_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60F7E4ECA3 FOREIGN KEY (id_ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE interactions_personnage ADD CONSTRAINT FK_5DB5C4C4E0198227 FOREIGN KEY (id_personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE magasin ADD CONSTRAINT FK_54AF5F271A867E8F FOREIGN KEY (id_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486DF7E4ECA3 FOREIGN KEY (id_ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE produit_rayon ADD CONSTRAINT FK_E579DBA8AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE rayon_magasin ADD CONSTRAINT FK_12CCA7A48583EA34 FOREIGN KEY (id_magasin_id) REFERENCES magasin (id)');
        $this->addSql('ALTER TABLE sante_personnage ADD CONSTRAINT FK_E0C0CEFE0198227 FOREIGN KEY (id_personnage_id) REFERENCES personnage (id)');
        $this->addSql('ALTER TABLE situation_personnage ADD CONSTRAINT FK_3BEF811BE0198227 FOREIGN KEY (id_personnage_id) REFERENCES personnage (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte_bancaire DROP FOREIGN KEY FK_50BC21DEB7D53CFE');
        $this->addSql('ALTER TABLE compte_bancaire_interraction DROP FOREIGN KEY FK_201A37FBBFC0F217');
        $this->addSql('ALTER TABLE diplomes_personnage DROP FOREIGN KEY FK_B24C548C8372D935');
        $this->addSql('ALTER TABLE banque DROP FOREIGN KEY FK_B1F6CB3C1A867E8F');
        $this->addSql('ALTER TABLE magasin DROP FOREIGN KEY FK_54AF5F271A867E8F');
        $this->addSql('ALTER TABLE rayon_magasin DROP FOREIGN KEY FK_12CCA7A48583EA34');
        $this->addSql('ALTER TABLE addictions_personnage DROP FOREIGN KEY FK_41F8644FE0198227');
        $this->addSql('ALTER TABLE compte_bancaire DROP FOREIGN KEY FK_50BC21DEE0198227');
        $this->addSql('ALTER TABLE diplomes_personnage DROP FOREIGN KEY FK_B24C548CE0198227');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA606BB0CC12');
        $this->addSql('ALTER TABLE interactions_personnage DROP FOREIGN KEY FK_5DB5C4C4E0198227');
        $this->addSql('ALTER TABLE sante_personnage DROP FOREIGN KEY FK_E0C0CEFE0198227');
        $this->addSql('ALTER TABLE situation_personnage DROP FOREIGN KEY FK_3BEF811BE0198227');
        $this->addSql('ALTER TABLE addictions_personnage DROP FOREIGN KEY FK_41F8644FAABEFE2C');
        $this->addSql('ALTER TABLE produit_rayon DROP FOREIGN KEY FK_E579DBA8AABEFE2C');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486DC6EE5C49');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60F7E4ECA3');
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486DF7E4ECA3');
        $this->addSql('DROP TABLE addictions_personnage');
        $this->addSql('DROP TABLE banque');
        $this->addSql('DROP TABLE compte_bancaire');
        $this->addSql('DROP TABLE compte_bancaire_interraction');
        $this->addSql('DROP TABLE diplome');
        $this->addSql('DROP TABLE diplomes_personnage');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE institution');
        $this->addSql('DROP TABLE interactions_personnage');
        $this->addSql('DROP TABLE magasin');
        $this->addSql('DROP TABLE personnage');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_rayon');
        $this->addSql('DROP TABLE rayon_magasin');
        $this->addSql('DROP TABLE sante_personnage');
        $this->addSql('DROP TABLE situation_personnage');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE ville');
    }
}
