<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250327231006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE film_genre (film_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_1A3CCDA8567F5183 (film_id), INDEX IDX_1A3CCDA84296D31F (genre_id), PRIMARY KEY(film_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE film_realisateur (film_id INT NOT NULL, realisateur_id INT NOT NULL, INDEX IDX_3F2B13F1567F5183 (film_id), INDEX IDX_3F2B13F1F1D8422E (realisateur_id), PRIMARY KEY(film_id, realisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE film_genre ADD CONSTRAINT FK_1A3CCDA8567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE film_genre ADD CONSTRAINT FK_1A3CCDA84296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE film_realisateur ADD CONSTRAINT FK_3F2B13F1567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE film_realisateur ADD CONSTRAINT FK_3F2B13F1F1D8422E FOREIGN KEY (realisateur_id) REFERENCES realisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note ADD film_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14567F5183 FOREIGN KEY (film_id) REFERENCES film (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_CFBDFA14567F5183 ON note (film_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE film_genre DROP FOREIGN KEY FK_1A3CCDA8567F5183
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE film_genre DROP FOREIGN KEY FK_1A3CCDA84296D31F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE film_realisateur DROP FOREIGN KEY FK_3F2B13F1567F5183
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE film_realisateur DROP FOREIGN KEY FK_3F2B13F1F1D8422E
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE film_genre
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE film_realisateur
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14567F5183
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_CFBDFA14567F5183 ON note
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE note DROP film_id
        SQL);
    }
}
