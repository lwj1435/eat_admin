<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $id
 * @property integer $from_id
 * @property integer $to_user_id
 * @property string $to_user_name
 * @property string $content
 * @property integer $status
 * @property integer $send_time
 * @property integer $real_send_time
 * @property integer $add_time
 * @property string $to_no
 * @property integer $merchant_id
 * @property string $from_user_name
 * @property integer $customer_id
 * @property integer $type
 * @property string $title
 */
class Message extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('from_id, to_user_id, to_user_name, content, status, send_time, real_send_time, add_time, to_no, merchant_id, from_user_name, customer_id, title', 'required'),
			array('from_id, to_user_id, status, send_time, real_send_time, add_time, merchant_id, customer_id, type', 'numerical', 'integerOnly'=>true),
			array('to_user_name, from_user_name, title', 'length', 'max'=>255),
			array('to_no', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, from_id, to_user_id, to_user_name, content, status, send_time, real_send_time, add_time, to_no, merchant_id, from_user_name, customer_id, type, title', 'safe', 'on'=>'search'),
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
			'from_id' => 'From',
			'to_user_id' => 'To User',
			'to_user_name' => '发送给的用户名字',
			'content' => '发送的内容',
			'status' => '状态',
			'send_time' => '设定发送时间',
			'real_send_time' => '真正的发送时间',
			'add_time' => '添加的时间',
			'to_no' => '发送到的号码',
			'merchant_id' => '商户id',
			'from_user_name' => '发送人姓名',
			'customer_id' => '顾客id',
			'type' => '类型0为短信，1为推送',
			'title' => '标题',
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
		$criteria->compare('from_id',$this->from_id);
		$criteria->compare('to_user_id',$this->to_user_id);
		$criteria->compare('to_user_name',$this->to_user_name,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('send_time',$this->send_time);
		$criteria->compare('real_send_time',$this->real_send_time);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('to_no',$this->to_no,true);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('from_user_name',$this->from_user_name,true);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Message the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
