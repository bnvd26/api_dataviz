<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200210163729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subway_line (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subway_line_paris (subway_line_id INT NOT NULL, paris_id INT NOT NULL, INDEX IDX_3506F2F9CD2AC4BF (subway_line_id), INDEX IDX_3506F2F9D6F1A30E (paris_id), PRIMARY KEY(subway_line_id, paris_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subway_line_paris ADD CONSTRAINT FK_3506F2F9CD2AC4BF FOREIGN KEY (subway_line_id) REFERENCES subway_line (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subway_line_paris ADD CONSTRAINT FK_3506F2F9D6F1A30E FOREIGN KEY (paris_id) REFERENCES paris (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subway_line_paris DROP FOREIGN KEY FK_3506F2F9CD2AC4BF');
        $this->addSql('DROP TABLE subway_line');
        $this->addSql('DROP TABLE subway_line_paris');
    }
}
