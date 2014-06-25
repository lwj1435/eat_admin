<?php

/**
 * This is the model class for table "server_msg".
 *
 * The followings are the available columns in table 'server_msg':
 * @property integer $id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property integer $from_merchant_id
 * @property integer $add_time
 * @property integer $status
 * @property integer $parent_id
 * @property integer $first_id
 * @property string $from_user_name
 * @property string $to_name
 * @property string $content
 * @property integer $get_time
 * @property integer $reply_time
 * @property integer $send_time
 * @property string $reply_content
 * @property string $detail_content
 */
class ServerMsg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'server_msg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('from_user_id, to_user_id, from_merchant_id, add_time, status, parent_id, first_id, from_user_name, to_name, content, get_time, reply_time, send_time, reply_content, detail_content', 'required'),
			array('from_user_id, to_user_id, from_merchant_id, add_time, status, parent_id, first_id, get_time, reply_time, send_time', 'numerical', 'integerOnly'=>true),
			array('from_user_name, to_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, from_user_id, to_user_id, from_merchant_id, add_time, status, parent_id, first_id, from_user_name, to_name, content, get_time, reply_time, send_time, reply_content, detail_content', 'safe', 'on'=>'search'),
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
			'from_user_id' => '来源用户',
			'to_user_id' => '接受用户',
			'from_merchant_id' => '接受供应商',
			'add_time' => '添加时间',
			'status' => '状态',
			'parent_id' => '父亲id',
			'first_id' => '第一个用户',
			'from_user_name' => '来源用户名字',
			'to_name' => '接受用户名字',
			'content' => '内容',
			'get_time' => '获取时间',
			'reply_time' => '回复时间',
			'send_time' => '发送时间',
			'reply_content' => '回复内容',
			'detail_content' => '详细内容',
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
		$criteria->compare('from_user_id',$this->from_user_id);
		$criteria->compare('to_user_id',$this->to_user_id);
		$criteria->compare('from_merchant_id',$this->from_merchant_id);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('status',$this->status);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('first_id',$this->first_id);
		$criteria->compare('from_user_name',$this->from_user_name,true);
		$criteria->compare('to_name',$this->to_name,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('get_time',$this->get_time);
		$criteria->compare('reply_time',$this->reply_time);
		$criteria->compare('send_time',$this->send_time);
		$criteria->compare('reply_content',$this->reply_content,true);
		$criteria->compare('detail_content',$this->detail_content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServerMsg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
