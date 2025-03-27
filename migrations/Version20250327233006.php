<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250327233006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire ADD film_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC567F5183 FOREIGN KEY (film_id) REFERENCES film (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_67F068BC567F5183 ON commentaire (film_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC567F5183
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_67F068BC567F5183 ON commentaire
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE commentaire DROP film_id
        SQL);
    }
}
