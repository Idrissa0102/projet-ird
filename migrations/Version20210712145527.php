<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210712145527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mot_clef_document');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mot_clef_document (mot_clef_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_911B2D54C33F7837 (document_id), INDEX IDX_911B2D54E2959304 (mot_clef_id), PRIMARY KEY(mot_clef_id, document_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE mot_clef_document ADD CONSTRAINT FK_911B2D54C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mot_clef_document ADD CONSTRAINT FK_911B2D54E2959304 FOREIGN KEY (mot_clef_id) REFERENCES mot_clef (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
