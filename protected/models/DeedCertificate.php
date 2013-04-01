<?php

/**
 * This is the model class for table "DeedCertificate".
 *
 * The followings are the available columns in table 'DeedCertificate':
 * @property integer $id
 * @property string $sha1
 * @property string $LandID
 * @property integer $DeedID
 * @property integer $ContractsID
 * @property string $UserID
 * @property string $DateTime
 */
class DeedCertificate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeedCertificate the static model class
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
		return 'DeedCertificate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sha1, LandID, DeedID, UserID, DateTime', 'required'),
			array('DeedID, ContractsID', 'numerical', 'integerOnly'=>true),
			array('sha1, DateTime', 'length', 'max'=>100),
			array('LandID', 'length', 'max'=>200),
			array('UserID', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sha1, LandID, DeedID, ContractsID, UserID, DateTime', 'safe', 'on'=>'search'),
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
			'sha1' => 'Sha1',
			'LandID' => 'Land',
			'DeedID' => 'Deed',
			'ContractsID' => 'Contracts',
			'UserID' => 'User',
			'DateTime' => 'Date Time',
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
		$criteria->compare('sha1',$this->sha1,true);
		$criteria->compare('LandID',$this->LandID,true);
		$criteria->compare('DeedID',$this->DeedID);
		$criteria->compare('ContractsID',$this->ContractsID);
		$criteria->compare('UserID',$this->UserID,true);
		$criteria->compare('DateTime',$this->DateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}