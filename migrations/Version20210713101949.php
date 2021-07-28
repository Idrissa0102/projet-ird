<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210713101949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mot_clef ADD documents_id INT NOT NULL');
        $this->addSql('ALTER TABLE mot_clef ADD CONSTRAINT FK_ADC770E44272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)');
        $this->addSql('ALTER TABLE mot_clef ADD CONSTRAINT FK_ADC770E45F0F2752 FOREIGN KEY (documents_id) REFERENCES document (id)');
        $this->addSql('CREATE INDEX IDX_ADC770E44272FC9F ON mot_clef (domaine_id)');
        $this->addSql('CREATE INDEX IDX_ADC770E45F0F2752 ON mot_clef (documents_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mot_clef DROP FOREIGN KEY FK_ADC770E44272FC9F');
        $this->addSql('ALTER TABLE mot_clef DROP FOREIGN KEY FK_ADC770E45F0F2752');
        $this->addSql('DROP INDEX IDX_ADC770E44272FC9F ON mot_clef');
        $this->addSql('DROP INDEX IDX_ADC770E45F0F2752 ON mot_clef');
        $this->addSql('ALTER TABLE mot_clef DROP documents_id');
    }
}
