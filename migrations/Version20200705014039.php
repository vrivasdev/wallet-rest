<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705014039 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DF43F82D');
        $this->addSql('DROP INDEX IDX_6D28840DF43F82D ON payment');
        $this->addSql('ALTER TABLE payment CHANGE wallet_id_id wallet_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('CREATE INDEX IDX_6D28840D712520F3 ON payment (wallet_id)');
        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921FDC2902E0');
        $this->addSql('DROP INDEX UNIQ_7C68921FDC2902E0 ON wallet');
        $this->addSql('ALTER TABLE wallet ADD client_id INT NOT NULL, CHANGE client_id_id wallet_id INT NOT NULL');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F712520F3 FOREIGN KEY (wallet_id) REFERENCES wallet (id)');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C68921F712520F3 ON wallet (wallet_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C68921F19EB6921 ON wallet (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D712520F3');
        $this->addSql('DROP INDEX IDX_6D28840D712520F3 ON payment');
        $this->addSql('ALTER TABLE payment CHANGE wallet_id wallet_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DF43F82D FOREIGN KEY (wallet_id_id) REFERENCES wallet (id)');
        $this->addSql('CREATE INDEX IDX_6D28840DF43F82D ON payment (wallet_id_id)');
        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921F712520F3');
        $this->addSql('ALTER TABLE wallet DROP FOREIGN KEY FK_7C68921F19EB6921');
        $this->addSql('DROP INDEX UNIQ_7C68921F712520F3 ON wallet');
        $this->addSql('DROP INDEX UNIQ_7C68921F19EB6921 ON wallet');
        $this->addSql('ALTER TABLE wallet ADD client_id_id INT NOT NULL, DROP wallet_id, DROP client_id');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT FK_7C68921FDC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C68921FDC2902E0 ON wallet (client_id_id)');
    }
}
