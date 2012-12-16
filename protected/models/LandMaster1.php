<?php

/**
 * This is the model class for table "LandMaster".
 *
 * The followings are the available columns in table 'LandMaster':
 * @property string $LandID
 * @property string $LocationID
 * @property integer $Plot_No
 * @property integer $Hodh
 * @property integer $Land_Type
 * @property string $Coordinates
 * @property integer $TotalArea
 *
 * The followings are the available model relations:
 * @property ContractsMaster[] $contractsMasters
 * @property DeedMaster[] $deedMasters
 * @property HajzMaster[] $hajzMasters
 * @property LandDetails[] $landDetails
 * @property LandFines[] $landFines
 * @property LandScheme[] $landSchemes
 */
class LandMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LandMaster the static model class
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
		return 'LandMaster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		//	array('LocationID, Plot_No, Hodh, Land_Type, Coordinates, TotalArea', 'required'),
		//	array('Plot_No, Hodh, Land_Type, TotalArea', 'numerical', 'integerOnly'=>true),
		//	array('LocationID', 'length', 'max'=>10),
		//	array('Coordinates', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('LandID, LocationID, Plot_No, Hodh, Land_Type, Coordinates, TotalArea', 'safe', 'on'=>'search'),
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
			'contractsMasters' => array(self::HAS_MANY, 'ContractsMaster', 'LandID'),
			'deedMasters' => array(self::HAS_MANY, 'DeedMaster', 'LandID'),
			'hajzMasters' => array(self::HAS_MANY, 'HajzMaster', 'LandID'),
			'landDetails' => array(self::HAS_MANY, 'LandDetails', 'LandID'),
			'landFines' => array(self::HAS_MANY, 'LandFines', 'LandID'),
			'landSchemes' => array(self::HAS_MANY, 'LandScheme', 'LandID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'LandID' => 'Land',
			'LocationID' => 'Location',
			'Plot_No' => 'Plot No',
			'Hodh' => 'Hodh',
			'Land_Type' => 'Land Type',
			'Coordinates' => 'Coordinates',
			'TotalArea' => 'Total Area',
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

		$criteria->compare('LandID',$this->LandID,true);
		$criteria->compare('LocationID',$this->LocationID,true);
		$criteria->compare('Plot_No',$this->Plot_No);
		$criteria->compare('Hodh',$this->Hodh);
		$criteria->compare('Land_Type',$this->Land_Type);
		$criteria->compare('Coordinates',$this->Coordinates,true);
		$criteria->compare('TotalArea',$this->TotalArea);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
