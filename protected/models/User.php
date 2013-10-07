<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property string $userID
 * @property string $Password
 * @property string $Name
 * @property string $EmployeeID
 * @property string $ManagerID
 *
 * The followings are the available model relations:
 * @property AuthAssignment[] $authAssignments
 * @property ContractsMaster[] $contractsMasters
 * @property ContractsMaster[] $contractsMasters1
 * @property ContractsMaster[] $contractsMasters2
 * @property DeedMaster[] $deedMasters
 * @property DeedTracker[] $deedTrackers
 * @property HajzMaster[] $hajzMasters
 * @property HajzMaster[] $hajzMasters1
 * @property Invoices[] $invoices
 * @property LandFines[] $landFines
 * @property TransactionTracker[] $transactionTrackers
 * @property User $manager
 * @property User[] $users
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID, Password, Name, EmployeeID, ManagerID', 'required'),
			array('userID, ManagerID', 'length', 'max'=>64),
			array('Password', 'length', 'max'=>16),
			array('Name', 'length', 'max'=>100),
			array('EmployeeID', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userID, Password, Name, EmployeeID, ManagerID', 'safe', 'on'=>'search'),
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
			'authAssignments' => array(self::HAS_MANY, 'AuthAssignment', 'userid'),
			'contractsMasters' => array(self::HAS_MANY, 'ContractsMaster', 'UserIDApproved'),
			'contractsMasters1' => array(self::HAS_MANY, 'ContractsMaster', 'UserID'),
			'contractsMasters2' => array(self::HAS_MANY, 'ContractsMaster', 'UserIDcorrected'),
			'deedMasters' => array(self::HAS_MANY, 'DeedMaster', 'UserID'),
			'deedTrackers' => array(self::HAS_MANY, 'DeedTracker', 'UserID'),
			'hajzMasters' => array(self::HAS_MANY, 'HajzMaster', 'UserIDended'),
			'hajzMasters1' => array(self::HAS_MANY, 'HajzMaster', 'UserIDcreated'),
			'invoices' => array(self::HAS_MANY, 'Invoices', 'UserID'),
			'landFines' => array(self::HAS_MANY, 'LandFines', 'UserIDclosed'),
			'transactionTrackers' => array(self::HAS_MANY, 'TransactionTracker', 'UserID'),
			'manager' => array(self::BELONGS_TO, 'User', 'ManagerID'),
			'users' => array(self::HAS_MANY, 'User', 'ManagerID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userID' => 'User',
			'Password' => 'Password',
			'Name' => 'Name',
			'EmployeeID' => 'Employee',
			'ManagerID' => 'Manager',
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

		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('EmployeeID',$this->EmployeeID,true);
		$criteria->compare('ManagerID',$this->ManagerID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}