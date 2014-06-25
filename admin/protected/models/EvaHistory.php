<?php

/**
 * This is the model class for table "evaluate_history".
 *
 * The followings are the available columns in table 'evaluate_history':
 * @property integer $int
 * @property string $total_num
 * @property string $taste_num
 * @property string $environmental_num
 * @property string $service_num
 * @property string $desc
 * @property integer $eva_time
 * @property integer $modify_time
 * @property integer $user_id
 * @property string $account_name
 * @property integer $status
 * @property integer $merchant_id
 */
class EvaHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EvaHistory the static model class
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
		return 'evaluate_history';
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
			array('eva_time, modify_time, user_id, status, merchant_id', 'numerical', 'integerOnly'=>true),
			array('total_num, taste_num, environmental_num, service_num', 'length', 'max'=>3),
			array('account_name', 'length', 'max'=>45),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('int, total_num, taste_num, environmental_num, service_num, desc, eva_time, modify_time, user_id, account_name, status, merchant_id', 'safe', 'on'=>'search'),
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
			'int' => 'Int',
			'total_num' => 'Total Num',
			'taste_num' => 'Taste Num',
			'environmental_num' => 'Environmental Num',
			'service_num' => 'Service Num',
			'desc' => 'Desc',
			'eva_time' => 'Eva Time',
			'modify_time' => 'Modify Time',
			'user_id' => 'User',
			'account_name' => 'Account Name',
			'status' => 'Status',
			'merchant_id' => 'Merchant',
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

		$criteria->compare('int',$this->int);
		$criteria->compare('total_num',$this->total_num,true);
		$criteria->compare('taste_num',$this->taste_num,true);
		$criteria->compare('environmental_num',$this->environmental_num,true);
		$criteria->compare('service_num',$this->service_num,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('eva_time',$this->eva_time);
		$criteria->compare('modify_time',$this->modify_time);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('merchant_id',$this->merchant_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}