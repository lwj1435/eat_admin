<?php

/**
 * This is the model class for table "merchant_msg".
 *
 * The followings are the available columns in table 'merchant_msg':
 * @property integer $id
 * @property string $merchant_name
 * @property string $merchant_branch
 * @property string $merchant_alias
 * @property string $merchant_logo
 * @property string $merchant_image
 * @property string $merchant_sounds
 * @property string $merchant_video
 * @property string $merchant_desc
 * @property double $taste_sec
 * @property double $environmental_sec
 * @property double $service_sec
 * @property double $longitude
 * @property double $latitude
 * @property double $altitude
 * @property string $address
 * @property string $merchant_call
 * @property string $merchant_traffic
 * @property string $merchant_wifi
 * @property integer $merchant_marketing_num
 * @property string $merchant_per
 * @property integer $merchant_star
 * @property string $merchant_start_time
 * @property string $merchant_end_time
 * @property double $score
 * @property integer $score_taste
 * @property integer $score_envirement
 * @property integer $score_service
 * @property integer $good_num
 * @property integer $user_id
 * @property integer $status
 * @property string $merchant_othername
 * @property string $merchant_manager
 * @property string $merchant_manager_phone
 * @property string $merchant_phone
 * @property string $pro
 * @property string $city
 * @property string $area
 * @property string $free_service
 * @property string $merchant_tag
 * @property string $merchant_ser
 * @property integer $business_type
 * @property integer $referrals
 */
class MerchantMsg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'merchant_msg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_sounds, merchant_video, merchant_start_time, merchant_end_time, score, score_taste, score_envirement, score_service, good_num, user_id, merchant_othername, merchant_manager, merchant_manager_phone, merchant_phone, pro, city, area, free_service, merchant_tag, merchant_ser, business_type, referrals', 'required'),
			array('merchant_marketing_num, merchant_star, score_taste, score_envirement, score_service, good_num, user_id, status, business_type, referrals', 'numerical', 'integerOnly'=>true),
			array('taste_sec, environmental_sec, service_sec, longitude, latitude, altitude, score', 'numerical'),
			array('merchant_name, merchant_branch, merchant_alias, merchant_logo, merchant_call, merchant_traffic, merchant_wifi, merchant_phone, free_service, merchant_ser', 'length', 'max'=>255),
			array('address', 'length', 'max'=>45),
			array('merchant_per, merchant_start_time, merchant_end_time', 'length', 'max'=>10),
			array('merchant_othername, merchant_manager_phone', 'length', 'max'=>100),
			array('merchant_manager', 'length', 'max'=>150),
			array('pro, city, area', 'length', 'max'=>20),
			array('merchant_tag', 'length', 'max'=>500),
			array('merchant_image, merchant_desc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, merchant_name, merchant_branch, merchant_alias, merchant_logo, merchant_image, merchant_sounds, merchant_video, merchant_desc, taste_sec, environmental_sec, service_sec, longitude, latitude, altitude, address, merchant_call, merchant_traffic, merchant_wifi, merchant_marketing_num, merchant_per, merchant_star, merchant_start_time, merchant_end_time, score, score_taste, score_envirement, score_service, good_num, user_id, status, merchant_othername, merchant_manager, merchant_manager_phone, merchant_phone, pro, city, area, free_service, merchant_tag, merchant_ser, business_type, referrals', 'safe', 'on'=>'search'),
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
			'merBookList'=>array(self::HAS_MANY, 'BookList', 'merchange_id'),
			'merTakeOutList'=>array(self::HAS_MANY, 'TakeOut', 'merchant_id'),
			'merActivityList'=>array(self::HAS_MANY, 'ActivityList', 'merchant_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'merchant message',
			'merchant_name' => 'Merchant Name',
			'merchant_branch' => 'Merchant Branch',
			'merchant_alias' => 'Merchant Alias',
			'merchant_logo' => 'Merchant Logo',
			'merchant_image' => 'Merchant Image',
			'merchant_sounds' => 'Merchant Sounds',
			'merchant_video' => 'Merchant Video',
			'merchant_desc' => 'Merchant Desc',
			'taste_sec' => '口味评分',
			'environmental_sec' => '环境评分',
			'service_sec' => '服务评分',
			'longitude' => '经度',
			'latitude' => '纬度',
			'altitude' => '海拔',
			'address' => 'Address',
			'merchant_call' => '电话',
			'merchant_traffic' => '具体交通信息',
			'merchant_wifi' => 'wifi信息',
			'merchant_marketing_num' => '被评论的次数',
			'merchant_per' => '人均消费',
			'merchant_star' => '商家星级',
			'merchant_start_time' => 'Merchant Start Time',
			'merchant_end_time' => 'Merchant End Time',
			'score' => 'Score',
			'score_taste' => 'Score Taste',
			'score_envirement' => 'Score Envirement',
			'score_service' => 'Score Service',
			'good_num' => 'Good Num',
			'user_id' => 'User',
			'status' => 'Status',
			'merchant_othername' => 'åˆ«å',
			'merchant_manager' => 'å•†æˆ·åº—é•¿å§“å',
			'merchant_manager_phone' => 'åº—é•¿ç”µè¯',
			'merchant_phone' => 'æ‰‹æœºå·ç ',
			'pro' => 'çœ',
			'city' => 'å¸‚',
			'area' => 'åŒº',
			'free_service' => 'å…è´¹æœåŠ¡',
			'merchant_tag' => '标签',
			'merchant_ser' => '服务内容',
			'business_type' => 'Business Type',
			'referrals' => 'Referrals',
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
		$criteria->compare('merchant_name',$this->merchant_name,true);
		$criteria->compare('merchant_branch',$this->merchant_branch,true);
		$criteria->compare('merchant_alias',$this->merchant_alias,true);
		$criteria->compare('merchant_logo',$this->merchant_logo,true);
		$criteria->compare('merchant_image',$this->merchant_image,true);
		$criteria->compare('merchant_sounds',$this->merchant_sounds,true);
		$criteria->compare('merchant_video',$this->merchant_video,true);
		$criteria->compare('merchant_desc',$this->merchant_desc,true);
		$criteria->compare('taste_sec',$this->taste_sec);
		$criteria->compare('environmental_sec',$this->environmental_sec);
		$criteria->compare('service_sec',$this->service_sec);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('altitude',$this->altitude);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('merchant_call',$this->merchant_call,true);
		$criteria->compare('merchant_traffic',$this->merchant_traffic,true);
		$criteria->compare('merchant_wifi',$this->merchant_wifi,true);
		$criteria->compare('merchant_marketing_num',$this->merchant_marketing_num);
		$criteria->compare('merchant_per',$this->merchant_per,true);
		$criteria->compare('merchant_star',$this->merchant_star);
		$criteria->compare('merchant_start_time',$this->merchant_start_time,true);
		$criteria->compare('merchant_end_time',$this->merchant_end_time,true);
		$criteria->compare('score',$this->score);
		$criteria->compare('score_taste',$this->score_taste);
		$criteria->compare('score_envirement',$this->score_envirement);
		$criteria->compare('score_service',$this->score_service);
		$criteria->compare('good_num',$this->good_num);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('merchant_othername',$this->merchant_othername,true);
		$criteria->compare('merchant_manager',$this->merchant_manager,true);
		$criteria->compare('merchant_manager_phone',$this->merchant_manager_phone,true);
		$criteria->compare('merchant_phone',$this->merchant_phone,true);
		$criteria->compare('pro',$this->pro,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('free_service',$this->free_service,true);
		$criteria->compare('merchant_tag',$this->merchant_tag,true);
		$criteria->compare('merchant_ser',$this->merchant_ser,true);
		$criteria->compare('business_type',$this->business_type);
		$criteria->compare('referrals',$this->referrals);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MerchantMsg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
