<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230423051444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Esta migracion inserta los roles en la tabla';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO rol(nombre) VALUES ('Gerente')");
        $this->addSql("INSERT INTO rol(nombre) VALUES ('Administrador')");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("TRUNCATE TABLE rol");

    }
}
