<?php

/**
 * This is the model class for table "consulting".
 *
 * The followings are the available columns in table 'consulting':
 * @property string $id
 * @property integer $merchant_id
 * @property integer $user_id
 * @property string $account_name
 * @property string $user_name
 * @property string $msg
 * @property integer $type
 * @property integer $add_time
 */
class Consulting extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consulting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_id, user_id, account_name, user_name, msg, type, add_time', 'required'),
			array('merchant_id, user_id, type, add_time', 'numerical', 'integerOnly'=>true),
			array('account_name', 'length', 'max'=>50),
			array('user_name', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, merchant_id, user_id, account_name, user_name, msg, type, add_time', 'safe', 'on'=>'search'),
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
			'merchant_id' => 'Merchant',
			'user_id' => 'User',
			'account_name' => 'Account Name',
			'user_name' => 'User Name',
			'msg' => 'Msg',
			'type' => 'Type',
			'add_time' => 'Add Time',
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
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('msg',$this->msg,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('add_time',$this->add_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Consulting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
