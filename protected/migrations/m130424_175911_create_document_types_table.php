<?php

class m130424_175911_create_document_types_table extends CDbMigration
{
	public function up()
	{
	    $this->createTable('documentTypes', array(
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'createdAt'=>'datetime',
            'updatedAt'=>'datetime'
        ));
	}

	public function down()
	{
		echo "m130424_175911_create_document_types_table does not support migration down.\n";
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