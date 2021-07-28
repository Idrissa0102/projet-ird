<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210702143819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551F60BB6FE6');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, fichier_id INT DEFAULT NULL, type_document_id INT NOT NULL, domaine_id INT NOT NULL, langue_id INT NOT NULL, titre VARCHAR(255) NOT NULL, resume LONGTEXT NOT NULL, doi INT DEFAULT NULL, date_production DATE NOT NULL, licence VARCHAR(255) NOT NULL, classification LONGTEXT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, collaboration VARCHAR(255) DEFAULT NULL, url_lie VARCHAR(255) DEFAULT NULL, code_anr VARCHAR(255) DEFAULT NULL, ref_interne VARCHAR(255) DEFAULT NULL, projets_lies VARCHAR(255) DEFAULT NULL, financement VARCHAR(255) DEFAULT NULL, auteur_ajoute VARCHAR(255) DEFAULT NULL, affiliation VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D8698A76F915CFE (fichier_id), INDEX IDX_D8698A768826AFA6 (type_document_id), INDEX IDX_D8698A764272FC9F (domaine_id), INDEX IDX_D8698A762AADBACD (langue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document_mot_clef (document_id INT NOT NULL, mot_clef_id INT NOT NULL, INDEX IDX_220681BDC33F7837 (document_id), INDEX IDX_220681BDE2959304 (mot_clef_id), PRIMARY KEY(document_id, mot_clef_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE identifiants (id INT AUTO_INCREMENT NOT NULL, numero INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE langue (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mot_clef (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76F915CFE FOREIGN KEY (fichier_id) REFERENCES fichier (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A768826AFA6 FOREIGN KEY (type_document_id) REFERENCES type_document (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A764272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A762AADBACD FOREIGN KEY (langue_id) REFERENCES langue (id)');
        $this->addSql('ALTER TABLE document_mot_clef ADD CONSTRAINT FK_220681BDC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_mot_clef ADD CONSTRAINT FK_220681BDE2959304 FOREIGN KEY (mot_clef_id) REFERENCES mot_clef (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551F4272FC9F');
        $this->addSql('ALTER TABLE fichier DROP FOREIGN KEY FK_9B76551F8826AFA6');
        $this->addSql('DROP INDEX IDX_9B76551F4272FC9F ON fichier');
        $this->addSql('DROP INDEX IDX_9B76551F60BB6FE6 ON fichier');
        $this->addSql('DROP INDEX IDX_9B76551F8826AFA6 ON fichier');
        $this->addSql('ALTER TABLE fichier DROP auteur_id, DROP type_document_id, DROP domaine_id, DROP titre, DROP date, DROP upload_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document_mot_clef DROP FOREIGN KEY FK_220681BDC33F7837');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A762AADBACD');
        $this->addSql('ALTER TABLE document_mot_clef DROP FOREIGN KEY FK_220681BDE2959304');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone INT NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_mot_clef');
        $this->addSql('DROP TABLE identifiants');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE mot_clef');
        $this->addSql('ALTER TABLE fichier ADD auteur_id INT NOT NULL, ADD type_document_id INT NOT NULL, ADD domaine_id INT NOT NULL, ADD titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD date DATETIME NOT NULL, ADD upload_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551F4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551F60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE fichier ADD CONSTRAINT FK_9B76551F8826AFA6 FOREIGN KEY (type_document_id) REFERENCES type_document (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9B76551F4272FC9F ON fichier (domaine_id)');
        $this->addSql('CREATE INDEX IDX_9B76551F60BB6FE6 ON fichier (auteur_id)');
        $this->addSql('CREATE INDEX IDX_9B76551F8826AFA6 ON fichier (type_document_id)');
    }
}
