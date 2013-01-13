<?php

/**
 * This is the model class for table "CustomerMaster".
 *
 * The followings are the available columns in table 'CustomerMaster':
 * @property integer $CustomerID
 * @property string $CustomerNameArabic
 * @property string $CustomerNameEnglish
 * @property string $HomeAddress
 * @property string $HomePhone
 * @property string $MobilePhone
 * @property string $DateofBirth
 * @property string $Nationality
 * @property string $Signature
 * @property string $DocumentType
 * @property string $DocumentNumber
 * @property string $IssuedOn
 * @property string $ExpiresOn
 * @property string $EmailAddress
 * @property string $Document
 * @property string $Photo
 * @property string $CustomerType
 *
 * The followings are the available model relations:
 * @property ContractsDetail[] $contractsDetails
 * @property DeedDetails[] $deedDetails
 * @property Invoices[] $invoices
 * @property RealEstateOffices[] $realEstateOffices
 */
class CustomerMaster extends CActiveRecord
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
		return 'CustomerMaster';
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
			array('CustomerID, CustomerNameArabic, CustomerNameEnglish, HomeAddress, HomePhone, MobilePhone, DateofBirth, Nationality, Signature, DocumentType, DocumentNumber, IssuedOn, ExpiresOn, EmailAddress, Document, Photo, CustomerType', 'safe', 'on'=>'search'),
			array('CustomerID, CustomerNameArabic, CustomerNameEnglish, HomeAddress, HomePhone, MobilePhone, DateofBirth, Nationality, Signature, DocumentType, DocumentNumber, IssuedOn, ExpiresOn, EmailAddress, Document, Photo, CustomerType', 'safe'),
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
			'contractsDetails' => array(self::HAS_MANY, 'ContractsDetail', 'CustomerID'),
			'deedDetails' => array(self::HAS_MANY, 'DeedDetails', 'CustomerID'),
			'invoices' => array(self::HAS_MANY, 'Invoices', 'CustomerID'),
			'realEstateOffices' => array(self::HAS_MANY, 'RealEstateOffices', 'OwnerName'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CustomerID' => 'رقم العميل',
			'CustomerNameArabic' => 'الإسم -- عربي',
			'CustomerNameEnglish' => 'ألإسم -- إنجليزي',
			'HomeAddress' => 'عنوان المنزل',
			'HomePhone' => 'هاتف المنزل',
			'MobilePhone' => 'هاتف محمول',
			'DateofBirth' => 'تاريخ الميلاد',
			'Nationality' => 'جنسية',
			'Signature' => 'توقيع',
			'DocumentType' => 'هوية',
			'DocumentNumber' => 'رقم الهوية',
			'IssuedOn' => 'تاريخ الإصدار',
			'ExpiresOn' => 'تاريخ انتهاء',
			'EmailAddress' => 'البريد الإلكتروني',
			'Document' => 'المستند',
			'Photo' => 'الصورة',
			'CustomerType' => 'نوع العميل',
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

		$criteria->compare('CustomerID',$this->CustomerID);
		$criteria->compare('CustomerNameArabic',$this->CustomerNameArabic,true);
		$criteria->compare('CustomerNameEnglish',$this->CustomerNameEnglish,true);
		$criteria->compare('HomeAddress',$this->HomeAddress,true);
		$criteria->compare('HomePhone',$this->HomePhone,true);
		$criteria->compare('MobilePhone',$this->MobilePhone,true);
		$criteria->compare('DateofBirth',$this->DateofBirth,true);
		$criteria->compare('Nationality',$this->Nationality,true);
		$criteria->compare('Signature',$this->Signature,true);
		$criteria->compare('DocumentType',$this->DocumentType,true);
		$criteria->compare('DocumentNumber',$this->DocumentNumber,true);
		$criteria->compare('IssuedOn',$this->IssuedOn,true);
		$criteria->compare('ExpiresOn',$this->ExpiresOn,true);
		$criteria->compare('EmailAddress',$this->EmailAddress,true);
		$criteria->compare('Document',$this->Document,true);
		$criteria->compare('Photo',$this->Photo,true);
		$criteria->compare('CustomerType',$this->CustomerType,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
