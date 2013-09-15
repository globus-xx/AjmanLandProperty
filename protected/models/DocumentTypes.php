<?php

/**
 * This is the model class for table "documenttypes".
 *
 * The followings are the available columns in table 'documenttypes':
 * @property integer $id
 * @property string $title
 * @property string $table_name
 * @property string $primary_id
 * @property string $createdAt
 * @property string $updatedAt
 *
 * The followings are the available model relations:
 * @property Documents[] $documents
 * @property Documenttypemetas[] $documenttypemetases
 */
class Documenttypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documenttypes the static model class
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
		return 'documenttypes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, table_name, primary_id', 'required'),
			array('title', 'length', 'max'=>255),
			array('table_name, primary_id', 'length', 'max'=>1000),
			array('createdAt, updatedAt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, table_name, primary_id, createdAt, updatedAt', 'safe', 'on'=>'search'),
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
			'documents' => array(self::HAS_MANY, 'Documents', 'documentTypeId'),
			'documenttypemetases' => array(self::HAS_MANY, 'Documenttypemetas', 'documentTypeId'),
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
			'table_name' => 'Table Name',
			'primary_id' => 'Primary',
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
		$criteria->compare('table_name',$this->table_name,true);
		$criteria->compare('primary_id',$this->primary_id,true);
		$criteria->compare('createdAt',$this->createdAt,true);
		$criteria->compare('updatedAt',$this->updatedAt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}