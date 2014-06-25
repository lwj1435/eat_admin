<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $id
 * @property string $order_num
 * @property string $b_v_gold
 * @property string $v_gold
 * @property string $b_gold
 * @property string $order_gold
 * @property integer $user_id
 * @property string $account_name
 * @property string $user_name
 * @property integer $order_time
 * @property string $user_phone
 * @property integer $parent_order_id
 * @property string $parnt_order_num
 * @property integer $plant_come_num
 * @property integer $merchant_id
 * @property integer $status
 * @property integer $add_user_id
 * @property integer $add_time
 * @property integer $goods_id
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_num, user_phone, parnt_order_num, plant_come_num, merchant_id, add_time, goods_id', 'required'),
			array('user_id, order_time, parent_order_id, plant_come_num, merchant_id, status, add_user_id, add_time, goods_id', 'numerical', 'integerOnly'=>true),
			array('order_num, account_name, user_name, parnt_order_num', 'length', 'max'=>45),
			array('b_v_gold, v_gold, b_gold, order_gold', 'length', 'max'=>20),
			array('user_phone', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_num, b_v_gold, v_gold, b_gold, order_gold, user_id, account_name, user_name, order_time, user_phone, parent_order_id, parnt_order_num, plant_come_num, merchant_id, status, add_user_id, add_time, goods_id', 'safe', 'on'=>'search'),
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
			'id' => 'user order',
			'order_num' => '订单号,不可以为空,号码规则自动生成',
			'b_v_gold' => 'B V Gold',
			'v_gold' => 'V Gold',
			'b_gold' => 'B Gold',
			'order_gold' => 'Order Gold',
			'user_id' => 'User',
			'account_name' => 'Account Name',
			'user_name' => 'User Name',
			'order_time' => 'Order Time',
			'user_phone' => 'User Phone',
			'parent_order_id' => 'Parent Order',
			'parnt_order_num' => '父订单号，如果是主订单，那么就要填写main',
			'plant_come_num' => 'Plant Come Num',
			'merchant_id' => 'Merchant',
			'status' => 'Status',
			'add_user_id' => 'Add User',
			'add_time' => 'Add Time',
			'goods_id' => '货物id',
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
		$criteria->compare('order_num',$this->order_num,true);
		$criteria->compare('b_v_gold',$this->b_v_gold,true);
		$criteria->compare('v_gold',$this->v_gold,true);
		$criteria->compare('b_gold',$this->b_gold,true);
		$criteria->compare('order_gold',$this->order_gold,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('order_time',$this->order_time);
		$criteria->compare('user_phone',$this->user_phone,true);
		$criteria->compare('parent_order_id',$this->parent_order_id);
		$criteria->compare('parnt_order_num',$this->parnt_order_num,true);
		$criteria->compare('plant_come_num',$this->plant_come_num);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('add_user_id',$this->add_user_id);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('goods_id',$this->goods_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
