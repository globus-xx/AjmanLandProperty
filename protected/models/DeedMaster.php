<?php

/**
 * This is the model class for table "DeedMaster".
 *
 * The followings are the available columns in table 'DeedMaster':
 * @property string $DeedID
 * @property string $LandID
 * @property integer $SchemeID
 * @property string $DateCreated
 * @property string $UserID
 * @property string $ContractID
 * @property integer $InvoiceNo
 * @property string $Docs
 * @property string $Remarks
 *
 * The followings are the available model relations:
 * @property ContractsMaster[] $contractsMasters
 * @property DeedDetails[] $deedDetails
 * @property User $user
 * @property LandMaster $land
 * @property LandScheme $scheme
 * @property Invoices $invoiceNo
 * @property ContractsMaster $contract
 * @property DeedTracker[] $deedTrackers
 * @property HajzMaster[] $hajzMasters
 */
class DeedMaster extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeedMaster the static model class
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
		return 'DeedMaster';
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
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('DeedID, LandID, SchemeID, DateCreated, UserID, ContractID, InvoiceNo, Docs, Remarks', 'required'),
			//array('SchemeID, InvoiceNo', 'numerical', 'integerOnly'=>true),
			//array('DeedID, LandID, ContractID', 'length', 'max'=>10),
			//array('UserID', 'length', 'max'=>64),
			//array('Remarks', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DeedID, LandID, SchemeID, DateCreated, UserID, ContractID, InvoiceNo, Docs, Remarks', 'safe', 'on'=>'search'),
			array('DeedID, LandID, SchemeID, DateCreated, UserID, ContractID, InvoiceNo, Docs, Remarks', 'safe'),
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
			'contractsMasters' => array(self::HAS_MANY, 'ContractsMaster', 'DeedID'),
			'deedDetails' => array(self::HAS_MANY, 'DeedDetails', 'DeedID'),
			'user' => array(self::BELONGS_TO, 'User', 'UserID'),
			'land' => array(self::BELONGS_TO, 'LandMaster', 'LandID'),
			'scheme' => array(self::BELONGS_TO, 'LandScheme', 'SchemeID'),
			'invoiceNo' => array(self::BELONGS_TO, 'Invoices', 'InvoiceNo'),
			'contract' => array(self::BELONGS_TO, 'ContractsMaster', 'ContractID'),
			'deedTrackers' => array(self::HAS_MANY, 'DeedTracker', 'DeedID'),
			'hajzMasters' => array(self::HAS_MANY, 'HajzMaster', 'DeedID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DeedID' => 'رقم الملكية',
			'LandID' => 'رقم الارض',
			'SchemeID' => 'رقم المخطط',
			'DateCreated' => 'تاريخ الانشاء',
			'DateHijri'=>'تاريخ الهجري',
			'UserID' => 'المستخدم',
			'ContractID' => 'رقم العقد',
			'InvoiceNo' => 'رقم الايصال',
			'Docs' => 'مستندات',
			'Remarks' => 'الملاحظات',
		);
	}
    static function getAsListForLabel($label) {
    $sql = 'SELECT DeedID, ' . $label . ' FROM DeedMaster GROUP BY ' . $label . ' ORDER BY ' . $label . ' ASC';
    $connection = Yii::app()->db;
    $command = $connection->createCommand($sql);
    $results = $command->queryAll();

    $rs = array();
    foreach ($results as $vv) {
      $rs[$vv['DeedID']] = $vv[$label];
    }

    return $rs;
  }

    public function reportableFields()
	{
    $fields = array('DateCreated', 'UserID', 'ContractID', 'Remarks');
    $a = $this->attributeLabels();
    $result = array();

    foreach($fields as $one_field){
        $result[$one_field] = $a[$one_field];
    }

    return $result;
	}
    public function getAllowedReportableFields(){
    $fields = $this->reportableFields();

    $show = Options::getAllowedFields('DeedMaster');
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

		$sql.= ' FROM DeedMaster ';

		$sql.=' LEFT JOIN ContractsMaster on DeedMaster.DeedID = ContractsMaster.DeedID ';
		$sql.=' LEFT JOIN DeedDetails on DeedMaster.DeedID = DeedDetails.DeedID ';
		$sql.=' LEFT JOIN CustomerMaster on DeedDetails.CustomerID = CustomerMaster.CustomerID ';
		$sql.=' LEFT JOIN LandMaster on LandMaster.LandID = DeedMaster.LandID ';
		//$sql.=' LEFT JOIN DeedTracker on DeedTracker.DeedID = DeedMaster.DeedID ';
		$sql.=' LEFT JOIN HajzMaster on HajzMaster.DeedID = DeedMaster.DeedID ';
		$sql.=' LEFT JOIN User on User.UserID = DeedMaster.UserID ';

		//$reportable->conditions = unserialize($reportable->conditions);
	 	$attributes['conditions'] = Reportable::objectToArray(json_decode($attributes['conditions']));
		foreach($attributes['conditions'] as $field_name=>$attribs){
			$cnd = $attribs['attrib'];
			if ($cnd =='gt'){
				$cnd = '>';
			}elseif($cnd =='lt'){
				$cnd = '<';
			}
                        elseif($cnd == "eq")
                        $cnd = '=';
                        
			if(is_array($attribs['value'])){
				foreach($attribs['value'] as $ii=>$vv){
					$attribs['value'][$ii] = "'".$vv."'";
				}
				$attribs['value'] = join(',', $attribs['value']);
			}elseif($cnd=='BETWEEN'){
                                                
                                                                                                   
                                                           
            if (strpos($attribs['value'], '-') !== FALSE)
            {
                 $attribs['value'] = explode('-', $attribs['value']); 
                 
                 $result = explode('/' , $attribs['value'][0]);
                 $month  = trim($result[0]);
                 $day    = trim($result[1]);
                 $year   = trim($result[2]);   
                 $final_date1 = $year . "/" . $month . "/" .$day;    
                                
                 
                 
                 $result = explode('/' , $attribs['value'][1]);
                 $month  = trim($result[0]);
                 $day    = trim($result[1]);
                 $year   = trim($result[2]);  
                 $final_date2 = $year . "/" . $month . "/" .$day; 
                                  
                 $attribs['value'] = "'" . trim($final_date1) . "'" . ' AND ' . "'" . trim($final_date2) . "'";                                                 
            }
            else
            {
                $result = explode('/' , $attribs['value']);                
                $month  = trim($result[0]);
                 $day    = trim($result[1]);
                 $year   = trim($result[2]);                 
                $final_date = $year . "/" . $month . "/" .$day;                
                $attribs['value'] = "'" . trim($final_date) . "'" ;                                                   
                $cnd = "=";
            }  
            
            
            
      }else{
				$attribs['value'] = "'".$attribs['value']."'";
			}
      
    
    if($cnd != "BETWEEN")
    $sql.= ( strstr($sql, "WHERE") ? " AND " : " WHERE " ) . "  ( " . $attribs['field'] . "   " . $cnd . " ( " . $attribs['value'] . " ) ) " . "";      
    else 
    $sql.= ( strstr($sql, "WHERE") ? " AND " : " WHERE " ) . "  ( " . $attribs['field'] . "   " . $cnd . " " . $attribs['value'] . ")" . "";      

		}
    
//     die($sql);


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
    
		//$connection = Yii::app()->db;
		//$command = $connection->createCommand($sql);
		//$results = $command->queryAll();		
		//return $results;
    return $rs;


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

		$criteria->compare('DeedID',$this->DeedID,true);
		$criteria->compare('LandID',$this->LandID,true);
		$criteria->compare('SchemeID',$this->SchemeID);
		$criteria->compare('DateCreated',$this->DateCreated,true);
		$criteria->compare('UserID',$this->UserID,true);
		$criteria->compare('ContractID',$this->ContractID,true);
		$criteria->compare('InvoiceNo',$this->InvoiceNo);
		$criteria->compare('Docs',$this->Docs,true);
		$criteria->compare('Remarks',$this->Remarks,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
