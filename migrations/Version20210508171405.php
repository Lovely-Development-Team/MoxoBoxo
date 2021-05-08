<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210508171405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE motto (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, nominated_by_id INT NOT NULL, motto LONGTEXT DEFAULT NULL, message_id INT NOT NULL, date_created DATETIME NOT NULL, approved_by_author TINYINT(1) NOT NULL, INDEX IDX_163A303F675F31B (author_id), INDEX IDX_163A303B9D462AC (nominated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE motto ADD CONSTRAINT FK_163A303F675F31B FOREIGN KEY (author_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE motto ADD CONSTRAINT FK_163A303B9D462AC FOREIGN KEY (nominated_by_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE motto');
    }
}
