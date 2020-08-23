<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522105853 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        //$this->addSql('CREATE TABLE mapping (id INT AUTO_INCREMENT NOT NULL, expert_id INT DEFAULT NULL, evaluation_element_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_49E62C8AC5568CE4 (expert_id), INDEX IDX_49E62C8AF5186DD6 (evaluation_element_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE mapping ADD CONSTRAINT FK_49E62C8AC5568CE4 FOREIGN KEY (expert_id) REFERENCES user (id)');
        //$this->addSql('ALTER TABLE mapping ADD CONSTRAINT FK_49E62C8AF5186DD6 FOREIGN KEY (evaluation_element_id) REFERENCES evaluation_elements (id)');
        $this->addSql('ALTER TABLE user ADD generated_by VARCHAR(255) DEFAULT NULL, CHANGE evaluate_entreprise_id evaluate_entreprise_id INT DEFAULT NULL, CHANGE expert_entreprise_id expert_entreprise_id INT DEFAULT NULL, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE experience experience INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eaf CHANGE version version VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE lieu lieu VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluation_elements CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE team_validate team_validate LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE preferences CHANGE first_element_id first_element_id INT DEFAULT NULL, CHANGE second_element_id second_element_id INT DEFAULT NULL, CHANGE first_value first_value VARCHAR(255) DEFAULT NULL, CHANGE second_value second_value VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE binaire_evaluation CHANGE first_value first_value VARCHAR(255) DEFAULT NULL, CHANGE second_value second_value VARCHAR(255) DEFAULT NULL');
        //$this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD783E3463');
        //$this->addSql('DROP INDEX UNIQ_285F75DD783E3463 ON etape');
        //$this->addSql('ALTER TABLE etape DROP project_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE binaire_evaluation CHANGE first_value first_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE second_value second_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE eaf CHANGE version version VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE entreprise CHANGE lieu lieu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        //$this->addSql('ALTER TABLE etape ADD project_id INT NOT NULL');
        //$this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD783E3463 FOREIGN KEY (project_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_285F75DD783E3463 ON etape (project_id)');
        $this->addSql('ALTER TABLE evaluation_elements CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE team_validate team_validate LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE preferences CHANGE first_element_id first_element_id INT DEFAULT NULL, CHANGE second_element_id second_element_id INT DEFAULT NULL, CHANGE first_value first_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE second_value second_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user DROP generated_by, CHANGE evaluate_entreprise_id evaluate_entreprise_id INT DEFAULT NULL, CHANGE expert_entreprise_id expert_entreprise_id INT DEFAULT NULL, CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE first_name first_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE experience experience INT DEFAULT NULL');
    }
}
