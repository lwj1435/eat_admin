<?php

/**
 * This is the model class for table "activity_list".
 *
 * The followings are the available columns in table 'activity_list':
 * @property integer $id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $activity_type
 * @property string $activity_name
 * @property string $activity_content
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $join_num
 * @property integer $real_join
 * @property string $desc
 * @property string $logo
 * @property integer $merchant_id
 */
class ActivityList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activity_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_id', 'required'),
			array('user_id, activity_type, start_time, end_time, join_num, real_join, merchant_id', 'numerical', 'integerOnly'=>true),
			array('user_name', 'length', 'max'=>45),
			array('activity_name, logo', 'length', 'max'=>255),
			array('activity_content, desc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, user_name, activity_type, activity_name, activity_content, start_time, end_time, join_num, real_join, desc, logo, merchant_id', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'user_name' => '发起活动人昵称',
			'activity_type' => '活动类型',
			'activity_name' => '活动名称',
			'activity_content' => '活�',
			'start_time' => '活动开始时间',
			'end_time' => '活动结束时间',
			'join_num' => 'Join Num',
			'real_join' => 'Real Join',
			'desc' => '活动备注',
			'logo' => 'Logo',
			'merchant_id' => 'Merchant',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('activity_type',$this->activity_type);
		$criteria->compare('activity_name',$this->activity_name,true);
		$criteria->compare('activity_content',$this->activity_content,true);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('join_num',$this->join_num);
		$criteria->compare('real_join',$this->real_join);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('merchant_id',$this->merchant_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivityList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
