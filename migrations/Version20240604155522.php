<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240604155522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca ADD id_user_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_35BC7B5579F37AE5 ON ca (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ca DROP FOREIGN KEY FK_35BC7B5579F37AE5');
        $this->addSql('DROP INDEX IDX_35BC7B5579F37AE5 ON ca');
        $this->addSql('ALTER TABLE ca DROP id_user_id');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B29779F37AE5');
    }
}
