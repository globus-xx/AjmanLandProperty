<?php

class m130506_180433_create_document_metas extends CDbMigration
{
	public function up()
	{
    $this->createTable('documentMetas', array(
          'id' => 'pk',
          'documentId' => 'integer',
          'documentTypeMetaId' => 'integer',
          'meta_value'=>'string',
          'createdAt'=>'datetime',
          'updatedAt'=>'datetime'
      ));

      $this->addForeignKey('FKdocumentMetaDocumentId', 'documentMetas', 'documentId', 'documents', 'id', 'NO ACTION', 'NO ACTION');
      $this->addForeignKey('FKdocumentMetaDocumentTypeMetaId', 'documentMetas', 'documentTypeMetaId', 'documentTypeMetas', 'id', 'NO ACTION', 'NO ACTION');
	}

	public function down()
	{
		echo "m130506_180433_create_document_metas does not support migration down.\n";
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