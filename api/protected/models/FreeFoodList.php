<?php

/**
 * This is the model class for table "free_food_list".
 *
 * The followings are the available columns in table 'free_food_list':
 * @property integer $id
 * @property string $ff_name
 * @property string $ff_content
 * @property integer $join_num
 * @property integer $add_user_id
 * @property integer $add_time
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $merchant_id
 * @property integer $status
 * @property string $image_list
 */
class FreeFoodList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'free_food_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('join_num, add_user_id, add_time, start_time, end_time, merchant_id, status', 'numerical', 'integerOnly'=>true),
			array('ff_name', 'length', 'max'=>255),
			array('ff_content, image_list', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ff_name, ff_content, join_num, add_user_id, add_time, start_time, end_time, merchant_id, status, image_list', 'safe', 'on'=>'search'),
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
			'ff_name' => '免费大餐标题',
			'ff_content' => '免费大餐描述',
			'join_num' => '允许加入人数',
			'add_user_id' => '发起免�',
			'add_time' => '发起活动时间',
			'start_time' => '开始时间',
			'end_time' => '结束时间',
			'merchant_id' => '免费大餐商家id',
			'status' => 'Status',
			'image_list' => 'Image List',
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
		$criteria->compare('ff_name',$this->ff_name,true);
		$criteria->compare('ff_content',$this->ff_content,true);
		$criteria->compare('join_num',$this->join_num);
		$criteria->compare('add_user_id',$this->add_user_id);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('image_list',$this->image_list,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FreeFoodList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
