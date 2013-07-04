<?php

class m130604_163115_documentableTable extends CDbMigration
{
	public function up()
	{
		$this->createTable('documentable', array(
          'id' => 'pk',
          'documentId' => 'integer',
          'documentable_type' => 'string',
          'documentable_id'=>'integer',
          'createdAt'=>'datetime',
          'updatedAt'=>'datetime'
      ));

      $this->addForeignKey('FKdocumentableDocumentId', 'documentable', 'documentId', 'documents', 'id', 'NO ACTION', 'NO ACTION');
	}

	public function down()
	{
		echo "m130604_163115_documentableTable does not support migration down.\n";
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