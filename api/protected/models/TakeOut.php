<?php

/**
 * This is the model class for table "take_out".
 *
 * The followings are the available columns in table 'take_out':
 * @property integer $id
 * @property string $take_out_num
 * @property integer $user_id
 * @property string $account_name
 * @property string $user_name
 * @property string $user_phone
 * @property string $order_num
 * @property integer $price_count
 * @property integer $take_num_count
 * @property string $take_outcol
 * @property integer $take_time
 * @property integer $pro_time
 * @property integer $out_time
 * @property integer $get_time
 * @property integer $merchant_id
 * @property integer $status
 * @property integer $add_time
 * @property string $take_out_name
 * @property integer $take_out_type
 * @property string $favorable_id
 * @property integer $pay_type
 * @property integer $pay_status
 * @property string $add
 * @property integer $take_out_status
 * @property string $super_need
 * @property integer $take_num
 * @property string $take_out_date
 * @property string $take_out_time
 * @property integer $customer_id
 * @property string $take_out_phone
 */
class TakeOut extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'take_out';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('take_out_num, price_count, take_num_count, merchant_id, status, add_time, take_out_name, take_out_type, favorable_id, pay_type, pay_status, add, take_out_status, super_need, take_num, take_out_date, take_out_time, take_out_phone,common_id', 'required'),
			array('user_id, price_count, take_num_count, take_time, pro_time, out_time, get_time, merchant_id, status, add_time, take_out_type, pay_type, pay_status, take_out_status, take_num, customer_id,common_id', 'numerical', 'integerOnly'=>true),
			array('take_out_num, user_phone', 'length', 'max'=>50),
			array('account_name, user_name, order_num, take_outcol', 'length', 'max'=>45),
			array('take_out_name, favorable_id', 'length', 'max'=>255),
			array('add, super_need', 'length', 'max'=>500),
			array('take_out_time, take_out_phone', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, take_out_num, user_id, account_name, user_name, user_phone, order_num, price_count, take_num_count, take_outcol, take_time, pro_time, out_time, get_time, merchant_id, status, add_time, take_out_name, take_out_type, favorable_id, pay_type, pay_status, add, take_out_status, super_need, take_num, take_out_date, take_out_time, customer_id, take_out_phone,common_id', 'safe', 'on'=>'search'),
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
            'merchantTOwer'=>array(self::BELONGS_TO, 'MerchantMsg', 'merchant_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'take_out_num' => 'Take Out Num',
			'user_id' => 'User',
			'account_name' => 'Account Name',
			'user_name' => 'User Name',
			'user_phone' => 'User Phone',
			'order_num' => 'Order Num',
			'price_count' => 'Price Count',
			'take_num_count' => 'Take Num Count',
			'take_outcol' => 'Take Outcol',
			'take_time' => 'Take Time',
			'pro_time' => '计划送到时间',
			'out_time' => '配送完毕，出发的时间',
			'get_time' => '客户拿到的时间',
			'merchant_id' => 'Merchant',
			'status' => 'çŠ¶æ€',
			'add_time' => 'æ·»åŠ æ—¶é—´',
			'take_out_name' => '外卖的名字',
			'take_out_type' => '外卖类型',
			'favorable_id' => '优惠卷id',
			'pay_type' => ' 外卖支付方式',
			'pay_status' => '支付状态',
			'add' => '外卖地址',
			'take_out_status' => '外卖状态',
			'super_need' => '特殊要求',
			'take_num' => '外卖数量',
			'take_out_date' => '外卖日期',
			'take_out_time' => '外卖时间',
			'customer_id' => 'Customer',
			'take_out_phone' => 'Take Out Phone',
			'common_id'=>'common id',
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
		$criteria->compare('take_out_num',$this->take_out_num,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_phone',$this->user_phone,true);
		$criteria->compare('order_num',$this->order_num,true);
		$criteria->compare('price_count',$this->price_count);
		$criteria->compare('take_num_count',$this->take_num_count);
		$criteria->compare('take_outcol',$this->take_outcol,true);
		$criteria->compare('take_time',$this->take_time);
		$criteria->compare('pro_time',$this->pro_time);
		$criteria->compare('out_time',$this->out_time);
		$criteria->compare('get_time',$this->get_time);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('take_out_name',$this->take_out_name,true);
		$criteria->compare('take_out_type',$this->take_out_type);
		$criteria->compare('favorable_id',$this->favorable_id,true);
		$criteria->compare('pay_type',$this->pay_type);
		$criteria->compare('pay_status',$this->pay_status);
		$criteria->compare('add',$this->add,true);
		$criteria->compare('take_out_status',$this->take_out_status);
		$criteria->compare('super_need',$this->super_need,true);
		$criteria->compare('take_num',$this->take_num);
		$criteria->compare('take_out_date',$this->take_out_date,true);
		$criteria->compare('take_out_time',$this->take_out_time,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('take_out_phone',$this->take_out_phone,true);
		$criteria->compare('common_id',$this->common_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TakeOut the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
