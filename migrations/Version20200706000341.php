<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200706000341 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, document VARCHAR(50) NOT NULL, email VARCHAR(40) NOT NULL, phone VARCHAR(40) NOT NULL, UNIQUE INDEX UNIQ_C7440455D8698A76 (document), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wallet (id INT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, client_id INT NOT NULL, total DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_7C68921F712520F3 (wallet_id), UNIQUE INDEX UNIQ_7C68921F19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, wallet_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, token VARCHAR(255) NOT NULL, approved TINYINT(1) NOT NULL, INDEX IDX_6D28840D712520F3 (wallet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921F19EB6921');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D712520F3');
        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921F712520F3');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE wallet');
    }
}
