<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230908083326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE effect (id INT AUTO_INCREMENT NOT NULL, id_effect_type_id INT NOT NULL, indice DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_B66091F2EFE04CB9 (id_effect_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE effect_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upgrade (id INT AUTO_INCREMENT NOT NULL, id_effect_id INT NOT NULL, upgrade_name VARCHAR(50) NOT NULL, price INT NOT NULL, upgrade_desc LONGTEXT NOT NULL, INDEX IDX_B766741A75DC041C (id_effect_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upgrade_worker (upgrade_id INT NOT NULL, worker_id INT NOT NULL, INDEX IDX_A34B207898729BBE (upgrade_id), INDEX IDX_A34B20786B20BA36 (worker_id), PRIMARY KEY(upgrade_id, worker_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, money DOUBLE PRECISION NOT NULL, clic_income DOUBLE PRECISION NOT NULL, last_connection DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_upgrade (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, id_upgrade_id INT NOT NULL, INDEX IDX_EF6B6A1079F37AE5 (id_user_id), INDEX IDX_EF6B6A103DF81B69 (id_upgrade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_worker (id INT AUTO_INCREMENT NOT NULL, id_worker_id INT NOT NULL, id_user_id INT NOT NULL, quantity INT NOT NULL, calculated_income DOUBLE PRECISION NOT NULL, INDEX IDX_FAE0A45FEB150611 (id_worker_id), INDEX IDX_FAE0A45F79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE worker (id INT AUTO_INCREMENT NOT NULL, id_worker_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, base_price INT NOT NULL, base_income DOUBLE PRECISION NOT NULL, INDEX IDX_9FB2BF62CCC54AD8 (id_worker_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE worker_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE effect ADD CONSTRAINT FK_B66091F2EFE04CB9 FOREIGN KEY (id_effect_type_id) REFERENCES effect_type (id)');
        $this->addSql('ALTER TABLE upgrade ADD CONSTRAINT FK_B766741A75DC041C FOREIGN KEY (id_effect_id) REFERENCES effect (id)');
        $this->addSql('ALTER TABLE upgrade_worker ADD CONSTRAINT FK_A34B207898729BBE FOREIGN KEY (upgrade_id) REFERENCES upgrade (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE upgrade_worker ADD CONSTRAINT FK_A34B20786B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_upgrade ADD CONSTRAINT FK_EF6B6A1079F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_upgrade ADD CONSTRAINT FK_EF6B6A103DF81B69 FOREIGN KEY (id_upgrade_id) REFERENCES upgrade (id)');
        $this->addSql('ALTER TABLE user_worker ADD CONSTRAINT FK_FAE0A45FEB150611 FOREIGN KEY (id_worker_id) REFERENCES worker (id)');
        $this->addSql('ALTER TABLE user_worker ADD CONSTRAINT FK_FAE0A45F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE worker ADD CONSTRAINT FK_9FB2BF62CCC54AD8 FOREIGN KEY (id_worker_type_id) REFERENCES worker_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE effect DROP FOREIGN KEY FK_B66091F2EFE04CB9');
        $this->addSql('ALTER TABLE upgrade DROP FOREIGN KEY FK_B766741A75DC041C');
        $this->addSql('ALTER TABLE upgrade_worker DROP FOREIGN KEY FK_A34B207898729BBE');
        $this->addSql('ALTER TABLE upgrade_worker DROP FOREIGN KEY FK_A34B20786B20BA36');
        $this->addSql('ALTER TABLE user_upgrade DROP FOREIGN KEY FK_EF6B6A1079F37AE5');
        $this->addSql('ALTER TABLE user_upgrade DROP FOREIGN KEY FK_EF6B6A103DF81B69');
        $this->addSql('ALTER TABLE user_worker DROP FOREIGN KEY FK_FAE0A45FEB150611');
        $this->addSql('ALTER TABLE user_worker DROP FOREIGN KEY FK_FAE0A45F79F37AE5');
        $this->addSql('ALTER TABLE worker DROP FOREIGN KEY FK_9FB2BF62CCC54AD8');
        $this->addSql('DROP TABLE effect');
        $this->addSql('DROP TABLE effect_type');
        $this->addSql('DROP TABLE upgrade');
        $this->addSql('DROP TABLE upgrade_worker');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_upgrade');
        $this->addSql('DROP TABLE user_worker');
        $this->addSql('DROP TABLE worker');
        $this->addSql('DROP TABLE worker_type');
    }
}
