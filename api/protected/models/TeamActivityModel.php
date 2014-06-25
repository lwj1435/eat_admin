<?php

/**
 * This is the model class for table "team_activity".
 *
 * The followings are the available columns in table 'team_activity':
 * @property integer $id
 * @property integer $user_id
 * @property string $account_name
 * @property string $user_name
 * @property integer $merchant_id
 * @property double $longitude
 * @property double $latitude
 * @property double $altitude
 * @property integer $team_type
 * @property string $team_title
 * @property string $team_content
 * @property integer $join_num
 * @property integer $real_join
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $is_good
 * @property integer $status
 * @property integer $add_time
 */
class TeamActivityModel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'team_activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'required'),
			array('user_id, merchant_id, team_type, join_num, real_join, start_time, end_time, is_good, status, add_time', 'numerical', 'integerOnly'=>true),
			array('longitude, latitude, altitude', 'numerical'),
			array('account_name, user_name', 'length', 'max'=>45),
			array('team_title', 'length', 'max'=>255),
			array('team_content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, account_name, user_name, merchant_id, longitude, latitude, altitude, team_type, team_title, team_content, join_num, real_join, start_time, end_time, is_good, status, add_time', 'safe', 'on'=>'search'),
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
			'account_name' => 'Account Name',
			'user_name' => 'User Name',
			'merchant_id' => 'Merchant',
			'longitude' => 'Longitude',
			'latitude' => 'Latitude',
			'altitude' => 'Altitude',
			'team_type' => 'Team Type',
			'team_title' => 'Team Title',
			'team_content' => 'Team Content',
			'join_num' => 'Join Num',
			'real_join' => 'Real Join',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'is_good' => 'Is Good',
			'status' => 'Status',
			'add_time' => 'Add Time',
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
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('altitude',$this->altitude);
		$criteria->compare('team_type',$this->team_type);
		$criteria->compare('team_title',$this->team_title,true);
		$criteria->compare('team_content',$this->team_content,true);
		$criteria->compare('join_num',$this->join_num);
		$criteria->compare('real_join',$this->real_join);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('is_good',$this->is_good);
		$criteria->compare('status',$this->status);
		$criteria->compare('add_time',$this->add_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeamActivityModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
