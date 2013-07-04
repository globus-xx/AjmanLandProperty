<?php

class m130606_145708_CreateReportable extends CDbMigration
{
	public function up()
	{
		$this->createTable('reportables', array(
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'conditions'=>'text',
            'reportable_type'=>'string'
        ));
	}

	public function down()
	{
		echo "m130606_145708_CreateReportable does not support migration down.\n";
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