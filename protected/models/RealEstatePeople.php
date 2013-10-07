<?php

/**
 * This is the model class for table "RealEstatePeople".
 *
 * The followings are the available columns in table 'RealEstatePeople':
 * @property integer $CardID
 * @property integer $CardNo
 * @property string $Name
 * @property string $Nationality
 * @property string $Role
 * @property string $IssueDate
 * @property string $EndDate
 * @property string $EntryDate
 * @property integer $RealEstateID
 * @property string $CardEndDate
 * @property string $UserID
 * @property string $OperationType
 *
 * The followings are the available model relations:
 * @property RealEstateOffices $realEstate
 */
class RealEstatePeople extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return RealEstatePeople the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return 'RealEstatePeople';
  }

  static function getAsListForLabel($label) {
    $sql = 'SELECT CardID, ' . $label . ' FROM RealEstatePeople GROUP BY '.$label.' ORDER BY ' . $label . ' ASC';
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sql);
    $results = $command->queryAll();

    $rs = array();
    foreach($results as $vv){
      $rs[$vv['CardID']] = $vv[$label];
    }

    return $rs;
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('UserID', 'required'),
        array('CardNo, RealEstateID', 'numerical', 'integerOnly' => true),
        array('Name', 'length', 'max' => 250),
        array('Nationality, Role, OperationType', 'length', 'max' => 100),
        array('UserID', 'length', 'max' => 64),
        array('IssueDate, EndDate, EntryDate, CardEndDate', 'safe'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('CardID, CardNo, Name, Nationality, Role, IssueDate, EndDate, EntryDate, RealEstateID, CardEndDate, UserID, OperationType', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'realEstate' => array(self::BELONGS_TO, 'RealEstateOffices', 'RealEstateID'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'CardID' => 'Card',
        'CardNo' => 'Card No',
        'Name' => 'Name',
        'Nationality' => 'Nationality',
        'Role' => 'Role',
        'IssueDate' => 'Issue Date',
        'EndDate' => 'End Date',
        'EntryDate' => 'Entry Date',
        'RealEstateID' => 'Real Estate',
        'CardEndDate' => 'Card End Date',
        'UserID' => 'User',
        'OperationType' => 'Operation Type',
    );
  }

  public function reportableFields() {
    $fields = array('Name', 'Nationality');
    $a = $this->attributeLabels();
    $result = array();

    foreach ($fields as $one_field) {
      $result[$one_field] = $a[$one_field];
    }

    return $result;
  }
  
  
    public function getAllowedReportableFields(){
    $fields = $this->reportableFields();

    $show = Options::getAllowedFields('RealEstatePeople');
    if($show == 1){
      return $fields;
    }
    $results = array();
    foreach($show as $vv){
      $vv = explode('.',$vv);
      //var_dump( $vv );
      //var_dump( $fields );
      
      $k = array_search($vv[1], $fields);
      $results[$vv[1]] = $fields[$vv[1]];
    }
    //var_dump($results);exit;
    return $results;
  }


  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search() {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria = new CDbCriteria;

    $criteria->compare('CardID', $this->CardID);
    $criteria->compare('CardNo', $this->CardNo);
    $criteria->compare('Name', $this->Name, true);
    $criteria->compare('Nationality', $this->Nationality, true);
    $criteria->compare('Role', $this->Role, true);
    $criteria->compare('IssueDate', $this->IssueDate, true);
    $criteria->compare('EndDate', $this->EndDate, true);
    $criteria->compare('EntryDate', $this->EntryDate, true);
    $criteria->compare('RealEstateID', $this->RealEstateID);
    $criteria->compare('CardEndDate', $this->CardEndDate, true);
    $criteria->compare('UserID', $this->UserID, true);
    $criteria->compare('OperationType', $this->OperationType, true);

    return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
    ));
  }

}