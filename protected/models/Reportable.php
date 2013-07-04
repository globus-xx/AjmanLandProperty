<?php

/**
 * This is the model class for table "reportables".
 *
 * The followings are the available columns in table 'reportables':
 * @property integer $id
 * @property string $title
 * @property string $conditions
 * @property string $reportable_type
 */
class Reportable extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reportable the static model class
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
		return 'reportables';
	}

	public function beforeSave(){
		// remove unenabled fields
		$conditions = $this->conditions;
		foreach($this->conditions as $ii=>$vv){
			if(!isset($vv['enabled'])){
				unset($conditions[$ii]);
			}
		}
		$this->conditions = json_encode($conditions);
		$this->display = json_encode($this->display);
		return true;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('title, reportable_type', 'length', 'max'=>255),
			array('conditions', 'safe'),
			array('display', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, display, conditions, reportable_type', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'conditions' => 'Conditions',
			'reportable_type' => 'Reportable Type',
		);
	}

	public function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map('Reportable::objectToArray', $d);
		}
		else {
			// Return array
			return $d;
		}
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('conditions',$this->conditions,true);
		$criteria->compare('reportable_type',$this->reportable_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}





	public function getReport($reportable_type){
		$reportable = $this;
		$criteria = new CDbCriteria();
		$criteria->alias = 'ContractsMaster';
		$criteria->select = '1';

		$attributes = $reportable->attributes;
 
		$attributes['display'] = Reportable::objectToArray(json_decode($attributes['display']));

		foreach($attributes['display'] as $model=>$fields){
			foreach($fields as $ii=>$afield):
				$criteria->select.= ', '.$model.'.'.$ii;
			endforeach;
		}

		$criteria->join=' LEFT JOIN LandMaster on LandMaster.LandID = ContractsMaster.LandID ';
		$criteria->join.=' LEFT JOIN ContractsDetail on ContractsDetail.ContractID = ContractsMaster.ContractsID ';
		$criteria->join.=' LEFT JOIN CustomerMaster on ContractsDetail.CustomerID = CustomerMaster.CustomerID ';

		//$reportable->conditions = unserialize($reportable->conditions);
		$criteria->condition = " ";
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
					$attribs['value'][$ii] = "'".mysql_real_escape_string($vv)."'";
				}
				$attribs['value'] = $attribs['value'].join(',');
			}else{
				$attribs['value'] = "'".mysql_real_escape_string($attribs['value'])."'";
			}

			//$criteria->condition.= ( strstr( $criteria->condition, "WHERE" ) ?  " AND " : " WHERE " )."  ( ".$attribs['field']."   ".$cnd." ( ".$attribs['value']." ) ) "."";
			
		}

		return $criteria;



		return new CActiveDataProvider($reportable_type, array(
			'criteria'=>$criteria,
		));
	}



}