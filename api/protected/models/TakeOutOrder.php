<?php

/**
 * This is the model class for table "take_out_order".
 *
 * The followings are the available columns in table 'take_out_order':
 * @property integer $tid
 * @property integer $take_out_id
 * @property string $order_num
 * @property integer $user_id
 * @property string $account_name
 * @property string $user_name
 */
class TakeOutOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'take_out_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('take_out_id', 'required'),
			array('take_out_id, user_id', 'numerical', 'integerOnly'=>true),
			array('order_num, account_name, user_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tid, take_out_id, order_num, user_id, account_name, user_name', 'safe', 'on'=>'search'),
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
			'tid' => 'Tid',
			'take_out_id' => 'Take Out',
			'order_num' => '订单号',
			'user_id' => 'User',
			'account_name' => 'Account Name',
			'user_name' => 'User Name',
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

		$criteria->compare('tid',$this->tid);
		$criteria->compare('take_out_id',$this->take_out_id);
		$criteria->compare('order_num',$this->order_num,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('user_name',$this->user_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TakeOutOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
