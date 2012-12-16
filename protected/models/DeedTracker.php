<?php

/**
 * This is the model class for table "DeedTracker".
 *
 * The followings are the available columns in table 'DeedTracker':
 * @property integer $TrackID
 * @property string $DeedID
 * @property string $UserID
 * @property string $DateTime
 * @property string $Status
 *
 * The followings are the available model relations:
 * @property User $user
 * @property DeedMaster $deed
 */
class DeedTracker extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeedTracker the static model class
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
		return 'DeedTracker';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('DeedID, UserID, DateTime, Status', 'required'),
		//	array('DeedID, Status', 'length', 'max'=>10),
		//	array('UserID', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TrackID, DeedID, LandID, UserID, DateTime, Status', 'safe', 'on'=>'search'),
			array('TrackID, DeedID, LandID, UserID, DateTime, Status', 'safe'),
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
			'deed' => array(self::BELONGS_TO, 'DeedMaster', 'DeedID'),
			'land' => array(self::BELONGS_TO, 'LandMaster', 'LandID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TrackID' => 'رقم تسلسلي',
			'DeedID' => 'رقم الملكية',
			'LandID' => 'رقم السند',
			'UserID' => 'اسم المستخدم',
			'DateTime' => 'تاريخ الطباعة',
			'Status' => 'حالة',
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

		$criteria->compare('TrackID',$this->TrackID);
		$criteria->compare('DeedID',$this->DeedID,true);
		$criteria->compare('LandID',$this->LandID,true);
		$criteria->compare('UserID',$this->UserID,true);
		$criteria->compare('DateTime',$this->DateTime,true);
		$criteria->compare('Status',$this->Status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
