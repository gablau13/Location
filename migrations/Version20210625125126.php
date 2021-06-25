<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210625125126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anounce ADD introduction VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C87016831');
        $this->addSql('ALTER TABLE comment CHANGE anounce_id anounce_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C87016831 FOREIGN KEY (anounce_id) REFERENCES anounce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F87016831');
        $this->addSql('ALTER TABLE image CHANGE anounce_id anounce_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F87016831 FOREIGN KEY (anounce_id) REFERENCES anounce (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE anounce DROP introduction');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C87016831');
        $this->addSql('ALTER TABLE comment CHANGE anounce_id anounce_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C87016831 FOREIGN KEY (anounce_id) REFERENCES anounce (id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F87016831');
        $this->addSql('ALTER TABLE image CHANGE anounce_id anounce_id INT NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F87016831 FOREIGN KEY (anounce_id) REFERENCES anounce (id)');
    }
}
