<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200126121457 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE infrastructure_paris (infrastructure_id INT NOT NULL, paris_id INT NOT NULL, INDEX IDX_7DA4AF2A243E7A84 (infrastructure_id), INDEX IDX_7DA4AF2AD6F1A30E (paris_id), PRIMARY KEY(infrastructure_id, paris_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE infrastructure_paris ADD CONSTRAINT FK_7DA4AF2A243E7A84 FOREIGN KEY (infrastructure_id) REFERENCES infrastructure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE infrastructure_paris ADD CONSTRAINT FK_7DA4AF2AD6F1A30E FOREIGN KEY (paris_id) REFERENCES paris (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE infrastructure DROP FOREIGN KEY FK_D129B190DA6A219');
        $this->addSql('DROP INDEX IDX_D129B190DA6A219 ON infrastructure');
        $this->addSql('ALTER TABLE infrastructure DROP place_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE infrastructure_paris');
        $this->addSql('ALTER TABLE infrastructure ADD place_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE infrastructure ADD CONSTRAINT FK_D129B190DA6A219 FOREIGN KEY (place_id) REFERENCES paris (id)');
        $this->addSql('CREATE INDEX IDX_D129B190DA6A219 ON infrastructure (place_id)');
    }
}
