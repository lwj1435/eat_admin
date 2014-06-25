<?php

/**
 * This is the model class for table "merchant_register".
 *
 * The followings are the available columns in table 'merchant_register':
 * @property integer $id
 * @property string $account_name
 * @property string $password
 * @property string $mer_name
 * @property string $mer_company
 * @property string $city
 * @property string $pro
 * @property string $area
 * @property string $business_area
 * @property string $address
 * @property double $lat
 * @property double $long
 * @property integer $hasWiff
 * @property string $wiff_name
 * @property string $wiff_psw
 * @property string $connection_user
 * @property string $connection_user_position
 * @property string $connection_call
 * @property string $connection_phone
 * @property string $ID_card
 * @property string $ID_card_before_image
 * @property string $ID_card_after_image
 * @property string $business_license_No
 * @property string $business_license_No_image
 * @property string $tax_registry_No
 * @property string $tax_registry_No_image
 * @property integer $status
 * @property integer $type
 * @property integer $add_time
 * @property integer $add_user_id
 * @property integer $up_time
 */
class MerchantRegister extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'merchant_register';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wiff_psw, connection_user_position, connection_call, connection_phone, ID_card_before_image, business_license_No_image, tax_registry_No, tax_registry_No_image', 'required'),
			array('hasWiff, status, type, add_time, add_user_id, up_time', 'numerical', 'integerOnly'=>true),
			array('lat, long', 'numerical'),
			array('account_name, password, mer_name, mer_company, address, wiff_name, wiff_psw, connection_user, connection_user_position, ID_card_before_image, ID_card_after_image, business_license_No, business_license_No_image, tax_registry_No, tax_registry_No_image', 'length', 'max'=>255),
			array('city, pro, area, business_area, connection_phone', 'length', 'max'=>20),
			array('connection_call', 'length', 'max'=>100),
			array('ID_card', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account_name, password, mer_name, mer_company, city, pro, area, business_area, address, lat, long, hasWiff, wiff_name, wiff_psw, connection_user, connection_user_position, connection_call, connection_phone, ID_card, ID_card_before_image, ID_card_after_image, business_license_No, business_license_No_image, tax_registry_No, tax_registry_No_image, status, type, add_time, add_user_id, up_time', 'safe', 'on'=>'search'),
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
			'account_name' => 'Account Name',
			'password' => 'Password',
			'mer_name' => 'Mer Name',
			'mer_company' => 'Mer Company',
			'city' => 'City',
			'pro' => '省份',
			'area' => '地区',
			'business_area' => 'Business Area',
			'address' => 'Address',
			'lat' => 'Lat',
			'long' => 'Long',
			'hasWiff' => '是否有wiff',
			'wiff_name' => 'Wiff Name',
			'wiff_psw' => 'Wiff Psw',
			'connection_user' => '联系人',
			'connection_user_position' => '联系人的职位',
			'connection_call' => '联系人电话',
			'connection_phone' => '联系人手机',
			'ID_card' => '身份证',
			'ID_card_before_image' => '身份证图片',
			'ID_card_after_image' => '身份证背面图片',
			'business_license_No' => '营业执照扫面号',
			'business_license_No_image' => '营业执照扫描件',
			'tax_registry_No' => '税务登记证号',
			'tax_registry_No_image' => '税务登记证号图片',
			'status' => '状态',
			'type' => '类型',
			'add_time' => '添加时间',
			'add_user_id' => 'Add User',
			'up_time' => '修改时间',
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
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('mer_name',$this->mer_name,true);
		$criteria->compare('mer_company',$this->mer_company,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('pro',$this->pro,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('business_area',$this->business_area,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('long',$this->long);
		$criteria->compare('hasWiff',$this->hasWiff);
		$criteria->compare('wiff_name',$this->wiff_name,true);
		$criteria->compare('wiff_psw',$this->wiff_psw,true);
		$criteria->compare('connection_user',$this->connection_user,true);
		$criteria->compare('connection_user_position',$this->connection_user_position,true);
		$criteria->compare('connection_call',$this->connection_call,true);
		$criteria->compare('connection_phone',$this->connection_phone,true);
		$criteria->compare('ID_card',$this->ID_card,true);
		$criteria->compare('ID_card_before_image',$this->ID_card_before_image,true);
		$criteria->compare('ID_card_after_image',$this->ID_card_after_image,true);
		$criteria->compare('business_license_No',$this->business_license_No,true);
		$criteria->compare('business_license_No_image',$this->business_license_No_image,true);
		$criteria->compare('tax_registry_No',$this->tax_registry_No,true);
		$criteria->compare('tax_registry_No_image',$this->tax_registry_No_image,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('type',$this->type);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('add_user_id',$this->add_user_id);
		$criteria->compare('up_time',$this->up_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MerchantRegister the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
