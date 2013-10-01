<?php

class m131001_143516_add_grouped_owner_to_reportables extends CDbMigration
{
	public function up()
	{
    	  $this->addColumn('reportables', 'grouped', 'text AFTER `reportable_type` ');
	  $this->addColumn('reportables', 'created_by', 'string AFTER `reportable_type` ');

	}

	public function down()
	{
		echo "m131001_143516_add_grouped_owner_to_reportables does not support migration down.\n";
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