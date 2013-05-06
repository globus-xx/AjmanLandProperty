<?php

class m130424_180418_create_document_type_metas_table extends CDbMigration
{
	public function up()
	{
	    $this->createTable('documentTypeMetas', array(
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'documentTypeId' => 'integer',
            'meta_option'=>'string',
            'meta_type'=>'string',
            'createdAt'=>'datetime',
            'updatedAt'=>'datetime'
        ));

        $this->addForeignKey('FKdocumentTypeMetaDocumentTypeId', 'documentTypeMetas', 'documentTypeId', 'documentTypes', 'id', 'NO ACTION', 'NO ACTION');
	}

	public function down()
	{
		echo "m130424_180418_create_document_type_metas_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}