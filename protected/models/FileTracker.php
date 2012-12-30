<?php

/**
 * This is the model class for table "FileTracker".
 *
 * The followings are the available columns in table 'FileTracker':
 * @property integer $id
 * @property string $LandID
 * @property string $UserIDgiver
 * @property string $UserIDreceiver
 * @property string $Department
 * @property string $DateTime
 * @property string $Status
 */
class FileTracker extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FileTracker the static model class
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
		return 'FileTracker';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LandID, UserIDgiver, UserIDreceiver, Department, DateTime, Status', 'required'),
			array('LandID, UserIDgiver, UserIDreceiver, Department, DateTime, Status', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, LandID, UserIDgiver, UserIDreceiver, Department, DateTime, Status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'LandID' => 'Land',
			'UserIDgiver' => 'User Idgiver',
			'UserIDreceiver' => 'User Idreceiver',
			'Department' => 'Department',
			'DateTime' => 'Date Time',
			'Status' => 'Status',
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
		$criteria->compare('LandID',$this->LandID,true);
		$criteria->compare('UserIDgiver',$this->UserIDgiver,true);
		$criteria->compare('UserIDreceiver',$this->UserIDreceiver,true);
		$criteria->compare('Department',$this->Department,true);
		$criteria->compare('DateTime',$this->DateTime,true);
		$criteria->compare('Status',$this->Status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}