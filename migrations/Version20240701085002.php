<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701085002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise ADD muscle_group_id INT NOT NULL');
        $this->addSql('ALTER TABLE exercise ADD CONSTRAINT FK_AEDAD51C44004D0 FOREIGN KEY (muscle_group_id) REFERENCES muscle_group (id)');
        $this->addSql('CREATE INDEX IDX_AEDAD51C44004D0 ON exercise (muscle_group_id)');
        $this->addSql('ALTER TABLE muscle_group DROP FOREIGN KEY FK_323D098E3256915B');
        $this->addSql('DROP INDEX IDX_323D098E3256915B ON muscle_group');
        $this->addSql('ALTER TABLE muscle_group DROP relation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercise DROP FOREIGN KEY FK_AEDAD51C44004D0');
        $this->addSql('DROP INDEX IDX_AEDAD51C44004D0 ON exercise');
        $this->addSql('ALTER TABLE exercise DROP muscle_group_id');
        $this->addSql('ALTER TABLE muscle_group ADD relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE muscle_group ADD CONSTRAINT FK_323D098E3256915B FOREIGN KEY (relation_id) REFERENCES exercise (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_323D098E3256915B ON muscle_group (relation_id)');
    }
}
