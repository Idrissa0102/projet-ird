<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210712135504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document_mot_clef DROP FOREIGN KEY FK_220681BDE2959304');
        $this->addSql('DROP TABLE document_mot_clef');
        $this->addSql('DROP TABLE mot_clef');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document_mot_clef (document_id INT NOT NULL, mot_clef_id INT NOT NULL, INDEX IDX_220681BDC33F7837 (document_id), INDEX IDX_220681BDE2959304 (mot_clef_id), PRIMARY KEY(document_id, mot_clef_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE mot_clef (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE document_mot_clef ADD CONSTRAINT FK_220681BDC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_mot_clef ADD CONSTRAINT FK_220681BDE2959304 FOREIGN KEY (mot_clef_id) REFERENCES mot_clef (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
