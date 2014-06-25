<?php

/**
 * This is the model class for table "attention_list".
 *
 * The followings are the available columns in table 'attention_list':
 * @property integer $id
 * @property integer $at_type
 * @property integer $at_id
 * @property integer $at_time
 * @property integer $modify_time
 * @property integer $user_id
 * @property string $account_name
 * @property integer $status
 */
class AttentionList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'attention_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('at_type, at_id, at_time, modify_time, user_id, status', 'numerical', 'integerOnly'=>true),
			array('account_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, at_type, at_id, at_time, modify_time, user_id, account_name, status', 'safe', 'on'=>'search'),
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
			'id' => 'user attention list',
			'at_type' => 'At Type',
			'at_id' => '被关注的id',
			'at_time' => 'At Time',
			'modify_time' => 'Modify Time',
			'user_id' => 'User',
			'account_name' => 'Account Name',
			'status' => 'Status',
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
		$criteria->compare('at_type',$this->at_type);
		$criteria->compare('at_id',$this->at_id);
		$criteria->compare('at_time',$this->at_time);
		$criteria->compare('modify_time',$this->modify_time);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AttentionList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
