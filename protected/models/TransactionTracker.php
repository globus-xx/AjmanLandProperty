<?php

/**
 * This is the model class for table "TransactionTracker".
 *
 * The followings are the available columns in table 'TransactionTracker':
 * @property integer $TransactionID
 * @property string $TransactionType
 * @property integer $RecordID
 * @property string $UserID
 * @property string $CpuID
 * @property string $DateTimeStart
 * @property string $DateTimeFinish
 *
 * The followings are the available model relations:
 * @property User $user
 */
class TransactionTracker extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransactionTracker the static model class
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
		return 'TransactionTracker';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('TransactionType, RecordID, UserID, CpuID, DateTimeStart, DateTimeFinish', 'required'),
		//	array('RecordID', 'numerical', 'integerOnly'=>true),
		//	array('TransactionType', 'length', 'max'=>15),
		//	array('UserID', 'length', 'max'=>64),
		//	array('CpuID', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TransactionID, TransactionType, RecordID, UserID, CpuID, DateTimeStart, DateTimeFinish', 'safe', 'on'=>'search'),
			array('TransactionID, TransactionType, RecordID, UserID, CpuID, DateTimeStart, DateTimeFinish', 'safe'),
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
			'user' => array(self::BELONGS_TO, 'User', 'UserID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TransactionID' => 'Transaction',
			'TransactionType' => 'Transaction Type',
			'RecordID' => 'Record',
			'UserID' => 'User',
			'CpuID' => 'Cpu',
			'DateTimeStart' => 'Date Time Start',
			'DateTimeFinish' => 'Date Time Finish',
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

		$criteria->compare('TransactionID',$this->TransactionID);
		$criteria->compare('TransactionType',$this->TransactionType,true);
		$criteria->compare('RecordID',$this->RecordID);
		$criteria->compare('UserID',$this->UserID,true);
		$criteria->compare('CpuID',$this->CpuID,true);
		$criteria->compare('DateTimeStart',$this->DateTimeStart,true);
		$criteria->compare('DateTimeFinish',$this->DateTimeFinish,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
