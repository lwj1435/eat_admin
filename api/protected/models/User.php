<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $account_name
 * @property string $username
 * @property integer $sex
 * @property string $email
 * @property string $password
 * @property integer $create_time
 * @property integer $status
 * @property string $iphone
 * @property integer $qq
 * @property integer $type
 * @property integer $reg_time
 * @property integer $vip
 * @property string $honour
 * @property string $iteam_list
 * @property integer $this_login_time
 * @property integer $last_login_time
 * @property integer $this_login_ip
 * @property integer $last_login_ip
 * @property string $merchant_id
 * @property string $tag_list
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_name, username, sex, password, iphone, merchant_id, tag_list', 'required'),
			array('sex, create_time, status, qq, type, reg_time, vip, this_login_time, last_login_time, this_login_ip, last_login_ip', 'numerical', 'integerOnly'=>true),
			array('account_name', 'length', 'max'=>45),
			array('username', 'length', 'max'=>16),
			array('email, honour, merchant_id', 'length', 'max'=>255),
			array('password', 'length', 'max'=>32),
			array('iphone', 'length', 'max'=>20),
			array('iteam_list', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account_name, username, sex, email, password, create_time, status, iphone, qq, type, reg_time, vip, honour, iteam_list, this_login_time, last_login_time, this_login_ip, last_login_ip, merchant_id, tag_list', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'sex' => 'Sex',
			'email' => 'Email',
			'password' => 'Password',
			'create_time' => 'Create Time',
			'status' => 'Status',
			'iphone' => '电话',
			'qq' => 'Qq',
			'type' => 'Type',
			'reg_time' => '注册时间',
			'vip' => 'Vip',
			'honour' => '荣誉',
			'iteam_list' => 'Iteam List',
			'this_login_time' => 'This Login Time',
			'last_login_time' => 'Last Login Time',
			'this_login_ip' => 'This Login Ip',
			'last_login_ip' => 'Last Login Ip',
			'merchant_id' => 'å•†å®¶id',
			'tag_list' => 'Tag List',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('status',$this->status);
		$criteria->compare('iphone',$this->iphone,true);
		$criteria->compare('qq',$this->qq);
		$criteria->compare('type',$this->type);
		$criteria->compare('reg_time',$this->reg_time);
		$criteria->compare('vip',$this->vip);
		$criteria->compare('honour',$this->honour,true);
		$criteria->compare('iteam_list',$this->iteam_list,true);
		$criteria->compare('this_login_time',$this->this_login_time);
		$criteria->compare('last_login_time',$this->last_login_time);
		$criteria->compare('this_login_ip',$this->this_login_ip);
		$criteria->compare('last_login_ip',$this->last_login_ip);
		$criteria->compare('merchant_id',$this->merchant_id,true);
		$criteria->compare('tag_list',$this->tag_list,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
