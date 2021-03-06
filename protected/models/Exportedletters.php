<?php

/**
 * This is the model class for table "Letters".
 *
 * The followings are the available columns in table 'Letters':
 * @property integer $LetterID
 * @property string $Title

 *
 * The followings are the available model relations:

 */
class Exportedletters extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CustomerMaster the static model class
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
		return 'Exportedletters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
	//		array('CustomerNameArabic, CustomerNameEnglish, HomeAddress, HomePhone, MobilePhone, DateofBirth, Nationality, DocumentNumber, IssuedOn, ExpiresOn, EmailAddress',  'required'),
	//		array('CustomerNameArabic, CustomerNameEnglish, EmailAddress', 'length', 'max'=>100),
	//		array('HomeAddress', 'length', 'max'=>250),
	//		array('HomePhone, MobilePhone', 'length', 'max'=>10),
	//		array('Nationality', 'length', 'max'=>20),
	//		array('DocumentType, CustomerType', 'length', 'max'=>50),
	//		array('DocumentNumber', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
                        array('ExportedletterID, Exportedlettertext,UserName,ExportedDate ', 'safe', 'on'=>'search'),
			array('ExportedletterID, Exportedlettertext,UserName,ExportedDate', 'safe'),
                        
		);
	}

	/**
	 * @return array relational rules.
	 */
//	public function relations()
//	{
//		// NOTE: you may need to adjust the relation name and the related
//		// class name for the relations automatically generated below.
//		return array(
//			'contractsDetails' => array(self::HAS_MANY, 'ContractsDetail', 'CustomerID'),
//			'deedDetails' => array(self::HAS_MANY, 'DeedDetails', 'CustomerID'),
//			'invoices' => array(self::HAS_MANY, 'Invoices', 'CustomerID'),
//			'realEstateOffices' => array(self::HAS_MANY, 'RealEstateOffices', 'OwnerName'),
//		);
//	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ExportedletterID' => 'رقم الرسالة الصادرة',
			'Exportedlettertext' => 'الرسالة الصادرة',
			'UserName' => 'اسم المستخدم',
                        'ExportedDate' => 'تاريخ الاصدار',
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

		$criteria->compare('ExportedletterID',$this->ExportedletterID);
		$criteria->compare('Exportedlettertext',$this->Exportedlettertext,true);
                $criteria->compare('UserName',$this->UserName,true);
		$criteria->compare('ExportedDate',$this->ExportedDate,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
