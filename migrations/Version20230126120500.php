<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126120500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP CONSTRAINT fk_5a8a6c8d9777d11e');
        $this->addSql('DROP INDEX idx_5a8a6c8d9777d11e');
        $this->addSql('ALTER TABLE post RENAME COLUMN category_id_id TO category_id');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D12469DE2 ON post (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8D12469DE2');
        $this->addSql('DROP INDEX IDX_5A8A6C8D12469DE2');
        $this->addSql('ALTER TABLE post RENAME COLUMN category_id TO category_id_id');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT fk_5a8a6c8d9777d11e FOREIGN KEY (category_id_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_5a8a6c8d9777d11e ON post (category_id_id)');
    }
}
