<?php

class m130630_175713_add_display_to_reportable extends CDbMigration
{
	public function up()
	{
	  $this->addColumn('reportables', 'display', 'text AFTER `title` ');

	}

	public function down()
	{
		echo "m130630_175713_add_display_to_reportable does not support migration down.\n";
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