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
 */
class TakeOutList extends CActiveRecord
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
			array('take_out_num, price_count, take_num_count, merchant_id, status, add_time, take_out_name, take_out_type, favorable_id, pay_type, pay_status, add, take_out_status, super_need, take_num', 'required'),
			array('user_id, price_count, take_num_count, take_time, pro_time, out_time, get_time, merchant_id, status, add_time, take_out_type, pay_type, pay_status, take_out_status, take_num', 'numerical', 'integerOnly'=>true),
			array('take_out_num, user_phone', 'length', 'max'=>50),
			array('account_name, user_name, order_num, take_outcol', 'length', 'max'=>45),
			array('take_out_name, favorable_id', 'length', 'max'=>255),
			array('add, super_need', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, take_out_num, user_id, account_name, user_name, user_phone, order_num, price_count, take_num_count, take_outcol, take_time, pro_time, out_time, get_time, merchant_id, status, add_time, take_out_name, take_out_type, favorable_id, pay_type, pay_status, add, take_out_status, super_need, take_num', 'safe', 'on'=>'search'),
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
			'pro_time' => 'Pro Time',
			'out_time' => 'Out Time',
			'get_time' => 'Get Time',
			'merchant_id' => 'Merchant',
			'status' => 'Status',
			'add_time' => 'Add Time',
			'take_out_name' => 'Take Out Name',
			'take_out_type' => 'Take Out Type',
			'favorable_id' => 'Favorable',
			'pay_type' => 'Pay Type',
			'pay_status' => 'Pay Status',
			'add' => 'Add',
			'take_out_status' => 'Take Out Status',
			'super_need' => 'Super Need',
			'take_num' => 'Take Num',
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
