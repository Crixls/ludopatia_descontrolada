<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240117172625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE numero_loteria (id INT AUTO_INCREMENT NOT NULL, sorteo_id INT DEFAULT NULL, user_id INT DEFAULT NULL, id_numero_id INT DEFAULT NULL, number INT NOT NULL, price DOUBLE PRECISION NOT NULL, fecha_limite DATETIME DEFAULT NULL, estado INT NOT NULL, INDEX IDX_37D926E1663FD436 (sorteo_id), INDEX IDX_37D926E1A76ED395 (user_id), INDEX IDX_37D926E1DD22965F (id_numero_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sorteo (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, cantidad_numeros INT NOT NULL, premio DOUBLE PRECISION NOT NULL, precio_numero DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tramite (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, tramite_sorteo_id INT DEFAULT NULL, tipo INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_9F322F25A76ED395 (user_id), UNIQUE INDEX UNIQ_9F322F251F7A218 (tramite_sorteo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, sorteo_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, saldo DOUBLE PRECISION NOT NULL, rol INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D649663FD436 (sorteo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE numero_loteria ADD CONSTRAINT FK_37D926E1663FD436 FOREIGN KEY (sorteo_id) REFERENCES sorteo (id)');
        $this->addSql('ALTER TABLE numero_loteria ADD CONSTRAINT FK_37D926E1A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE numero_loteria ADD CONSTRAINT FK_37D926E1DD22965F FOREIGN KEY (id_numero_id) REFERENCES sorteo (id)');
        $this->addSql('ALTER TABLE tramite ADD CONSTRAINT FK_9F322F25A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE tramite ADD CONSTRAINT FK_9F322F251F7A218 FOREIGN KEY (tramite_sorteo_id) REFERENCES sorteo (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649663FD436 FOREIGN KEY (sorteo_id) REFERENCES sorteo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE numero_loteria DROP FOREIGN KEY FK_37D926E1663FD436');
        $this->addSql('ALTER TABLE numero_loteria DROP FOREIGN KEY FK_37D926E1A76ED395');
        $this->addSql('ALTER TABLE numero_loteria DROP FOREIGN KEY FK_37D926E1DD22965F');
        $this->addSql('ALTER TABLE tramite DROP FOREIGN KEY FK_9F322F25A76ED395');
        $this->addSql('ALTER TABLE tramite DROP FOREIGN KEY FK_9F322F251F7A218');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649663FD436');
        $this->addSql('DROP TABLE numero_loteria');
        $this->addSql('DROP TABLE sorteo');
        $this->addSql('DROP TABLE tramite');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
