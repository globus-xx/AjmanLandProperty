<?php

/**
 * This is the model class for table "HajzMaster".
 *
 * The followings are the available columns in table 'HajzMaster':
 * @property string $HajzID
 * @property string $LandID
 * @property string $DeedID
 * @property integer $SchemeID
 * @property string $Type
 * @property string $TypeDetail
 * @property string $DocsCreated
 * @property string $UserIDcreated
 * @property string $DateCreated
 * @property integer $AmountMortgaged
 * @property integer $PeriodofTime
 * @property string $UserIDended
 * @property string $DateEnded
 * @property string $DocsEnded
 * @property integer $IsActive
 *
 * The followings are the available model relations:
 * @property User $userIDended
 * @property LandMaster $land
 * @property DeedMaster $deed
 * @property LandScheme $scheme
 * @property User $userIDcreated
 */
class HajzMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HajzMaster the static model class
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
		return 'HajzMaster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('LandID, DeedID, SchemeID, Type, TypeDetail, DocsCreated, UserIDcreated, DateCreated, AmountMortgaged, PeriodofTime, UserIDended, DateEnded, DocsEnded, IsActive', 'required'),
		//	array('SchemeID, AmountMortgaged, PeriodofTime, IsActive', 'numerical', 'integerOnly'=>true),
		//	array('LandID, DeedID', 'length', 'max'=>10),
		//	array('Type', 'length', 'max'=>20),
		//	array('TypeDetail', 'length', 'max'=>250),
		//	array('UserIDcreated, UserIDended', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('HajzID, LandID, DeedID, SchemeID, Type, TypeDetail, DocsCreated, UserIDcreated, DateCreated, AmountMortgaged, PeriodofTime, UserIDended, DateEnded, DocsEnded, IsActive', 'safe', 'on'=>'search'),
			array('HajzID, LandID, DeedID, SchemeID, Type, TypeDetail, DocsCreated, UserIDcreated, DateCreated, AmountMortgaged, PeriodofTime, UserIDended, DateEnded, DocsEnded, IsActive', 'safe'),
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
			'userIDended' => array(self::BELONGS_TO, 'User', 'UserIDended'),
			'land' => array(self::BELONGS_TO, 'LandMaster', 'LandID'),
			'deed' => array(self::BELONGS_TO, 'DeedMaster', 'DeedID'),
			'scheme' => array(self::BELONGS_TO, 'LandScheme', 'SchemeID'),
			'userIDcreated' => array(self::BELONGS_TO, 'User', 'UserIDcreated'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'HajzID' => 'رقم الحجز/الرهن',
			'LandID' => 'رقم السند',
			'DeedID' => 'رقم الملكية',
			'SchemeID' => 'رقم المخطط',
			'Type' => 'النوع ',
			'TypeDetail' => 'تفاصيل',
			'DocsCreated' => 'المستندات وقت الانشاء',
			'UserIDcreated' => 'اسم المستخدم',
			'DateCreated' => 'تاريخ الانشاء',
			'AmountMortgaged' => 'قيمة الرهن',
			'PeriodofTime' => 'مدة  الرهن',
			'UserIDended' => 'المستخدم إلغاء',
			'DateEnded' => 'تاريخ الإلغء',
			'DocsEnded' => 'المستندات وقت الإغاء',
			'IsActive' => 'IsActive (1 - نعم, 0 - إلغاء)',
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

		$criteria->compare('HajzID',$this->HajzID,true);
		$criteria->compare('LandID',$this->LandID,true);
		$criteria->compare('DeedID',$this->DeedID,true);
		$criteria->compare('SchemeID',$this->SchemeID);
		$criteria->compare('Type',$this->Type,true);
		$criteria->compare('TypeDetail',$this->TypeDetail,true);
		$criteria->compare('DocsCreated',$this->DocsCreated,true);
		$criteria->compare('UserIDcreated',$this->UserIDcreated,true);
		$criteria->compare('DateCreated',$this->DateCreated,true);
		$criteria->compare('AmountMortgaged',$this->AmountMortgaged);
		$criteria->compare('PeriodofTime',$this->PeriodofTime);
		$criteria->compare('UserIDended',$this->UserIDended,true);
		$criteria->compare('DateEnded',$this->DateEnded,true);
		$criteria->compare('DocsEnded',$this->DocsEnded,true);
		$criteria->compare('IsActive',$this->IsActive);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
