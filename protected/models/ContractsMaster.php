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
class ContractsMaster extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return ContractsMaster the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return 'ContractsMaster';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
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
        array('ContractsID, LandID, DateCreated, UserID, ContractType, DeedID, SchemeID, AmountEntered, AmountCorrected, UserIDcorrected, UserIDApproved, Fee, InvoiceNo, Remarks, Status', 'safe', 'on' => 'search'),
        array('ContractsID, LandID, DateCreated, UserID, ContractType, DeedID, SchemeID, AmountEntered, AmountCorrected, UserIDcorrected, UserIDApproved, Fee, InvoiceNo, Remarks, Status', 'safe'),
    );
  }

  
  public function check_string($string)
  {                        
            if (preg_match('/[^a-zA-Z\d]/', $string) ){                
                return  false;
              }
            else  
            return $string;
  }
  
  /**
   * @return array relational rules.
   */
  public function relations() {
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
  public function attributeLabels() {
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
  
    public function getAllowedReportableFields(){
    $fields = $this->reportableFields();

    $show = Options::getAllowedFields('ContractsMaster');
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


  public function reportableFields() {
    $fields = array('DateCreated', 'UserID', 'ContractType', 'AmountCorrected', 'Fee');
    $a = $this->attributeLabels();
    $result = array();

    foreach ($fields as $one_field) {
      $result[$one_field] = $a[$one_field];
    }

    return $result;
  }

  public function getReportFromReportable($reportable, $add_total_fields = 'ContractsMaster.AmountCorrected as AC, ContractsMaster.Fee as FF,') {

    $attributes = $reportable->attributes;

    $attributes['display'] = Reportable::objectToArray(json_decode($attributes['display']));

    $sql = 'SELECT  ' . $add_total_fields;
    $f = array();

    foreach ($attributes['display'] as $model => $fields) {
      foreach ($fields as $ii => $afield):
        $f[] = $model . '.' . $ii;
      endforeach;
    }


    $sql.= join(', ', $f);

    $sql.= ' FROM ContractsMaster ';

    $sql.=' LEFT JOIN LandMaster on LandMaster.LandID = ContractsMaster.LandID ';
    $sql.=' LEFT JOIN ContractsDetail on ContractsDetail.ContractID = ContractsMaster.ContractsID ';
    $sql.=' LEFT JOIN CustomerMaster on ContractsDetail.CustomerID = CustomerMaster.CustomerID ';
    $sql.=' LEFT JOIN RealEstatePeople on ContractsDetail.CardID = RealEstatePeople.CardID ';
    $sql.=' LEFT JOIN RealEstateOffices on RealEstateOffices.RealEstateID = RealEstatePeople.RealEstateID ';


    //$reportable->conditions = unserialize($reportable->conditions);
    $attributes['conditions'] = Reportable::objectToArray(json_decode($attributes['conditions']));
    foreach ($attributes['conditions'] as $field_name => $attribs) {
      $cnd = $attribs['attrib'];
      if ($cnd == 'gt') {
        $cnd = '>';
      } elseif ($cnd == 'lt') {
        $cnd = '<';
      }

      if (is_array($attribs['value'])) {
        foreach ($attribs['value'] as $ii => $vv) {
          $attribs['value'][$ii] = "'" . $vv . "'";
        }
        $attribs['value'] = join(',', $attribs['value']);
      } elseif ($cnd == 'BETWEEN') {
        $attribs['value'] = explode('-', $attribs['value']);

        $attribs['value'] = "'" . trim($attribs['value'][0]) . "'" . ' AND ' . "'" . trim($attribs['value'][1]) . "'";
        $attribs['value'] = ''; // hack
      } else {
        $attribs['value'] = "'" . $attribs['value'] . "'";
      }


      if ($cnd != 'BETWEEN')
        $sql.= ( strstr($sql, "WHERE") ? " AND " : " WHERE " ) . "  ( " . $attribs['field'] . "   " . $cnd . " ( " . $attribs['value'] . " ) ) " . "";
    }

    $connection = Yii::app()->db;

    $attributes['grouped'] = Reportable::objectToArray(json_decode($attributes['grouped']));

    $esql = $sql;

    $rs = array();
    $vv = $attributes['grouped'];
    if (($vv[0]['value'] != '0') && ($vv!=null)) :
      // get all possibilities of this group
      $grouped_one = explode('.', $vv[0]['value']);
      $obj = $grouped_one[0];
      $grouped_options = ($obj::getAsListForLabel($grouped_one[1]));      
      foreach ($grouped_options as $ix => $vx):         
        $esql.= ( strstr($esql, "WHERE") ? " AND " : " WHERE " ) . "  ( " . $vv[0]['value'] . "   = '" . $this->check_string($vx) . "'  ) ";
        // loop through the next to see if there is another group
        // this loop goes for each within the previous loop
        if ($vv[1]['value'] != '0'):
          // get all possibilities of this group
          $esql1 = $esql;
          $grouped_one_1 = explode('.', $vv[1]['value']);
          $obj = $grouped_one_1[0];
          $grouped_options_1 = ($obj::getAsListForLabel($grouped_one_1[1]));
          foreach ($grouped_options_1 as $ix1 => $vx1):
            $esql1.= ( strstr($esql1, "WHERE") ? " AND " : " WHERE " ) . "  ( " . $vv[1]['value'] . "   =  '" . $this->check_string($vx1) . "'  ) ";
            // loop through the next to see if there is another group
            // this loop goes for each within the previous loop
            if ($vv[2]['value'] != '0'):
              // get all possibilities of this group

              $esql2 = $esql1;
              $grouped_one_2 = explode('.', $vv[2]['value']);
              $obj = $grouped_one_2[0];
              $grouped_options_2 = ($obj::getAsListForLabel($grouped_one_2[1]));
              foreach ($grouped_options_2 as $ix2 => $vx2):
                $esql2.= ( strstr($esql2, "WHERE") ? " AND " : " WHERE " ) . "  ( " . $vv[2]['value'] . "   =  '" . $this->check_string($vx2) . "'  ) ";
                $command = $connection->createCommand($esql2);
                $rs[$vv[0]['value'] . "  IS " . $vx.' AND '.$vv[1]['value'] . "  IS " . $vx1.' AND '.$vv[2]['value'] . "  IS " . $vx2] = $command->queryAll();
                $esql2 = $esql1;
              endforeach;

            else:

              $command = $connection->createCommand($esql1);

              $rs[$vv[0]['value'] . "  IS " . $vx.' AND '.$vv[2]['value'] . "  IS " . $vx1] = $command->queryAll();

            endif;
            $esql1 = $esql;
          endforeach;

        else:
          $command = $connection->createCommand($esql);
          $rs[$vv[0]['value'] . "  IS " . $vx] = $command->queryAll();
        endif;
        $esql = $sql;
      endforeach;
      $rs['GROUPED'] = $rs;
    else:

      $command = $connection->createCommand($esql);
      $rs['RESULTS'] = $command->queryAll();
    endif;


//		$command = $connection->createCommand($sql);
//		$results = $command->queryAll();		
    return $rs;
  }

  static function getAsListForLabel($label) {
    $sql = 'SELECT ContractsID, ' . $label . ' FROM ContractsMaster GROUP BY ' . $label . ' ORDER BY ' . $label . ' ASC';
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sql);
    $results = $command->queryAll();

    $rs = array();
    foreach ($results as $vv) {
      $rs[$vv['ContractsID']] = $vv[$label];
    }

    return $rs;
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search() {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria = new CDbCriteria;

    $criteria->compare('ContractsID', $this->ContractsID, true);
    $criteria->compare('LandID', $this->LandID, true);
    $criteria->compare('DateCreated', $this->DateCreated, true);
    $criteria->compare('UserID', $this->UserID, true);
    $criteria->compare('ContractType', $this->ContractType, true);
    $criteria->compare('DeedID', $this->DeedID, true);
    $criteria->compare('SchemeID', $this->SchemeID);
    $criteria->compare('AmountEntered', $this->AmountEntered);
    $criteria->compare('AmountCorrected', $this->AmountCorrected);
    $criteria->compare('UserIDcorrected', $this->UserIDcorrected, true);
    $criteria->compare('UserIDApproved', $this->UserIDApproved, true);
    $criteria->compare('Fee', $this->Fee);
    $criteria->compare('InvoiceNo', $this->InvoiceNo);
    $criteria->compare('Remarks', $this->Remarks);
    $criteria->compare('Status', $this->Status);

    return new CActiveDataProvider($this, array(
        'criteria' => $criteria,
    ));
  }

}
