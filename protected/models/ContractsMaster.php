<?php

/**
 * This is the model class for table "ContractsMaster".
 *
 * The followings are the available columns in table 'ContractsMaster':
 * @property string $ContractsID
 * @property string $LandID
 * @property string $DateCreated
 * @property string $UserID
 * @property string $ContractType
 * @property string $DeedID
 * @property integer $SchemeID
 * @property integer $AmountEntered
 * @property integer $AmountCorrected
 * @property string $UserIDcorrected
 * @property string $UserIDApproved
 * @property integer $Fee
 * @property integer $InvoiceNo
 *
 * The followings are the available model relations:
 * @property ContractsDetail[] $contractsDetails
 * @property User $userIDApproved
 * @property LandMaster $land
 * @property LandScheme $scheme
 * @property Invoices $invoiceNo
 * @property DeedMaster $deed
 * @property User $user
 * @property User $userIDcorrected
 * @property DeedMaster[] $deedMasters
 */
class ContractsMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContractsMaster the static model class
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
		return 'ContractsMaster';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('LandID, DateCreated, UserID, ContractType, DeedID, SchemeID, AmountEntered, AmountCorrected, UserIDcorrected, UserIDApproved, Fee, InvoiceNo', 'required'),
		//	array('SchemeID, AmountEntered, AmountCorrected, Fee, InvoiceNo', 'numerical', 'integerOnly'=>true),
		//	array('LandID, DeedID', 'length', 'max'=>10),
		//	array('UserID, UserIDcorrected, UserIDApproved', 'length', 'max'=>64),
		//	array('ContractType', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ContractsID, LandID, DateCreated, UserID, ContractType, DeedID, SchemeID, AmountEntered, AmountCorrected, UserIDcorrected, UserIDApproved, Fee, InvoiceNo, Remarks, Status', 'safe', 'on'=>'search'),
			array('ContractsID, LandID, DateCreated, UserID, ContractType, DeedID, SchemeID, AmountEntered, AmountCorrected, UserIDcorrected, UserIDApproved, Fee, InvoiceNo, Remarks, Status', 'safe'),
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
			'contractsDetails' => array(self::HAS_MANY, 'ContractsDetail', 'ContractID'),
			'userIDApproved' => array(self::BELONGS_TO, 'User', 'UserIDApproved'),
			'land' => array(self::BELONGS_TO, 'LandMaster', 'LandID'),
			'scheme' => array(self::BELONGS_TO, 'LandScheme', 'SchemeID'),
			'invoiceNo' => array(self::BELONGS_TO, 'Invoices', 'InvoiceNo'),
			'deed' => array(self::BELONGS_TO, 'DeedMaster', 'DeedID'),
			'user' => array(self::BELONGS_TO, 'User', 'UserID'),
			'userIDcorrected' => array(self::BELONGS_TO, 'User', 'UserIDcorrected'),
			'deedMasters' => array(self::HAS_MANY, 'DeedMaster', 'ContractID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ContractsID' => 'رقم العقد',
			'LandID' => 'رقم الارض',
			'DateCreated' => 'تاريخ العقد',
			'UserID' => ' اسم المستخدم ',
			'ContractType' => 'نوع العقد',
			'DeedID' => 'رقم الملكية',
			'SchemeID' => 'رقم المخطط',
			'AmountEntered' => 'المبلغ',
			'AmountCorrected' => 'تعديل المبلغ ',
			'UserIDcorrected' => 'تعديل المستخدم',
			'UserIDApproved' => ' اعتماد',
			'Fee' => 'الرسوم',
			'InvoiceNo' => 'رقم الايصال',
			'Remarks' => 'الملاحظات',
			'Status' => 'الحالة',
		);
	}

	public function getReportFromReportable($reportable){

		$attributes = $reportable->attributes;
 
		$attributes['display'] = Reportable::objectToArray(json_decode($attributes['display']));

		$sql = 'SELECT  ';
		$f = array();

		foreach($attributes['display'] as $model=>$fields){
			foreach($fields as $ii=>$afield):
				$f[]= $model.'.'.$ii;
			endforeach;
		}

		$sql.= join(', ', $f);

		$sql.= ' FROM ContractsMaster ';

		$sql.=' LEFT JOIN LandMaster on LandMaster.LandID = ContractsMaster.LandID ';
		$sql.=' LEFT JOIN ContractsDetail on ContractsDetail.ContractID = ContractsMaster.ContractsID ';
		$sql.=' LEFT JOIN CustomerMaster on ContractsDetail.CustomerID = CustomerMaster.CustomerID ';

		//$reportable->conditions = unserialize($reportable->conditions);
	 	$attributes['conditions'] = Reportable::objectToArray(json_decode($attributes['conditions']));
		foreach($attributes['conditions'] as $field_name=>$attribs){
			$cnd = $attribs['attrib'];
			if ($cnd =='gt'){
				$cnd = '>';
			}elseif($cnd =='lt'){
				$cnd = '<';
			}

			if(is_array($attribs['value'])){
				foreach($attribs['value'] as $ii=>$vv){
					$attribs['value'][$ii] = "'".$vv."'";
				}
				$attribs['value'] = $attribs['value'].join(',');
			}else{
				$attribs['value'] = "'".$attribs['value']."'";
			}

		    $sql.= ( strstr( $sql, "WHERE" ) ?  " AND " : " WHERE " )."  ( ".$attribs['field']."   ".$cnd." ( ".$attribs['value']." ) ) "."";
			
		}


		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$results = $command->queryAll();		
		return $results;


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

		$criteria->compare('ContractsID',$this->ContractsID,true);
		$criteria->compare('LandID',$this->LandID,true);
		$criteria->compare('DateCreated',$this->DateCreated,true);
		$criteria->compare('UserID',$this->UserID,true);
		$criteria->compare('ContractType',$this->ContractType,true);
		$criteria->compare('DeedID',$this->DeedID,true);
		$criteria->compare('SchemeID',$this->SchemeID);
		$criteria->compare('AmountEntered',$this->AmountEntered);
		$criteria->compare('AmountCorrected',$this->AmountCorrected);
		$criteria->compare('UserIDcorrected',$this->UserIDcorrected,true);
		$criteria->compare('UserIDApproved',$this->UserIDApproved,true);
		$criteria->compare('Fee',$this->Fee);
		$criteria->compare('InvoiceNo',$this->InvoiceNo);
		$criteria->compare('Remarks', $this->Remarks);
		$criteria->compare('Status', $this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
