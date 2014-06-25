<?php

/**
 * This is the model class for table "user_log".
 *
 * The followings are the available columns in table 'user_log':
 * @property integer $id
 * @property integer $longin_time
 * @property integer $out_time
 * @property string $longin_type
 * @property string $login_ip
 * @property integer $user_id
 * @property double $latitude
 * @property double $longitude
 * @property double $altitude
 */
class UserLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('longin_time, out_time, user_id', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude, altitude', 'numerical'),
			array('longin_type', 'length', 'max'=>45),
			array('login_ip', 'length', 'max'=>17),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, longin_time, out_time, longin_type, login_ip, user_id, latitude, longitude, altitude', 'safe', 'on'=>'search'),
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
			'id' => 'user login log',
			'longin_time' => 'Longin Time',
			'out_time' => 'Out Time',
			'longin_type' => 'Longin Type',
			'login_ip' => 'Login Ip',
			'user_id' => 'User',
			'latitude' => '纬度',
			'longitude' => '经度',
			'altitude' => '海拔',
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
		$criteria->compare('longin_time',$this->longin_time);
		$criteria->compare('out_time',$this->out_time);
		$criteria->compare('longin_type',$this->longin_type,true);
		$criteria->compare('login_ip',$this->login_ip,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('altitude',$this->altitude);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
