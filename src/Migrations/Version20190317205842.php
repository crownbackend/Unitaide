<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190317205842 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_64C19C1989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idea_box (id INT AUTO_INCREMENT NOT NULL, idea LONGTEXT NOT NULL, name VARCHAR(255) NOT NULL, telephone INT DEFAULT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, event_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C53D045F7294869C (article_id), INDEX IDX_C53D045F71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, tags LONGTEXT NOT NULL, image_name_miniature VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, seo_description VARCHAR(154) NOT NULL, UNIQUE INDEX UNIQ_23A0E66989D9B62 (slug), INDEX IDX_23A0E6612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, end_event DATETIME NOT NULL, seo_description VARCHAR(154) NOT NULL, slug VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, image_size INT NOT NULL, tags LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_3BAE0AA7989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F7294869C');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F71F7E88B');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE idea_box');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE event');
    }
}
