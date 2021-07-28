<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210713110825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document_mot_clef (document_id INT NOT NULL, mot_clef_id INT NOT NULL, INDEX IDX_220681BDC33F7837 (document_id), INDEX IDX_220681BDE2959304 (mot_clef_id), PRIMARY KEY(document_id, mot_clef_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document_mot_clef ADD CONSTRAINT FK_220681BDC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_mot_clef ADD CONSTRAINT FK_220681BDE2959304 FOREIGN KEY (mot_clef_id) REFERENCES mot_clef (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE document_mot_clef');
    }
}
