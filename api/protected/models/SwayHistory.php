<?php

/**
 * This is the model class for table "sway_history".
 *
 * The followings are the available columns in table 'sway_history':
 * @property integer $id
 * @property integer $user_id
 * @property integer $good_id
 * @property integer $merchant_id
 * @property integer $shake_time
 * @property integer $shake_type
 * @property double $longitude
 * @property double $latitude
 * @property double $altitude
 */
class SwayHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sway_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, user_id, good_id, merchant_id, shake_time, shake_type', 'numerical', 'integerOnly'=>true),
			array('longitude, latitude, altitude', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, good_id, merchant_id, shake_time, shake_type, longitude, latitude, altitude', 'safe', 'on'=>'search'),
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
			'user_id' => '摇一摇用户id',
			'good_id' => '摇出来的商品ID',
			'merchant_id' => '摇出来的商家ID',
			'shake_time' => '摇一摇时间',
			'shake_type' => '摇一摇类型：1为摇美食，0为摇商家',
			'longitude' => '经度',
			'latitude' => '纬度',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('good_id',$this->good_id);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('shake_time',$this->shake_time);
		$criteria->compare('shake_type',$this->shake_type);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('altitude',$this->altitude);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SwayHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
