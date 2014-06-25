<?php

/**
 * This is the model class for table "or_merchant_seat".
 *
 * The followings are the available columns in table 'or_merchant_seat':
 * @property integer $id
 * @property integer $merchant_id
 * @property string $seat_type
 * @property integer $min_num
 * @property integer $max_num
 * @property integer $status
 * @property string $desc
 * @property integer $at_area
 * @property integer $seat_num
 */
class OrMerchantSeatModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrMerchantSeatModel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'or_merchant_seat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('merchant_id, seat_type, min_num, max_num, status, desc, at_area, seat_num', 'required'),
			array('merchant_id, min_num, max_num, status, at_area, seat_num', 'numerical', 'integerOnly'=>true),
			array('seat_type', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, merchant_id, seat_type, min_num, max_num, status, desc, at_area, seat_num', 'safe', 'on'=>'search'),
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
			'seat_type' => 'Seat Type',
			'min_num' => 'Min Num',
			'max_num' => 'Max Num',
			'status' => 'Status',
			'desc' => 'Desc',
			'at_area' => 'At Area',
			'seat_num' => 'Seat Num',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('seat_type',$this->seat_type,true);
		$criteria->compare('min_num',$this->min_num);
		$criteria->compare('max_num',$this->max_num);
		$criteria->compare('status',$this->status);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('at_area',$this->at_area);
		$criteria->compare('seat_num',$this->seat_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}