<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200425145008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE evaluate_entreprise_id evaluate_entreprise_id INT DEFAULT NULL, CHANGE expert_entreprise_id expert_entreprise_id INT DEFAULT NULL, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL, CHANGE first_name first_name VARCHAR(255) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE experience experience INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eaf CHANGE version version VARCHAR(255) DEFAULT NULL');
        //  $this->addSql('ALTER TABLE eafelements CHANGE eaf_id eaf_id INT DEFAULT NULL, CHANGE expert_id expert_id INT DEFAULT NULL, CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE lieu lieu VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE evaluation_elements CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE team_validate team_validate LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE preferences CHANGE first_element_id first_element_id INT DEFAULT NULL, CHANGE second_element_id second_element_id INT DEFAULT NULL, CHANGE first_value first_value VARCHAR(255) DEFAULT NULL, CHANGE second_value second_value VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE binaire_evaluation ADD createur_id INT NOT NULL, CHANGE first_value first_value VARCHAR(255) DEFAULT NULL, CHANGE second_value second_value VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE binaire_evaluation ADD CONSTRAINT FK_266C1C3573A201E5 FOREIGN KEY (createur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_266C1C3573A201E5 ON binaire_evaluation (createur_id)');
        // $this->addSql('ALTER TABLE mapping CHANGE expert_id expert_id INT DEFAULT NULL, CHANGE eafelement_id eafelement_id INT DEFAULT NULL, CHANGE evaluation_element_id evaluation_element_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE binaire_evaluation DROP FOREIGN KEY FK_266C1C3573A201E5');
        $this->addSql('DROP INDEX IDX_266C1C3573A201E5 ON binaire_evaluation');
        $this->addSql('ALTER TABLE binaire_evaluation DROP createur_id, CHANGE first_value first_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE second_value second_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE eaf CHANGE version version VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        // $this->addSql('ALTER TABLE eafelements CHANGE eaf_id eaf_id INT DEFAULT NULL, CHANGE expert_id expert_id INT DEFAULT NULL, CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entreprise CHANGE lieu lieu VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE evaluation_elements CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE team_validate team_validate LONGTEXT CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        //$this->addSql('ALTER TABLE mapping CHANGE expert_id expert_id INT DEFAULT NULL, CHANGE eafelement_id eafelement_id INT DEFAULT NULL, CHANGE evaluation_element_id evaluation_element_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE preferences CHANGE first_element_id first_element_id INT DEFAULT NULL, CHANGE second_element_id second_element_id INT DEFAULT NULL, CHANGE first_value first_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE second_value second_value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE evaluate_entreprise_id evaluate_entreprise_id INT DEFAULT NULL, CHANGE expert_entreprise_id expert_entreprise_id INT DEFAULT NULL, CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\', CHANGE first_name first_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_name last_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE experience experience INT DEFAULT NULL');
    }
}
