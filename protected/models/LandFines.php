<?php

/**
 * This is the model class for table "LandFines".
 *
 * The followings are the available columns in table 'LandFines':
 * @property string $LandFinesID
 * @property string $LandID
 * @property integer $FineType
 * @property string $FineDescription
 * @property string $DateInserted
 * @property string $DocsCreated
 * @property integer $Closed
 * @property string $DateClosed
 * @property string $UserIDclosed
 * @property string $DocsClosed
 * @property string $Remarks
 *
 * The followings are the available model relations:
 * @property User $userIDclosed
 * @property LandMaster $land
 */
class LandFines extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LandFines the static model class
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
		return 'LandFines';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('LandID, FineType, FineDescription, DateInserted, DocsCreated, Closed, DateClosed, UserIDclosed, DocsClosed, Remarks', 'required'),
		//	array('FineType, Closed', 'numerical', 'integerOnly'=>true),
		//	array('LandID', 'length', 'max'=>10),
		//	array('FineDescription, Remarks', 'length', 'max'=>250),
		//	array('UserIDclosed', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('LandFinesID, LandID, FineType, FineDescription, DateInserted, DocsCreated, Closed, DateClosed, UserIDclosed, DocsClosed, Remarks', 'safe', 'on'=>'search'),
			array('LandFinesID, LandID, FineType, FineDescription, DateInserted, DocsCreated, Closed, DateClosed, UserIDclosed, DocsClosed, Remarks', 'safe'),
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
			'userIDclosed' => array(self::BELONGS_TO, 'User', 'UserIDclosed'),
			'land' => array(self::BELONGS_TO, 'LandMaster', 'LandID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'LandFinesID' => 'Land Fines',
			'LandID' => 'Land',
			'FineType' => 'Fine Type',
			'FineDescription' => 'Fine Description',
			'DateInserted' => 'Date Inserted',
			'DocsCreated' => 'Docs Created',
			'Closed' => 'Closed',
			'DateClosed' => 'Date Closed',
			'UserIDclosed' => 'User Idclosed',
			'DocsClosed' => 'Docs Closed',
			'Remarks' => 'Remarks',
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

		$criteria->compare('LandFinesID',$this->LandFinesID,true);
		$criteria->compare('LandID',$this->LandID,true);
		$criteria->compare('FineType',$this->FineType);
		$criteria->compare('FineDescription',$this->FineDescription,true);
		$criteria->compare('DateInserted',$this->DateInserted,true);
		$criteria->compare('DocsCreated',$this->DocsCreated,true);
		$criteria->compare('Closed',$this->Closed);
		$criteria->compare('DateClosed',$this->DateClosed,true);
		$criteria->compare('UserIDclosed',$this->UserIDclosed,true);
		$criteria->compare('DocsClosed',$this->DocsClosed,true);
		$criteria->compare('Remarks',$this->Remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
