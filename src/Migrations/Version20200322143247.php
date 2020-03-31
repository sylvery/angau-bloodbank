<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322143247 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation ADD CONSTRAINT FK_31E581A03DD7B7A7 FOREIGN KEY (donor_id) REFERENCES donor (id)');
        $this->addSql('ALTER TABLE donation ADD CONSTRAINT FK_31E581A088823A92 FOREIGN KEY (locality_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE sicktype ADD CONSTRAINT FK_94CBF3B14DC1279C FOREIGN KEY (donation_id) REFERENCES donation (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation DROP FOREIGN KEY FK_31E581A03DD7B7A7');
        $this->addSql('ALTER TABLE donation DROP FOREIGN KEY FK_31E581A088823A92');
        $this->addSql('ALTER TABLE sicktype DROP FOREIGN KEY FK_94CBF3B14DC1279C');
    }
}
