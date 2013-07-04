<?php

/**
 * This is the model class for table "documentMetas".
 *
 * The followings are the available columns in table 'documentMetas':
 * @property integer $id
 * @property integer $documentId
 * @property integer $documentTypeMetaId
 * @property string $meta_value
 * @property string $createdAt
 * @property string $updatedAt
 */
class DocumentMeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentMeta the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documentMetas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documentId, documentTypeMetaId', 'numerical', 'integerOnly'=>true),
			array('meta_value', 'length', 'max'=>255),
			array('createdAt, updatedAt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, documentId, documentTypeMetaId, meta_value, createdAt, updatedAt', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
    return array(
      'document' => array(self::BELONGS_TO, 'Document', 'documentId'),
      'documentTypeMeta' => array(self::BELONGS_TO, 'DocumentTypeMeta', 'documentTypeMetaId')
    );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'documentId' => 'Document',
			'documentTypeMetaId' => 'Document Type Meta',
			'meta_value' => 'Meta Value',
			'createdAt' => 'Created At',
			'updatedAt' => 'Updated At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('documentId',$this->documentId);
		$criteria->compare('documentTypeMetaId',$this->documentTypeMetaId);
		$criteria->compare('meta_value',$this->meta_value,true);
		$criteria->compare('createdAt',$this->createdAt,true);
		$criteria->compare('updatedAt',$this->updatedAt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}