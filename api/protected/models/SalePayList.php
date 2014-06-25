<?php

/**
 * This is the model class for table "sale_pay_list".
 *
 * The followings are the available columns in table 'sale_pay_list':
 * @property integer $id
 * @property integer $sale_list_id
 * @property integer $good_id
 * @property double $pay_money
 * @property integer $user_id
 * @property string $user_name
 * @property integer $add_time
 */
class SalePayList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sale_pay_list';
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
			array('id, sale_list_id, good_id, user_id, add_time', 'numerical', 'integerOnly'=>true),
			array('pay_money', 'numerical'),
			array('user_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sale_list_id, good_id, pay_money, user_id, user_name, add_time', 'safe', 'on'=>'search'),
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
			'sale_list_id' => '拍卖场id',
			'good_id' => '商品id',
			'pay_money' => '拍卖用户出价',
			'user_id' => '用户id',
			'user_name' => '用户昵称',
			'add_time' => '出价时间',
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
		$criteria->compare('sale_list_id',$this->sale_list_id);
		$criteria->compare('good_id',$this->good_id);
		$criteria->compare('pay_money',$this->pay_money);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('add_time',$this->add_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SalePayList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
