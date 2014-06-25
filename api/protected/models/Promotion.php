<?php

/**
 * This is the model class for table "promotion".
 *
 * The followings are the available columns in table 'promotion':
 * @property string $id
 * @property string $promotion_name
 * @property string $promotion_introduce
 * @property integer $promotion_type
 * @property double $discount
 * @property integer $promotion_start_time
 * @property integer $promotion_end_time
 * @property integer $goods_num
 * @property integer $visit_time
 * @property integer $merchant_id
 * @property integer $add_time
 * @property integer $add_user_id
 */
class Promotion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'promotion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('promotion_type, promotion_start_time, promotion_end_time, goods_num, visit_time, merchant_id, add_time, add_user_id', 'numerical', 'integerOnly'=>true),
			array('discount', 'numerical'),
			array('promotion_name', 'length', 'max'=>50),
			array('promotion_introduce', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, promotion_name, promotion_introduce, promotion_type, discount, promotion_start_time, promotion_end_time, goods_num, visit_time, merchant_id, add_time, add_user_id', 'safe', 'on'=>'search'),
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
				'greens' => array(self::MANY_MANY, 'Goods', 'pro_goods(pro_id,goods_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'promotion_name' => 'Promotion Name',
			'promotion_introduce' => 'Promotion Introduce',
			'promotion_type' => 'Promotion Type',
			'discount' => 'Discount',
			'promotion_start_time' => 'Promotion Start Time',
			'promotion_end_time' => 'Promotion End Time',
			'goods_num' => 'Goods Num',
			'visit_time' => 'Visit Time',
			'merchant_id' => 'Merchant',
			'add_time' => 'Add Time',
			'add_user_id' => 'Add User',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('promotion_name',$this->promotion_name,true);
		$criteria->compare('promotion_introduce',$this->promotion_introduce,true);
		$criteria->compare('promotion_type',$this->promotion_type);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('promotion_start_time',$this->promotion_start_time);
		$criteria->compare('promotion_end_time',$this->promotion_end_time);
		$criteria->compare('goods_num',$this->goods_num);
		$criteria->compare('visit_time',$this->visit_time);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('add_user_id',$this->add_user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Promotion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
