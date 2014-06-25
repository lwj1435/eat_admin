<?php

/**
 * This is the model class for table "consulting_list".
 *
 * The followings are the available columns in table 'consulting_list':
 * @property integer $id
 * @property string $user_name
 * @property integer $user_add_time
 * @property integer $user_ask_num
 * @property integer $answer
 * @property integer $answer_num
 * @property integer $answer_time
 * @property integer $black
 * @property integer $merchant_id
 */
class ConsultingList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'consulting_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, user_add_time, user_ask_num, answer, answer_num, answer_time, black, merchant_id', 'required'),
			array('user_add_time, user_ask_num, answer, answer_num, answer_time, black, merchant_id', 'numerical', 'integerOnly'=>true),
			array('user_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_name, user_add_time, user_ask_num, answer, answer_num, answer_time, black, merchant_id', 'safe', 'on'=>'search'),
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
			'user_name' => 'User Name',
			'user_add_time' => 'User Add Time',
			'user_ask_num' => 'User Ask Num',
			'answer' => 'Answer',
			'answer_num' => 'Answer Num',
			'answer_time' => 'Answer Time',
			'black' => 'Black',
			'merchant_id' => 'Merchant',
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
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_add_time',$this->user_add_time);
		$criteria->compare('user_ask_num',$this->user_ask_num);
		$criteria->compare('answer',$this->answer);
		$criteria->compare('answer_num',$this->answer_num);
		$criteria->compare('answer_time',$this->answer_time);
		$criteria->compare('black',$this->black);
		$criteria->compare('merchant_id',$this->merchant_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConsultingList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
