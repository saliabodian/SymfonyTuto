<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20180614105236 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_880E0D76F85E0677 ON admin (username)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_880E0D76F85E0677');
    }
}
