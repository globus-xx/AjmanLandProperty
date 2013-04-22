<?php

class m130422_192431_create_documents_table extends CDbMigration
{
	public function up()
	{
	    $this->createTable('documents', array(
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'fileName'=>'string',
            'mimeType'=>'string',
            'fileSize' => 'integer',
        ));
	}

	public function down()
	{
		echo "m130422_192431_create_documents_table does not support migration down.\n";
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