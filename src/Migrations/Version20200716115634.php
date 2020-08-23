<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716115634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD domain VARCHAR(255) NOT NULL, CHANGE evaluate_entreprise_id evaluate_entreprise_id INT DEFAULT NULL, CHANGE expert_entreprise_id expert_entreprise_id INT DEFAULT NULL, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE experience experience INT DEFAULT NULL, CHANGE generated_by generated_by VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE eaf CHANGE version version VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE lieu lieu VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluation_elements CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE team_validate team_validate LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE preferences CHANGE first_element_id first_element_id INT DEFAULT NULL, CHANGE second_element_id second_element_id INT DEFAULT NULL, CHANGE first_value first_value VARCHAR(255) DEFAULT NULL, CHANGE second_value second_value VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE binaire_evaluation CHANGE first_value first_value VARCHAR(255) DEFAULT NULL, CHANGE second_value second_value VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE mapping CHANGE expert_id expert_id INT DEFAULT NULL, CHANGE evaluation_element_id evaluation_element_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE binaire_evaluation CHANGE first_value first_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE second_value second_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE eaf CHANGE version version VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE entreprise CHANGE lieu lieu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE evaluation_elements CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE team_validate team_validate LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE mapping CHANGE expert_id expert_id INT DEFAULT NULL, CHANGE evaluation_element_id evaluation_element_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE preferences CHANGE first_element_id first_element_id INT DEFAULT NULL, CHANGE second_element_id second_element_id INT DEFAULT NULL, CHANGE first_value first_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE second_value second_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user DROP domain, CHANGE evaluate_entreprise_id evaluate_entreprise_id INT DEFAULT NULL, CHANGE expert_entreprise_id expert_entreprise_id INT DEFAULT NULL, CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE first_name first_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE experience experience INT DEFAULT NULL, CHANGE generated_by generated_by VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
