<?php

/**
 * This is the model class for table "user_address".
 *
 * The followings are the available columns in table 'user_address':
 * @property integer $id
 * @property string $address
 * @property string $phone
 * @property string $name
 * @property string $other_phone
 * @property integer $user_id
 * @property string $account_name
 * @property integer $ad_time
 * @property integer $modify_time
 * @property integer $status
 * @property string $area
 * @property string $pro
 * @property string $city
 */
class UserAddress extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('area, pro, city', 'required'),
			array('user_id, ad_time, modify_time, status', 'numerical', 'integerOnly'=>true),
			array('address', 'length', 'max'=>255),
			array('phone, name, other_phone, account_name', 'length', 'max'=>45),
			array('area, pro, city', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, address, phone, name, other_phone, user_id, account_name, ad_time, modify_time, status, area, pro, city', 'safe', 'on'=>'search'),
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
			'address' => 'Address',
			'phone' => 'Phone',
			'name' => 'Name',
			'other_phone' => 'Other Phone',
			'user_id' => 'User',
			'account_name' => 'Account Name',
			'ad_time' => 'Ad Time',
			'modify_time' => 'Modify Time',
			'status' => 'Status',
			'area' => 'Area',
			'pro' => 'Pro',
			'city' => 'City',
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('other_phone',$this->other_phone,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('ad_time',$this->ad_time);
		$criteria->compare('modify_time',$this->modify_time);
		$criteria->compare('status',$this->status);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('pro',$this->pro,true);
		$criteria->compare('city',$this->city,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserAddress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
