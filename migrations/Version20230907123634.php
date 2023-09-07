<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907123634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE upgrade_worker (upgrade_id INT NOT NULL, worker_id INT NOT NULL, INDEX IDX_A34B207898729BBE (upgrade_id), INDEX IDX_A34B20786B20BA36 (worker_id), PRIMARY KEY(upgrade_id, worker_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE upgrade_worker ADD CONSTRAINT FK_A34B207898729BBE FOREIGN KEY (upgrade_id) REFERENCES upgrade (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE upgrade_worker ADD CONSTRAINT FK_A34B20786B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE effect_worker DROP FOREIGN KEY FK_E271D0FC6B20BA36');
        $this->addSql('ALTER TABLE effect_worker DROP FOREIGN KEY FK_E271D0FCF5E9B83B');
        $this->addSql('DROP TABLE effect_worker');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE effect_worker (effect_id INT NOT NULL, worker_id INT NOT NULL, INDEX IDX_E271D0FC6B20BA36 (worker_id), INDEX IDX_E271D0FCF5E9B83B (effect_id), PRIMARY KEY(effect_id, worker_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE effect_worker ADD CONSTRAINT FK_E271D0FC6B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE effect_worker ADD CONSTRAINT FK_E271D0FCF5E9B83B FOREIGN KEY (effect_id) REFERENCES effect (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE upgrade_worker DROP FOREIGN KEY FK_A34B207898729BBE');
        $this->addSql('ALTER TABLE upgrade_worker DROP FOREIGN KEY FK_A34B20786B20BA36');
        $this->addSql('DROP TABLE upgrade_worker');
    }
}
