<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128113850 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appuser ADD badgenumber VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP email, DROP badge_number, DROP first_name, DROP middle_name, DROP last_name');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EE8A7C74786755E4 ON appuser (badgenumber)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_EE8A7C74786755E4 ON appuser');
        $this->addSql('ALTER TABLE appuser ADD badge_number VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD first_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD middle_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD last_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP badgenumber, DROP roles, CHANGE password email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
