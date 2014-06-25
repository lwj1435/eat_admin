<?php

class PromotionsList extends CActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'goods';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		// 				array('this_login_time, last_login_time', 'numerical', 'integerOnly'=>true),
		// 				array('username, password, email', 'length', 'max'=>50),
		// 				array('this_login_ip, last_login_ip', 'length', 'max'=>20),
		// 				// The following rule is used by search().
		// 				// @todo Please remove those attributes that should not be searched.
		// 				array('admin_id, username, password, email, this_login_time, this_login_ip, last_login_time, last_login_ip', 'safe', 'on'=>'search'),
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
				'id' => '序号',
				'goods_id' => '优惠卷序列号',
				'goods_name' => '名称',
				'goods_name'=>'促销名称',		
				'goods_v_type'=>'促销类型',
				't_begin_time'=>'开始日期',
				't_end_time'=>'结束日期',
				'pri_time_per'=>'优惠率',	
				'pri_goods_list'=>'菜品列表',
				'pri_goods_per'=>'优惠绿',
				'vip_per'=>'会员优惠',
				'per_type'=>'促销类型',
				'varil_begin_time'=>'开始日期',
				'varil_end_time'=>'结束日期',
				'good_desc'=>'促销优惠介绍',
				
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
	
		// 		$criteria->compare('admin_id',$this->admin_id);
		// 		$criteria->compare('username',$this->username,true);
		// 		$criteria->compare('password',$this->password,true);
		// 		$criteria->compare('email',$this->email,true);
		// 		$criteria->compare('this_login_time',$this->this_login_time);
		// 		$criteria->compare('this_login_ip',$this->this_login_ip,true);
		// 		$criteria->compare('last_login_time',$this->last_login_time);
		// 		$criteria->compare('last_login_ip',$this->last_login_ip,true);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Admin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}


?>