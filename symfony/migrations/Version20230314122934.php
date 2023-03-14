<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314122934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip_code INT NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allergy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, room_id_id INT NOT NULL, description VARCHAR(255) NOT NULL, start_time TIME NOT NULL, end_time TIME NOT NULL, INDEX IDX_FE38F84435F83FFC (room_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment_physician (appointment_id INT NOT NULL, physician_id INT NOT NULL, INDEX IDX_5833432CE5B533F9 (appointment_id), INDEX IDX_5833432CCA501031 (physician_id), PRIMARY KEY(appointment_id, physician_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment_nurse (appointment_id INT NOT NULL, nurse_id INT NOT NULL, INDEX IDX_3E0E5CADE5B533F9 (appointment_id), INDEX IDX_3E0E5CAD7373BFAA (nurse_id), PRIMARY KEY(appointment_id, nurse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment_patient (appointment_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_8BF9E5C3E5B533F9 (appointment_id), INDEX IDX_8BF9E5C36B899279 (patient_id), PRIMARY KEY(appointment_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE block (id INT AUTO_INCREMENT NOT NULL, floor INT NOT NULL, phone INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, head INT DEFAULT NULL, oath_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, total_quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE illness (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_file (id INT AUTO_INCREMENT NOT NULL, patient_id_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_DF6C9C38EA724598 (patient_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_file_allergy (medical_file_id INT NOT NULL, allergy_id INT NOT NULL, INDEX IDX_B52AD0E1D5C999A2 (medical_file_id), INDEX IDX_B52AD0E1DBFD579D (allergy_id), PRIMARY KEY(medical_file_id, allergy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_file_illness (id INT AUTO_INCREMENT NOT NULL, medical_file_id_id INT NOT NULL, illness_id_id INT NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_86D69239FE8607AC (medical_file_id_id), INDEX IDX_86D6923993BFCCC7 (illness_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medication (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nurse (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, ssn INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, license_number VARCHAR(255) NOT NULL, INDEX IDX_D27E6D439D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, ssn INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, gender VARCHAR(10) DEFAULT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, INDEX IDX_1ADAD7EB9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_room (id INT AUTO_INCREMENT NOT NULL, patient_id_id INT NOT NULL, room_id_id INT NOT NULL, start_time TIME NOT NULL, end_time TIME DEFAULT NULL, INDEX IDX_FB0E1C53EA724598 (patient_id_id), INDEX IDX_FB0E1C5335F83FFC (room_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE physician (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, ssn INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, license_number VARCHAR(255) NOT NULL, INDEX IDX_CDB92D259D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE physician_department (id INT AUTO_INCREMENT NOT NULL, physician_id_id INT NOT NULL, department_id_id INT NOT NULL, primary_affiliation TINYINT(1) NOT NULL, INDEX IDX_E65A9E27624109F8 (physician_id_id), INDEX IDX_E65A9E2764E7214B (department_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE physician_specialization (id INT AUTO_INCREMENT NOT NULL, physician_id_id INT NOT NULL, specialization_id_id INT NOT NULL, primary_specialization TINYINT(1) NOT NULL, certification_date DATE NOT NULL, certification_expire DATE DEFAULT NULL, INDEX IDX_6DF13C5D624109F8 (physician_id_id), INDEX IDX_6DF13C5DC2363E23 (specialization_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescription (id INT AUTO_INCREMENT NOT NULL, physician_id_id INT NOT NULL, appointment_id_id INT NOT NULL, date DATE NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_1FBFB8D9624109F8 (physician_id_id), INDEX IDX_1FBFB8D99334AFB9 (appointment_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescription_medication (id INT AUTO_INCREMENT NOT NULL, prescription_id_id INT NOT NULL, medication_id_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_E2D09A30B291C678 (prescription_id_id), INDEX IDX_E2D09A30E6161CBD (medication_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `procedure` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, cost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE procedure_physician (procedure_id INT NOT NULL, physician_id INT NOT NULL, INDEX IDX_2DA3FAE1624BCD2 (procedure_id), INDEX IDX_2DA3FAECA501031 (physician_id), PRIMARY KEY(procedure_id, physician_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE procedure_specialization (procedure_id INT NOT NULL, specialization_id INT NOT NULL, INDEX IDX_A40C52051624BCD2 (procedure_id), INDEX IDX_A40C5205FA846217 (specialization_id), PRIMARY KEY(procedure_id, specialization_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, block_id_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, floor VARCHAR(255) NOT NULL, INDEX IDX_729F519BB85558B1 (block_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_equipment (id INT AUTO_INCREMENT NOT NULL, room_id_id INT NOT NULL, equipment_id_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_4F9135EA35F83FFC (room_id_id), INDEX IDX_4F9135EA961DBFB3 (equipment_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialization (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_address (user_id INT NOT NULL, address_id INT NOT NULL, INDEX IDX_5543718BA76ED395 (user_id), INDEX IDX_5543718BF5B7AF75 (address_id), PRIMARY KEY(user_id, address_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84435F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE appointment_physician ADD CONSTRAINT FK_5833432CE5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_physician ADD CONSTRAINT FK_5833432CCA501031 FOREIGN KEY (physician_id) REFERENCES physician (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_nurse ADD CONSTRAINT FK_3E0E5CADE5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_nurse ADD CONSTRAINT FK_3E0E5CAD7373BFAA FOREIGN KEY (nurse_id) REFERENCES nurse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_patient ADD CONSTRAINT FK_8BF9E5C3E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_patient ADD CONSTRAINT FK_8BF9E5C36B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medical_file ADD CONSTRAINT FK_DF6C9C38EA724598 FOREIGN KEY (patient_id_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE medical_file_allergy ADD CONSTRAINT FK_B52AD0E1D5C999A2 FOREIGN KEY (medical_file_id) REFERENCES medical_file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medical_file_allergy ADD CONSTRAINT FK_B52AD0E1DBFD579D FOREIGN KEY (allergy_id) REFERENCES allergy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medical_file_illness ADD CONSTRAINT FK_86D69239FE8607AC FOREIGN KEY (medical_file_id_id) REFERENCES medical_file (id)');
        $this->addSql('ALTER TABLE medical_file_illness ADD CONSTRAINT FK_86D6923993BFCCC7 FOREIGN KEY (illness_id_id) REFERENCES illness (id)');
        $this->addSql('ALTER TABLE nurse ADD CONSTRAINT FK_D27E6D439D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient_room ADD CONSTRAINT FK_FB0E1C53EA724598 FOREIGN KEY (patient_id_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE patient_room ADD CONSTRAINT FK_FB0E1C5335F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE physician ADD CONSTRAINT FK_CDB92D259D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE physician_department ADD CONSTRAINT FK_E65A9E27624109F8 FOREIGN KEY (physician_id_id) REFERENCES physician (id)');
        $this->addSql('ALTER TABLE physician_department ADD CONSTRAINT FK_E65A9E2764E7214B FOREIGN KEY (department_id_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE physician_specialization ADD CONSTRAINT FK_6DF13C5D624109F8 FOREIGN KEY (physician_id_id) REFERENCES physician (id)');
        $this->addSql('ALTER TABLE physician_specialization ADD CONSTRAINT FK_6DF13C5DC2363E23 FOREIGN KEY (specialization_id_id) REFERENCES specialization (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D9624109F8 FOREIGN KEY (physician_id_id) REFERENCES physician (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D99334AFB9 FOREIGN KEY (appointment_id_id) REFERENCES appointment (id)');
        $this->addSql('ALTER TABLE prescription_medication ADD CONSTRAINT FK_E2D09A30B291C678 FOREIGN KEY (prescription_id_id) REFERENCES prescription (id)');
        $this->addSql('ALTER TABLE prescription_medication ADD CONSTRAINT FK_E2D09A30E6161CBD FOREIGN KEY (medication_id_id) REFERENCES medication (id)');
        $this->addSql('ALTER TABLE procedure_physician ADD CONSTRAINT FK_2DA3FAE1624BCD2 FOREIGN KEY (procedure_id) REFERENCES `procedure` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE procedure_physician ADD CONSTRAINT FK_2DA3FAECA501031 FOREIGN KEY (physician_id) REFERENCES physician (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE procedure_specialization ADD CONSTRAINT FK_A40C52051624BCD2 FOREIGN KEY (procedure_id) REFERENCES `procedure` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE procedure_specialization ADD CONSTRAINT FK_A40C5205FA846217 FOREIGN KEY (specialization_id) REFERENCES specialization (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BB85558B1 FOREIGN KEY (block_id_id) REFERENCES block (id)');
        $this->addSql('ALTER TABLE room_equipment ADD CONSTRAINT FK_4F9135EA35F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE room_equipment ADD CONSTRAINT FK_4F9135EA961DBFB3 FOREIGN KEY (equipment_id_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE user_address ADD CONSTRAINT FK_5543718BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_address ADD CONSTRAINT FK_5543718BF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84435F83FFC');
        $this->addSql('ALTER TABLE appointment_physician DROP FOREIGN KEY FK_5833432CE5B533F9');
        $this->addSql('ALTER TABLE appointment_physician DROP FOREIGN KEY FK_5833432CCA501031');
        $this->addSql('ALTER TABLE appointment_nurse DROP FOREIGN KEY FK_3E0E5CADE5B533F9');
        $this->addSql('ALTER TABLE appointment_nurse DROP FOREIGN KEY FK_3E0E5CAD7373BFAA');
        $this->addSql('ALTER TABLE appointment_patient DROP FOREIGN KEY FK_8BF9E5C3E5B533F9');
        $this->addSql('ALTER TABLE appointment_patient DROP FOREIGN KEY FK_8BF9E5C36B899279');
        $this->addSql('ALTER TABLE medical_file DROP FOREIGN KEY FK_DF6C9C38EA724598');
        $this->addSql('ALTER TABLE medical_file_allergy DROP FOREIGN KEY FK_B52AD0E1D5C999A2');
        $this->addSql('ALTER TABLE medical_file_allergy DROP FOREIGN KEY FK_B52AD0E1DBFD579D');
        $this->addSql('ALTER TABLE medical_file_illness DROP FOREIGN KEY FK_86D69239FE8607AC');
        $this->addSql('ALTER TABLE medical_file_illness DROP FOREIGN KEY FK_86D6923993BFCCC7');
        $this->addSql('ALTER TABLE nurse DROP FOREIGN KEY FK_D27E6D439D86650F');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB9D86650F');
        $this->addSql('ALTER TABLE patient_room DROP FOREIGN KEY FK_FB0E1C53EA724598');
        $this->addSql('ALTER TABLE patient_room DROP FOREIGN KEY FK_FB0E1C5335F83FFC');
        $this->addSql('ALTER TABLE physician DROP FOREIGN KEY FK_CDB92D259D86650F');
        $this->addSql('ALTER TABLE physician_department DROP FOREIGN KEY FK_E65A9E27624109F8');
        $this->addSql('ALTER TABLE physician_department DROP FOREIGN KEY FK_E65A9E2764E7214B');
        $this->addSql('ALTER TABLE physician_specialization DROP FOREIGN KEY FK_6DF13C5D624109F8');
        $this->addSql('ALTER TABLE physician_specialization DROP FOREIGN KEY FK_6DF13C5DC2363E23');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D9624109F8');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D99334AFB9');
        $this->addSql('ALTER TABLE prescription_medication DROP FOREIGN KEY FK_E2D09A30B291C678');
        $this->addSql('ALTER TABLE prescription_medication DROP FOREIGN KEY FK_E2D09A30E6161CBD');
        $this->addSql('ALTER TABLE procedure_physician DROP FOREIGN KEY FK_2DA3FAE1624BCD2');
        $this->addSql('ALTER TABLE procedure_physician DROP FOREIGN KEY FK_2DA3FAECA501031');
        $this->addSql('ALTER TABLE procedure_specialization DROP FOREIGN KEY FK_A40C52051624BCD2');
        $this->addSql('ALTER TABLE procedure_specialization DROP FOREIGN KEY FK_A40C5205FA846217');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BB85558B1');
        $this->addSql('ALTER TABLE room_equipment DROP FOREIGN KEY FK_4F9135EA35F83FFC');
        $this->addSql('ALTER TABLE room_equipment DROP FOREIGN KEY FK_4F9135EA961DBFB3');
        $this->addSql('ALTER TABLE user_address DROP FOREIGN KEY FK_5543718BA76ED395');
        $this->addSql('ALTER TABLE user_address DROP FOREIGN KEY FK_5543718BF5B7AF75');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE allergy');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE appointment_physician');
        $this->addSql('DROP TABLE appointment_nurse');
        $this->addSql('DROP TABLE appointment_patient');
        $this->addSql('DROP TABLE block');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE illness');
        $this->addSql('DROP TABLE medical_file');
        $this->addSql('DROP TABLE medical_file_allergy');
        $this->addSql('DROP TABLE medical_file_illness');
        $this->addSql('DROP TABLE medication');
        $this->addSql('DROP TABLE nurse');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE patient_room');
        $this->addSql('DROP TABLE physician');
        $this->addSql('DROP TABLE physician_department');
        $this->addSql('DROP TABLE physician_specialization');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE prescription_medication');
        $this->addSql('DROP TABLE `procedure`');
        $this->addSql('DROP TABLE procedure_physician');
        $this->addSql('DROP TABLE procedure_specialization');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_equipment');
        $this->addSql('DROP TABLE specialization');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_address');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
