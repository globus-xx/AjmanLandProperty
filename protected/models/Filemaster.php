<?php

/**
 * This is the model class for table "filemaster".
 *
 * The followings are the available columns in table 'filemaster':
 * @property string $FileID
 * @property string $LandID
 * @property integer $DeedID
 * @property string $Image
 * @property string $Title
 * @property string $Remarks
 * @property string $Type
 * @property string $UserIDcreated
 * @property string $DateCreated
 * @property string $IsActive
 */
class Filemaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Filemaster the static model class
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
		return 'filemaster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DeedID', 'numerical', 'integerOnly'=>true),
			array('LandID', 'length', 'max'=>200),
			array('Image, Title, Remarks', 'length', 'max'=>250),
			array('Type', 'length', 'max'=>20),
			array('UserIDcreated', 'length', 'max'=>64),
			array('IsActive', 'length', 'max'=>15),
			array('DateCreated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FileID, LandID, DeedID, Image, Title, Remarks, Type, UserIDcreated, DateCreated, IsActive', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'FileID' => 'File',
			'LandID' => 'Land',
			'DeedID' => 'Deed',
			'Image' => 'Image',
			'Title' => 'Title',
			'Remarks' => 'Remarks',
			'Type' => 'Type',
			'UserIDcreated' => 'User Idcreated',
			'DateCreated' => 'Date Created',
			'IsActive' => 'Is Active',
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

		$criteria->compare('FileID',$this->FileID,true);
		$criteria->compare('LandID',$this->LandID,true);
		$criteria->compare('DeedID',$this->DeedID);
		$criteria->compare('Image',$this->Image,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Remarks',$this->Remarks,true);
		$criteria->compare('Type',$this->Type,true);
		$criteria->compare('UserIDcreated',$this->UserIDcreated,true);
		$criteria->compare('DateCreated',$this->DateCreated,true);
		$criteria->compare('IsActive',$this->IsActive,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}