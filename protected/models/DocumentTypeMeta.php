<?php

/**
 * This is the model class for table "documenttypemetas".
 *
 * The followings are the available columns in table 'documenttypemetas':
 * @property integer $id
 * @property string $title
 * @property integer $documentTypeId
 * @property string $meta_option
 * @property string $meta_type
 * @property string $createdAt
 * @property string $updatedAt
 *
 * The followings are the available model relations:
 * @property Documenttypes $documentType
 */
class DocumentTypeMeta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentTypeMeta the static model class
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
		return 'documenttypemetas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('documentTypeId', 'numerical', 'integerOnly'=>true),
			array('title, meta_option, meta_type', 'length', 'max'=>255),
			array('createdAt, updatedAt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, documentTypeId, meta_option, meta_type, createdAt, updatedAt', 'safe', 'on'=>'search'),
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
			'documentType' => array(self::BELONGS_TO, 'DocumentTypes', 'documentTypeId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'documentTypeId' => 'Document Type',
			'meta_option' => 'Meta Option',
			'meta_type' => 'Meta Type',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('documentTypeId',$this->documentTypeId);
		$criteria->compare('meta_option',$this->meta_option,true);
		$criteria->compare('meta_type',$this->meta_type,true);
		$criteria->compare('createdAt',$this->createdAt,true);
		$criteria->compare('updatedAt',$this->updatedAt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}