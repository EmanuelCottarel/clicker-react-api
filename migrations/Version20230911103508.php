<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230911103508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE user_upgrade MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user_upgrade DROP FOREIGN KEY FK_EF6B6A103DF81B69');
        $this->addSql('ALTER TABLE user_upgrade DROP FOREIGN KEY FK_EF6B6A1079F37AE5');
        $this->addSql('DROP INDEX IDX_EF6B6A1079F37AE5 ON user_upgrade');
        $this->addSql('DROP INDEX IDX_EF6B6A103DF81B69 ON user_upgrade');
        $this->addSql('DROP INDEX `primary` ON user_upgrade');
        $this->addSql('ALTER TABLE user_upgrade ADD user_id INT NOT NULL, ADD upgrade_id INT NOT NULL, DROP id, DROP id_user_id, DROP id_upgrade_id');
        $this->addSql('ALTER TABLE user_upgrade ADD CONSTRAINT FK_EF6B6A10A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_upgrade ADD CONSTRAINT FK_EF6B6A1098729BBE FOREIGN KEY (upgrade_id) REFERENCES upgrade (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_EF6B6A10A76ED395 ON user_upgrade (user_id)');
        $this->addSql('CREATE INDEX IDX_EF6B6A1098729BBE ON user_upgrade (upgrade_id)');
        $this->addSql('ALTER TABLE user_upgrade ADD PRIMARY KEY (user_id, upgrade_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_upgrade DROP FOREIGN KEY FK_EF6B6A10A76ED395');
        $this->addSql('ALTER TABLE user_upgrade DROP FOREIGN KEY FK_EF6B6A1098729BBE');
        $this->addSql('DROP INDEX IDX_EF6B6A10A76ED395 ON user_upgrade');
        $this->addSql('DROP INDEX IDX_EF6B6A1098729BBE ON user_upgrade');
        $this->addSql('ALTER TABLE user_upgrade ADD id INT AUTO_INCREMENT NOT NULL, ADD id_user_id INT NOT NULL, ADD id_upgrade_id INT NOT NULL, DROP user_id, DROP upgrade_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user_upgrade ADD CONSTRAINT FK_EF6B6A103DF81B69 FOREIGN KEY (id_upgrade_id) REFERENCES upgrade (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_upgrade ADD CONSTRAINT FK_EF6B6A1079F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EF6B6A1079F37AE5 ON user_upgrade (id_user_id)');
        $this->addSql('CREATE INDEX IDX_EF6B6A103DF81B69 ON user_upgrade (id_upgrade_id)');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(50) NOT NULL');
    }
}
