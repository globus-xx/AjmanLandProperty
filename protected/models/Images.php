<?php

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property string $id
 * @property string $caption
 * @property string $item
 * @property string $item_id
 * @property string $land_id
 * @property integer $approved
 * @property string $created_by
 * @property string $created_on
 * @property string $views
 * @property integer $primary
 * @property string $last_update
 * @property string $last_update_by
 * @property string $link
 * @property string $image
 */
class Images extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Images the static model class
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
		return 'images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('caption, item, item_id, created_on', 'required'),
//			array('approved, primary', 'numerical', 'integerOnly'=>true),
//			array('caption, item', 'length', 'max'=>255),
//			array('item_id, created_by, views, last_update_by', 'length', 'max'=>20),
//			array('land_id', 'length', 'max'=>25),
//			array('link, image', 'length', 'max'=>800),
//			array('last_update', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, caption, item, item_id, land_id, approved, created_by, created_on, views, primary, last_update, last_update_by, link, image', 'safe', 'on'=>'search'),
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
			'caption' => 'Caption',
			'item' => 'Item',
			'item_id' => 'Item',
			'land_id' => 'Land',
			'approved' => 'Approved',
			'created_by' => 'Created By',
			'created_on' => 'Created On',
			'views' => 'Views',
			'primary' => 'Primary',
			'last_update' => 'Last Update',
			'last_update_by' => 'Last Update By',
			'link' => 'Link',
			'image' => 'Image',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('caption',$this->caption,true);
		$criteria->compare('item',$this->item,true);
		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('land_id',$this->land_id,true);
		$criteria->compare('approved',$this->approved);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('primary',$this->primary);
		$criteria->compare('last_update',$this->last_update,true);
		$criteria->compare('last_update_by',$this->last_update_by,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}