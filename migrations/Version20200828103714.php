<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200828103714 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nanny ADD filename VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE nanny_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE nanny_option DROP FOREIGN KEY FK_CABF7AA416497E83');
        $this->addSql('ALTER TABLE nanny_option DROP FOREIGN KEY FK_CABF7AA4A7C41D6F');
        $this->addSql('ALTER TABLE nanny_option ADD PRIMARY KEY (nanny_id, option_id)');
        $this->addSql('DROP INDEX idx_cabf7aa416497e83 ON nanny_option');
        $this->addSql('CREATE INDEX IDX_FDA5EC8216497E83 ON nanny_option (nanny_id)');
        $this->addSql('DROP INDEX idx_cabf7aa4a7c41d6f ON nanny_option');
        $this->addSql('CREATE INDEX IDX_FDA5EC82A7C41D6F ON nanny_option (option_id)');
        $this->addSql('ALTER TABLE nanny_option ADD CONSTRAINT FK_CABF7AA416497E83 FOREIGN KEY (nanny_id) REFERENCES nanny (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nanny_option ADD CONSTRAINT FK_CABF7AA4A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nanny DROP filename');
        $this->addSql('ALTER TABLE nanny_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE nanny_option DROP FOREIGN KEY FK_FDA5EC8216497E83');
        $this->addSql('ALTER TABLE nanny_option DROP FOREIGN KEY FK_FDA5EC82A7C41D6F');
        $this->addSql('ALTER TABLE nanny_option ADD PRIMARY KEY (option_id, nanny_id)');
        $this->addSql('DROP INDEX idx_fda5ec8216497e83 ON nanny_option');
        $this->addSql('CREATE INDEX IDX_CABF7AA416497E83 ON nanny_option (nanny_id)');
        $this->addSql('DROP INDEX idx_fda5ec82a7c41d6f ON nanny_option');
        $this->addSql('CREATE INDEX IDX_CABF7AA4A7C41D6F ON nanny_option (option_id)');
        $this->addSql('ALTER TABLE nanny_option ADD CONSTRAINT FK_FDA5EC8216497E83 FOREIGN KEY (nanny_id) REFERENCES nanny (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nanny_option ADD CONSTRAINT FK_FDA5EC82A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
    }
}
