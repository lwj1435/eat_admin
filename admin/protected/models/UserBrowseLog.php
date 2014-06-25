<?php

/**
 * This is the model class for table "user_browse_log".
 *
 * The followings are the available columns in table 'user_browse_log':
 * @property integer $id
 * @property integer $user_id
 * @property string $account_name
 * @property string $user_name
 * @property string $user_browse_logcol
 * @property integer $browse_type
 * @property integer $be_browse_id
 */
class UserBrowseLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_browse_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, browse_type, be_browse_id', 'numerical', 'integerOnly'=>true),
			array('account_name, user_name, user_browse_logcol', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, account_name, user_name, user_browse_logcol, browse_type, be_browse_id', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'account_name' => 'Account Name',
			'user_name' => 'User Name',
			'user_browse_logcol' => 'User Browse Logcol',
			'browse_type' => '浏览的类型',
			'be_browse_id' => '被浏览的id',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_browse_logcol',$this->user_browse_logcol,true);
		$criteria->compare('browse_type',$this->browse_type);
		$criteria->compare('be_browse_id',$this->be_browse_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserBrowseLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
