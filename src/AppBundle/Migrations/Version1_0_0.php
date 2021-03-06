<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Version1_0_0
 */
class Version1_0_0 extends AbstractMigration
{
    /**
     * Up
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // Schema
        $this->addSql('CREATE SEQUENCE ds_config_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ds_access_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ds_access_permission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_anonymous_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_anonymous_persona_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_anonymous_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_bu_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_bu_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_individual_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_individual_persona_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_individual_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_organization_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_organization_persona_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_organization_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_staff_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_staff_persona_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_staff_persona_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_system_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ds_config (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, "value" TEXT DEFAULT NULL, enabled BOOLEAN NOT NULL, version INT DEFAULT 1 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F4D17F50A6 ON ds_config (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F4F48571EB ON ds_config ("key")');
        $this->addSql('CREATE TABLE ds_access (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A76F41DCD17F50A6 ON ds_access (uuid)');
        $this->addSql('CREATE TABLE ds_access_permission (id INT NOT NULL, access_id INT DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, attributes JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D46DD4D04FEA67CF ON ds_access_permission (access_id)');
        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, data BYTEA NOT NULL, time INTEGER NOT NULL, lifetime INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE app_anonymous (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A5EB29BD17F50A6 ON app_anonymous (uuid)');
        $this->addSql('CREATE TABLE app_anonymous_persona (id INT NOT NULL, anonymous_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5ABA7A3D17F50A6 ON app_anonymous_persona (uuid)');
        $this->addSql('CREATE INDEX IDX_5ABA7A3FA93803 ON app_anonymous_persona (anonymous_id)');
        $this->addSql('CREATE TABLE app_anonymous_persona_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B378E082C2AC5D3 ON app_anonymous_persona_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_anonymous_persona_trans_unique_translation ON app_anonymous_persona_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_bu (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F0C3D814D17F50A6 ON app_bu (uuid)');
        $this->addSql('CREATE TABLE app_bu_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AE7B40C2C2AC5D3 ON app_bu_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_bu_trans_unique_translation ON app_bu_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_individual (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D188576BD17F50A6 ON app_individual (uuid)');
        $this->addSql('CREATE TABLE app_individual_persona (id INT NOT NULL, individual_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_828FC6ED17F50A6 ON app_individual_persona (uuid)');
        $this->addSql('CREATE INDEX IDX_828FC6EAE271C0D ON app_individual_persona (individual_id)');
        $this->addSql('CREATE TABLE app_individual_persona_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2EB6F73E2C2AC5D3 ON app_individual_persona_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_individual_persona_trans_unique_translation ON app_individual_persona_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_organization (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36079FDD17F50A6 ON app_organization (uuid)');
        $this->addSql('CREATE TABLE app_organization_persona (id INT NOT NULL, organization_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7767B60FD17F50A6 ON app_organization_persona (uuid)');
        $this->addSql('CREATE INDEX IDX_7767B60F32C8A3DE ON app_organization_persona (organization_id)');
        $this->addSql('CREATE TABLE app_organization_persona_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_63870C2F2C2AC5D3 ON app_organization_persona_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_organization_persona_trans_unique_translation ON app_organization_persona_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_staff (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_94BD7E5FD17F50A6 ON app_staff (uuid)');
        $this->addSql('CREATE TABLE app_staff_bu (staff_id INT NOT NULL, bu_id INT NOT NULL, PRIMARY KEY(staff_id, bu_id))');
        $this->addSql('CREATE INDEX IDX_8C89CE59D4D57CD ON app_staff_bu (staff_id)');
        $this->addSql('CREATE INDEX IDX_8C89CE59E0319FBC ON app_staff_bu (bu_id)');
        $this->addSql('CREATE TABLE app_staff_persona (id INT NOT NULL, staff_id INT DEFAULT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_972E9C81D17F50A6 ON app_staff_persona (uuid)');
        $this->addSql('CREATE INDEX IDX_972E9C81D4D57CD ON app_staff_persona (staff_id)');
        $this->addSql('CREATE TABLE app_staff_persona_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_83B289352C2AC5D3 ON app_staff_persona_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_staff_persona_trans_unique_translation ON app_staff_persona_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_system (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2C4E7C0BD17F50A6 ON app_system (uuid)');
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_anonymous_persona ADD CONSTRAINT FK_5ABA7A3FA93803 FOREIGN KEY (anonymous_id) REFERENCES app_anonymous (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_anonymous_persona_trans ADD CONSTRAINT FK_3B378E082C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_anonymous_persona (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_bu_trans ADD CONSTRAINT FK_AE7B40C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_bu (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_individual_persona ADD CONSTRAINT FK_828FC6EAE271C0D FOREIGN KEY (individual_id) REFERENCES app_individual (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_individual_persona_trans ADD CONSTRAINT FK_2EB6F73E2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_individual_persona (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_organization_persona ADD CONSTRAINT FK_7767B60F32C8A3DE FOREIGN KEY (organization_id) REFERENCES app_organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_organization_persona_trans ADD CONSTRAINT FK_63870C2F2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_organization_persona (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_bu ADD CONSTRAINT FK_8C89CE59D4D57CD FOREIGN KEY (staff_id) REFERENCES app_staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_bu ADD CONSTRAINT FK_8C89CE59E0319FBC FOREIGN KEY (bu_id) REFERENCES app_bu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_persona ADD CONSTRAINT FK_972E9C81D4D57CD FOREIGN KEY (staff_id) REFERENCES app_staff (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_staff_persona_trans ADD CONSTRAINT FK_83B289352C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_staff_persona (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        // Data
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/migrations/1_0_0.yml');
        $data = Yaml::parse($yml);

        $this->addSql('
            INSERT INTO 
                app_bu (id, uuid, owner, owner_uuid, version, created_at, updated_at, deleted_at)
            VALUES 
                (1, \''.$data['business_unit']['administration']['uuid'].'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', 1, now(), now(), NULL),
                (2, \''.$data['business_unit']['backoffice']['uuid'].'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', 1, now(), now(), NULL),
                (3, \''.$data['business_unit']['portal']['uuid'].'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', 1, now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                app_bu_trans (id, translatable_id, title, locale)
            VALUES 
                (1, 1, \'Administration\', \'en\'),
                (2, 2, \'Backoffice\', \'en\'),
                (3, 3, \'Portal\', \'en\');
        ');

        $this->addSql('
            INSERT INTO 
                app_system (id, uuid, owner, owner_uuid, version, created_at, updated_at, deleted_at)
            VALUES 
                (1, \''.$data['identity']['system']['uuid'].'\', \'System\', \''.$data['identity']['system']['uuid'].'\', 1, now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                app_staff (id, uuid, owner, owner_uuid, version, created_at, updated_at, deleted_at)
            VALUES 
                (1, \''.$data['identity']['admin']['uuid'].'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', 1, now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                app_staff_persona (id, staff_id, uuid, owner, owner_uuid, identity, identity_uuid, data, version, created_at, updated_at, deleted_at)
            VALUES 
                (1, 1, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', \''.$data['identity']['admin']['uuid'].'\', \'{}\', 1, now(), now(), NULL);
        ');

        $this->addSql('
            INSERT INTO 
                app_staff_persona_trans (id, translatable_id, title, locale)
            VALUES 
                (1, 1, \'Default\', \'en\');
        ');

        $this->addSql('
            INSERT INTO 
                ds_config (id, uuid, owner, owner_uuid, key, value, enabled, version, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.username\', \'system@ds\', true, 1, now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.uuid\', \''.$data['user']['system']['uuid'].'\', true, 1, now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.roles\', \'ROLE_SYSTEM\', true, 1, now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity\', \'System\', true, 1, now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity_uuid\', \''.$data['identity']['system']['uuid'].'\', true, 1, now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.assets.host\', \''.$data['config']['ds_api.api.assets.host']['value'].'\', true, 1, now(), now()),
                (7, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.authentication.host\', \''.$data['config']['ds_api.api.authentication.host']['value'].'\', true, 1, now(), now()),
                (8, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.camunda.host\', \''.$data['config']['ds_api.api.camunda.host']['value'].'\', true, 1, now(), now()),
                (9, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.cases.host\', \''.$data['config']['ds_api.api.cases.host']['value'].'\', true, 1, now(), now()),
                (10, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.cms.host\', \''.$data['config']['ds_api.api.cms.host']['value'].'\', true, 1, now(), now()),
                (11, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.formio.host\', \''.$data['config']['ds_api.api.formio.host']['value'].'\', true, 1, now(), now()),
                (12, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.identities.host\', \''.$data['config']['ds_api.api.identities.host']['value'].'\', true, 1, now(), now()),
                (13, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.records.host\', \''.$data['config']['ds_api.api.records.host']['value'].'\', true, 1, now(), now()),
                (14, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.services.host\', \''.$data['config']['ds_api.api.services.host']['value'].'\', true, 1, now(), now()),
                (15, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.tasks.host\', \''.$data['config']['ds_api.api.tasks.host']['value'].'\', true, 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access (id, uuid, owner, owner_uuid, identity, identity_uuid, version, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'System\', \''.$data['identity']['system']['uuid'].'\', \'System\', \''.$data['identity']['system']['uuid'].'\', 1, now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Anonymous\', NULL, 1, now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Individual\', NULL, 1, now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Organization\', NULL, 1, now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', NULL, 1, now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', \''.$data['identity']['admin']['uuid'].'\', 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access_permission (id, access_id, entity, entity_uuid, key, attributes)
            VALUES 
                (1, 1, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (2, 1, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (3, 1, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\'),
                (4, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous\', \'["BROWSE","READ"]\'),
                (5, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_uuid\', \'["BROWSE","READ"]\'),
                (6, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_created_at\', \'["BROWSE","READ"]\'),
                (7, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_version\', \'["BROWSE","READ"]\'),
                (8, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_persona\', \'["BROWSE","READ"]\'),
                (9, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_persona_uuid\', \'["BROWSE","READ"]\'),
                (10, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_persona_created_at\', \'["BROWSE","READ"]\'),
                (11, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_persona_title\', \'["BROWSE","READ"]\'),
                (12, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_persona_data\', \'["BROWSE","READ"]\'),
                (13, 2, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_persona_version\', \'["BROWSE","READ"]\'),
                (14, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual\', \'["BROWSE","READ"]\'),
                (15, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_uuid\', \'["BROWSE","READ"]\'),
                (16, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_created_at\', \'["BROWSE","READ"]\'),
                (17, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona\', \'["BROWSE","READ"]\'),
                (18, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona_uuid\', \'["BROWSE","READ"]\'),
                (19, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona_created_at\', \'["BROWSE","READ"]\'),
                (20, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona_title\', \'["BROWSE","READ"]\'),
                (21, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona_data\', \'["BROWSE","READ"]\'),
                (22, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona_version\', \'["BROWSE","READ"]\'),
                (23, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona\', \'["EDIT","ADD"]\'),
                (24, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona_title\', \'["EDIT"]\'),
                (25, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona_data\', \'["EDIT"]\'),
                (26, 3, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona_version\', \'["EDIT"]\'),
                (27, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization\', \'["BROWSE","READ"]\'),
                (28, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_uuid\', \'["BROWSE","READ"]\'),
                (29, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_created_at\', \'["BROWSE","READ"]\'),
                (30, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona\', \'["BROWSE","READ"]\'),
                (31, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona_uuid\', \'["BROWSE","READ"]\'),
                (32, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona_created_at\', \'["BROWSE","READ"]\'),
                (33, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona_title\', \'["BROWSE","READ"]\'),
                (34, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona_data\', \'["BROWSE","READ"]\'),
                (35, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona_version\', \'["BROWSE","READ"]\'),
                (36, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona\', \'["EDIT","ADD"]\'),
                (37, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona_title\', \'["EDIT"]\'),
                (38, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona_data\', \'["EDIT"]\'),
                (39, 4, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona_version\', \'["EDIT"]\'),
                (40, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous\', \'["BROWSE","READ"]\'),
                (41, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_property\', \'["BROWSE","READ"]\'),
                (42, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_persona\', \'["BROWSE","READ"]\'),
                (43, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'anonymous_persona_property\', \'["BROWSE","READ"]\'),
                (44, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual\', \'["BROWSE","READ"]\'),
                (45, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_property\', \'["BROWSE","READ"]\'),
                (46, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona\', \'["BROWSE","READ"]\'),
                (47, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'individual_persona_property\', \'["BROWSE","READ"]\'),
                (48, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization\', \'["BROWSE","READ"]\'),
                (49, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_property\', \'["BROWSE","READ"]\'),
                (50, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona\', \'["BROWSE","READ"]\'),
                (51, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'organization_persona_property\', \'["BROWSE","READ"]\'),
                (52, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'staff\', \'["BROWSE","READ"]\'),
                (53, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'staff_property\', \'["BROWSE","READ"]\'),
                (54, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'staff_persona\', \'["BROWSE","READ"]\'),
                (55, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'staff_persona_property\', \'["BROWSE","READ"]\'),
                (56, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'business_unit\', \'["BROWSE","READ"]\'),
                (57, 6, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (58, 6, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (59, 6, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\');
        ');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // Schema
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ds_access_permission DROP CONSTRAINT FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_anonymous_persona DROP CONSTRAINT FK_5ABA7A3FA93803');
        $this->addSql('ALTER TABLE app_anonymous_persona_trans DROP CONSTRAINT FK_3B378E082C2AC5D3');
        $this->addSql('ALTER TABLE app_bu_trans DROP CONSTRAINT FK_AE7B40C2C2AC5D3');
        $this->addSql('ALTER TABLE app_staff_bu DROP CONSTRAINT FK_8C89CE59E0319FBC');
        $this->addSql('ALTER TABLE app_individual_persona DROP CONSTRAINT FK_828FC6EAE271C0D');
        $this->addSql('ALTER TABLE app_individual_persona_trans DROP CONSTRAINT FK_2EB6F73E2C2AC5D3');
        $this->addSql('ALTER TABLE app_organization_persona DROP CONSTRAINT FK_7767B60F32C8A3DE');
        $this->addSql('ALTER TABLE app_organization_persona_trans DROP CONSTRAINT FK_63870C2F2C2AC5D3');
        $this->addSql('ALTER TABLE app_staff_bu DROP CONSTRAINT FK_8C89CE59D4D57CD');
        $this->addSql('ALTER TABLE app_staff_persona DROP CONSTRAINT FK_972E9C81D4D57CD');
        $this->addSql('ALTER TABLE app_staff_persona_trans DROP CONSTRAINT FK_83B289352C2AC5D3');
        $this->addSql('DROP SEQUENCE ds_config_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_permission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_anonymous_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_anonymous_persona_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_anonymous_persona_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_bu_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_bu_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_individual_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_individual_persona_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_individual_persona_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_organization_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_organization_persona_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_organization_persona_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_staff_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_staff_persona_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_staff_persona_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_system_id_seq CASCADE');
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_access');
        $this->addSql('DROP TABLE ds_access_permission');
        $this->addSql('DROP TABLE ds_session');
        $this->addSql('DROP TABLE app_anonymous');
        $this->addSql('DROP TABLE app_anonymous_persona');
        $this->addSql('DROP TABLE app_anonymous_persona_trans');
        $this->addSql('DROP TABLE app_bu');
        $this->addSql('DROP TABLE app_bu_trans');
        $this->addSql('DROP TABLE app_individual');
        $this->addSql('DROP TABLE app_individual_persona');
        $this->addSql('DROP TABLE app_individual_persona_trans');
        $this->addSql('DROP TABLE app_organization');
        $this->addSql('DROP TABLE app_organization_persona');
        $this->addSql('DROP TABLE app_organization_persona_trans');
        $this->addSql('DROP TABLE app_staff');
        $this->addSql('DROP TABLE app_staff_bu');
        $this->addSql('DROP TABLE app_staff_persona');
        $this->addSql('DROP TABLE app_staff_persona_trans');
        $this->addSql('DROP TABLE app_system');
    }
}
