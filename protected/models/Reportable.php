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
		$this->conditions = serialize($this->conditions);
		$this->display = serialize($this->display);
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
}