<?php

/**
 * This is the model class for table "merchant_team".
 *
 * The followings are the available columns in table 'merchant_team':
 * @property integer $id
 * @property string $team_name
 * @property string $team_add
 * @property integer $user_id
 * @property integer $merchant_id
 * @property string $team_desc
 * @property integer $status
 */
class MerchantTeam extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'merchant_team';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, merchant_id, status', 'numerical', 'integerOnly'=>true),
			array('team_name, team_add', 'length', 'max'=>255),
			array('team_desc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, team_name, team_add, user_id, merchant_id, team_desc, status', 'safe', 'on'=>'search'),
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
			'team_name' => '总公司的名字',
			'team_add' => '总部地址',
			'user_id' => '对应的用户名字',
			'merchant_id' => '对应的公司id ，可以木有',
			'team_desc' => '总公司的简介',
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
		$criteria->compare('team_name',$this->team_name,true);
		$criteria->compare('team_add',$this->team_add,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('team_desc',$this->team_desc,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MerchantTeam the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
