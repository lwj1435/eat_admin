<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property integer $id
 * @property string $image_name
 * @property string $image_link
 * @property integer $image_up_time
 * @property integer $image_modify_time
 * @property integer $image_up_user_id
 * @property string $image_up_user_name
 * @property string $image_up_user_account_name
 * @property integer $up_user_id
 * @property string $up_account_name
 * @property string $up_user_name
 * @property integer $status
 */
class Image extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_up_time, image_modify_time, image_up_user_id, up_user_id, status', 'numerical', 'integerOnly'=>true),
			array('image_name, image_link, image_up_user_name, image_up_user_account_name, up_account_name, up_user_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, image_name, image_link, image_up_time, image_modify_time, image_up_user_id, image_up_user_name, image_up_user_account_name, up_user_id, up_account_name, up_user_name, status', 'safe', 'on'=>'search'),
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
			'image_name' => 'Image Name',
			'image_link' => 'Image Link',
			'image_up_time' => 'Image Up Time',
			'image_modify_time' => 'Image Modify Time',
			'image_up_user_id' => 'Image Up User',
			'image_up_user_name' => 'Image Up User Name',
			'image_up_user_account_name' => 'Image Up User Account Name',
			'up_user_id' => 'Up User',
			'up_account_name' => 'Up Account Name',
			'up_user_name' => 'Up User Name',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('image_name',$this->image_name,true);
		$criteria->compare('image_link',$this->image_link,true);
		$criteria->compare('image_up_time',$this->image_up_time);
		$criteria->compare('image_modify_time',$this->image_modify_time);
		$criteria->compare('image_up_user_id',$this->image_up_user_id);
		$criteria->compare('image_up_user_name',$this->image_up_user_name,true);
		$criteria->compare('image_up_user_account_name',$this->image_up_user_account_name,true);
		$criteria->compare('up_user_id',$this->up_user_id);
		$criteria->compare('up_account_name',$this->up_account_name,true);
		$criteria->compare('up_user_name',$this->up_user_name,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Image the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
