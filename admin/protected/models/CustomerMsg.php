<?php

/**
 * This is the model class for table "customer_msg".
 *
 * The followings are the available columns in table 'customer_msg':
 * @property integer $id
 * @property integer $mrchant_id
 * @property string $c_name
 * @property integer $book_num
 * @property integer $take_out_num
 * @property integer $coupon_num
 * @property integer $comment_num
 * @property integer $source_type
 * @property integer $user_id
 * @property integer $status
 * @property string $phone
 * @property integer $share_num
 * @property integer $view_num
 * @property integer $add_time
 */
class CustomerMsg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_msg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mrchant_id, c_name, book_num, take_out_num, coupon_num, comment_num, source_type, user_id, status, phone, share_num, view_num, add_time', 'required'),
			array('mrchant_id, book_num, take_out_num, coupon_num, comment_num, source_type, user_id, status, share_num, view_num, add_time', 'numerical', 'integerOnly'=>true),
			array('c_name', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mrchant_id, c_name, book_num, take_out_num, coupon_num, comment_num, source_type, user_id, status, phone, share_num, view_num, add_time', 'safe', 'on'=>'search'),
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
			'mrchant_id' => 'Mrchant',
			'c_name' => 'C Name',
			'book_num' => '预订',
			'take_out_num' => '外卖',
			'coupon_num' => '优惠卷',
			'comment_num' => '点评次数',
			'source_type' => '来源类型',
			'user_id' => 'User',
			'status' => 'Status',
			'phone' => '电话',
			'share_num' => 'Share Num',
			'view_num' => 'View Num',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('mrchant_id',$this->mrchant_id);
		$criteria->compare('c_name',$this->c_name,true);
		$criteria->compare('book_num',$this->book_num);
		$criteria->compare('take_out_num',$this->take_out_num);
		$criteria->compare('coupon_num',$this->coupon_num);
		$criteria->compare('comment_num',$this->comment_num);
		$criteria->compare('source_type',$this->source_type);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('share_num',$this->share_num);
		$criteria->compare('view_num',$this->view_num);
		$criteria->compare('add_time',$this->add_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerMsg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
