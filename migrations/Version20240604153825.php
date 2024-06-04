<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240604153825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ca CHANGE id_user id_client INT NOT NULL');
        $this->addSql('DROP INDEX id ON profil');
        $this->addSql('ALTER TABLE profil ADD id_client INT NOT NULL, CHANGE id_user id_user_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6D6B29779F37AE5 ON profil (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE clients');
        $this->addSql('ALTER TABLE ca CHANGE id_client id_user INT NOT NULL');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B29779F37AE5');
        $this->addSql('DROP INDEX UNIQ_E6D6B29779F37AE5 ON profil');
        $this->addSql('ALTER TABLE profil ADD id_user INT NOT NULL, DROP id_user_id, DROP id_client');
        $this->addSql('CREATE INDEX id ON profil (id)');
    }
}
