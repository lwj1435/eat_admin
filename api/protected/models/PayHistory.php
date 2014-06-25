<?php

/**
 * This is the model class for table "pay_history".
 *
 * The followings are the available columns in table 'pay_history':
 * @property integer $id
 * @property integer $user_id
 * @property string $user_name
 * @property string $account_name
 * @property string $user_ip
 * @property string $pay_num
 * @property string $pay_money
 * @property string $pay_gold
 * @property integer $pay_time
 * @property integer $pay_type
 * @property integer $status
 */
class PayHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pay_history';
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
			array('id, user_id, pay_time, pay_type, status', 'numerical', 'integerOnly'=>true),
			array('user_name, account_name, pay_num', 'length', 'max'=>45),
			array('user_ip', 'length', 'max'=>15),
			array('pay_money, pay_gold', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, user_name, account_name, user_ip, pay_num, pay_money, pay_gold, pay_time, pay_type, status', 'safe', 'on'=>'search'),
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
			'user_name' => 'User Name',
			'account_name' => 'Account Name',
			'user_ip' => 'User Ip',
			'pay_num' => '订单号码',
			'pay_money' => '金额（元）',
			'pay_gold' => '充值金币数',
			'pay_time' => '充值时间',
			'pay_type' => '类型 1为支出，2为收入',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('user_ip',$this->user_ip,true);
		$criteria->compare('pay_num',$this->pay_num,true);
		$criteria->compare('pay_money',$this->pay_money,true);
		$criteria->compare('pay_gold',$this->pay_gold,true);
		$criteria->compare('pay_time',$this->pay_time);
		$criteria->compare('pay_type',$this->pay_type);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PayHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
