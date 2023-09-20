<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230914083819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_worker DROP FOREIGN KEY FK_FAE0A45F79F37AE5');
        $this->addSql('ALTER TABLE user_worker DROP FOREIGN KEY FK_FAE0A45FEB150611');
        $this->addSql('DROP INDEX IDX_FAE0A45FEB150611 ON user_worker');
        $this->addSql('DROP INDEX IDX_FAE0A45F79F37AE5 ON user_worker');
        $this->addSql('ALTER TABLE user_worker ADD worker_id INT NOT NULL, ADD user_id INT NOT NULL, DROP id_worker_id, DROP id_user_id');
        $this->addSql('ALTER TABLE user_worker ADD CONSTRAINT FK_FAE0A45F6B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id)');
        $this->addSql('ALTER TABLE user_worker ADD CONSTRAINT FK_FAE0A45FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FAE0A45F6B20BA36 ON user_worker (worker_id)');
        $this->addSql('CREATE INDEX IDX_FAE0A45FA76ED395 ON user_worker (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_worker DROP FOREIGN KEY FK_FAE0A45F6B20BA36');
        $this->addSql('ALTER TABLE user_worker DROP FOREIGN KEY FK_FAE0A45FA76ED395');
        $this->addSql('DROP INDEX IDX_FAE0A45F6B20BA36 ON user_worker');
        $this->addSql('DROP INDEX IDX_FAE0A45FA76ED395 ON user_worker');
        $this->addSql('ALTER TABLE user_worker ADD id_worker_id INT NOT NULL, ADD id_user_id INT NOT NULL, DROP worker_id, DROP user_id');
        $this->addSql('ALTER TABLE user_worker ADD CONSTRAINT FK_FAE0A45F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_worker ADD CONSTRAINT FK_FAE0A45FEB150611 FOREIGN KEY (id_worker_id) REFERENCES worker (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FAE0A45FEB150611 ON user_worker (id_worker_id)');
        $this->addSql('CREATE INDEX IDX_FAE0A45F79F37AE5 ON user_worker (id_user_id)');
    }
}
