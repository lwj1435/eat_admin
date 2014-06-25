<?php

/**
 * This is the model class for table "activity_join_user".
 *
 * The followings are the available columns in table 'activity_join_user':
 * @property integer $id
 * @property integer $at_id
 * @property integer $user_id
 * @property integer $add_time
 * @property integer $status
 * @property integer $up_time
 */
class ActivityJoinUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activity_join_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('at_id, user_id, add_time, status, up_time', 'required'),
			array('at_id, user_id, add_time, status, up_time', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, at_id, user_id, add_time, status, up_time', 'safe', 'on'=>'search'),
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
				'activityName'=>array(self::BELONGS_TO, 'ActivityList', 'at_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'at_id' => '活动id',
			'user_id' => '参加用户id',
			'add_time' => '添加时间',
			'status' => '状态',
			'up_time' => '修改时间',
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
		$criteria->compare('at_id',$this->at_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('status',$this->status);
		$criteria->compare('up_time',$this->up_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActivityJoinUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
