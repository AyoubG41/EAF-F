<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200404183459 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        //$this->addSql('CREATE TABLE eafelements (id INT AUTO_INCREMENT NOT NULL, eaf_id INT DEFAULT NULL, expert_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_7A30C4C2CAE4D54A (eaf_id), INDEX IDX_7A30C4C2C5568CE4 (expert_id), INDEX IDX_7A30C4C2727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE binaire_evaluation (id INT AUTO_INCREMENT NOT NULL, first_element_id INT NOT NULL, second_element_id INT NOT NULL, first_value VARCHAR(255) DEFAULT NULL, second_value VARCHAR(255) DEFAULT NULL, INDEX IDX_266C1C358E874B23 (first_element_id), INDEX IDX_266C1C35FC41CAB7 (second_element_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eaf (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, version VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eaf_user (eaf_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_18D18BEFCAE4D54A (eaf_id), INDEX IDX_18D18BEFA76ED395 (user_id), PRIMARY KEY(eaf_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, manager_id INT NOT NULL, name VARCHAR(255) NOT NULL, lieu VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_D19FA60783E3463 (manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation_elements (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, entreprise_id INT DEFAULT NULL, createur_id INT NOT NULL, name VARCHAR(255) NOT NULL, validate TINYINT(1) NOT NULL, INDEX IDX_49047E7B727ACA70 (parent_id), INDEX IDX_49047E7BA4AEAFEA (entreprise_id), INDEX IDX_49047E7B73A201E5 (createur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('CREATE TABLE mapping (id INT AUTO_INCREMENT NOT NULL, expert_id INT DEFAULT NULL, eafelement_id INT DEFAULT NULL, evaluation_element_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_49E62C8AC5568CE4 (expert_id), INDEX IDX_49E62C8AEBAB1181 (eafelement_id), INDEX IDX_49E62C8AF5186DD6 (evaluation_element_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preferences (id INT AUTO_INCREMENT NOT NULL, first_element_id INT DEFAULT NULL, second_element_id INT DEFAULT NULL, evaluateur_id INT NOT NULL, first_value VARCHAR(255) DEFAULT NULL, second_value VARCHAR(255) DEFAULT NULL, INDEX IDX_E931A6F58E874B23 (first_element_id), INDEX IDX_E931A6F5FC41CAB7 (second_element_id), INDEX IDX_E931A6F5231F139 (evaluateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, evaluate_entreprise_id INT DEFAULT NULL, expert_entreprise_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, experience INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), INDEX IDX_8D93D649C7DD3230 (evaluate_entreprise_id), INDEX IDX_8D93D6493AB49740 (expert_entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE eafelements ADD CONSTRAINT FK_7A30C4C2CAE4D54A FOREIGN KEY (eaf_id) REFERENCES eaf (id)');
        //$this->addSql('ALTER TABLE eafelements ADD CONSTRAINT FK_7A30C4C2C5568CE4 FOREIGN KEY (expert_id) REFERENCES user (id)');
        //$this->addSql('ALTER TABLE eafelements ADD CONSTRAINT FK_7A30C4C2727ACA70 FOREIGN KEY (parent_id) REFERENCES eafelements (id)');
        $this->addSql('ALTER TABLE binaire_evaluation ADD CONSTRAINT FK_266C1C358E874B23 FOREIGN KEY (first_element_id) REFERENCES eaf (id)');
        $this->addSql('ALTER TABLE binaire_evaluation ADD CONSTRAINT FK_266C1C35FC41CAB7 FOREIGN KEY (second_element_id) REFERENCES eaf (id)');
        $this->addSql('ALTER TABLE eaf_user ADD CONSTRAINT FK_18D18BEFCAE4D54A FOREIGN KEY (eaf_id) REFERENCES eaf (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eaf_user ADD CONSTRAINT FK_18D18BEFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60783E3463 FOREIGN KEY (manager_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evaluation_elements ADD CONSTRAINT FK_49047E7B727ACA70 FOREIGN KEY (parent_id) REFERENCES evaluation_elements (id)');
        $this->addSql('ALTER TABLE evaluation_elements ADD CONSTRAINT FK_49047E7BA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE evaluation_elements ADD CONSTRAINT FK_49047E7B73A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
       // $this->addSql('ALTER TABLE mapping ADD CONSTRAINT FK_49E62C8AC5568CE4 FOREIGN KEY (expert_id) REFERENCES user (id)');
        //$this->addSql('ALTER TABLE mapping ADD CONSTRAINT FK_49E62C8AEBAB1181 FOREIGN KEY (eafelement_id) REFERENCES eafelements (id)');
        //$this->addSql('ALTER TABLE mapping ADD CONSTRAINT FK_49E62C8AF5186DD6 FOREIGN KEY (evaluation_element_id) REFERENCES evaluation_elements (id)');
        $this->addSql('ALTER TABLE preferences ADD CONSTRAINT FK_E931A6F58E874B23 FOREIGN KEY (first_element_id) REFERENCES evaluation_elements (id)');
        $this->addSql('ALTER TABLE preferences ADD CONSTRAINT FK_E931A6F5FC41CAB7 FOREIGN KEY (second_element_id) REFERENCES evaluation_elements (id)');
        $this->addSql('ALTER TABLE preferences ADD CONSTRAINT FK_E931A6F5231F139 FOREIGN KEY (evaluateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C7DD3230 FOREIGN KEY (evaluate_entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493AB49740 FOREIGN KEY (expert_entreprise_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

       // $this->addSql('ALTER TABLE eafelements DROP FOREIGN KEY FK_7A30C4C2727ACA70');
        $this->addSql('ALTER TABLE mapping DROP FOREIGN KEY FK_49E62C8AEBAB1181');
        //$this->addSql('ALTER TABLE eafelements DROP FOREIGN KEY FK_7A30C4C2CAE4D54A');
        $this->addSql('ALTER TABLE binaire_evaluation DROP FOREIGN KEY FK_266C1C358E874B23');
        $this->addSql('ALTER TABLE binaire_evaluation DROP FOREIGN KEY FK_266C1C35FC41CAB7');
        $this->addSql('ALTER TABLE eaf_user DROP FOREIGN KEY FK_18D18BEFCAE4D54A');
        $this->addSql('ALTER TABLE evaluation_elements DROP FOREIGN KEY FK_49047E7BA4AEAFEA');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C7DD3230');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493AB49740');
        $this->addSql('ALTER TABLE eaf DROP FOREIGN KEY FK_696A4E52F5186DD6');
        $this->addSql('ALTER TABLE evaluation_elements DROP FOREIGN KEY FK_49047E7B727ACA70');
       // $this->addSql('ALTER TABLE mapping DROP FOREIGN KEY FK_49E62C8AF5186DD6');
        $this->addSql('ALTER TABLE preferences DROP FOREIGN KEY FK_E931A6F58E874B23');
        $this->addSql('ALTER TABLE preferences DROP FOREIGN KEY FK_E931A6F5FC41CAB7');
        //$this->addSql('ALTER TABLE eafelements DROP FOREIGN KEY FK_7A30C4C2C5568CE4');
        $this->addSql('ALTER TABLE eaf_user DROP FOREIGN KEY FK_18D18BEFA76ED395');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60783E3463');
        $this->addSql('ALTER TABLE evaluation_elements DROP FOREIGN KEY FK_49047E7B73A201E5');
     //   $this->addSql('ALTER TABLE mapping DROP FOREIGN KEY FK_49E62C8AC5568CE4');
        $this->addSql('ALTER TABLE preferences DROP FOREIGN KEY FK_E931A6F5231F139');
        //$this->addSql('DROP TABLE eafelements');
        $this->addSql('DROP TABLE binaire_evaluation');
        $this->addSql('DROP TABLE eaf');
        $this->addSql('DROP TABLE eaf_user');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE evaluation_elements');
        //$this->addSql('DROP TABLE mapping');
        $this->addSql('DROP TABLE preferences');
        $this->addSql('DROP TABLE user');
    }
}
