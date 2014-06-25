<?php

/**
 * This is the model class for table "goods_detail".
 *
 * The followings are the available columns in table 'goods_detail':
 * @property integer $id
 * @property string $goods_at_num
 * @property integer $parent_id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $customer_id
 * @property integer $get_time
 * @property integer $status
 * @property integer $user_time
 * @property string $goods_name
 * @property integer $type
 * @property integer $merchant_id
 * @property integer $get_type
 * @property integer $order_type
 * @property string $order_num
 * @property integer $order_id
 */
class GoodsDetailList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'goods_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goods_at_num, parent_id, user_id, user_name, customer_id, get_time, status, user_time, goods_name, type, merchant_id, get_type', 'required'),
			array('parent_id, user_id, customer_id, get_time, status, user_time, type, merchant_id, get_type, order_type, order_id', 'numerical', 'integerOnly'=>true),
			array('goods_at_num, order_num', 'length', 'max'=>30),
			array('user_name, goods_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, goods_at_num, parent_id, user_id, user_name, customer_id, get_time, status, user_time, goods_name, type, merchant_id, get_type, order_type, order_num, order_id', 'safe', 'on'=>'search'),
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
			'goods_at_num' => 'Goods At Num',
			'parent_id' => 'Parent',
			'user_id' => 'User',
			'user_name' => 'User Name',
			'customer_id' => 'Customer',
			'get_time' => 'Get Time',
			'status' => 'Status',
			'user_time' => 'User Time',
			'goods_name' => 'Goods Name',
			'type' => 'Type',
			'merchant_id' => 'Merchant',
			'get_type' => 'Get Type',
			'order_type' => 'Order Type',
			'order_num' => 'Order Num',
			'order_id' => 'Order',
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
		$criteria->compare('goods_at_num',$this->goods_at_num,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('get_time',$this->get_time);
		$criteria->compare('status',$this->status);
		$criteria->compare('user_time',$this->user_time);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('get_type',$this->get_type);
		$criteria->compare('order_type',$this->order_type);
		$criteria->compare('order_num',$this->order_num,true);
		$criteria->compare('order_id',$this->order_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GoodsDetailList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
