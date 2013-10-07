<?php

class m131007_085725_create_options extends CDbMigration
{
	public function up()
	{
    $this->createTable('options', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
            'value'=>'text'
        ));
	}

	public function down()
	{
		echo "m131007_085725_create_options does not support migration down.\n";
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