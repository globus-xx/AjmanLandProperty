<?php

class m130506_181605_alter_document extends CDbMigration
{
	public function up()
	{
	  $this->addColumn('documents', 'documentTypeId', 'integer AFTER `title` ');
    $this->addForeignKey('FKdocumentDocumentId', 'documents', 'documentTypeId', 'documentTypes', 'id', 'NO ACTION', 'NO ACTION');
    
	}

	public function down()
	{
		echo "m130506_181605_alter_document does not support migration down.\n";
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