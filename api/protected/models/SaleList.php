<?php

/**
 * This is the model class for table "sale_list".
 *
 * The followings are the available columns in table 'sale_list':
 * @property integer $id
 * @property integer $merchant_id
 * @property integer $good_id
 * @property string $sale_title
 * @property string $sale_content
 * @property integer $start_time
 * @property integer $end_time
 * @property double $sale_money
 * @property double $add_money
 * @property integer $is_end
 */
class SaleList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sale_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, merchant_id, good_id, start_time, end_time, is_end', 'numerical', 'integerOnly'=>true),
			array('sale_money, add_money', 'numerical'),
			array('sale_title', 'length', 'max'=>255),
			array('sale_content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, merchant_id, good_id, sale_title, sale_content, start_time, end_time, sale_money, add_money, is_end', 'safe', 'on'=>'search'),
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
			'merchant_id' => '商家id',
			'good_id' => '商品id',
			'sale_title' => '拍卖商品标题',
			'sale_content' => '拍卖内容',
			'start_time' => '拍卖开始时间',
			'end_time' => '拍卖结束时间',
			'sale_money' => '拍卖开始价格',
			'add_money' => '每次最低加价',
			'is_end' => '是否已经结束',
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
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('good_id',$this->good_id);
		$criteria->compare('sale_title',$this->sale_title,true);
		$criteria->compare('sale_content',$this->sale_content,true);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('sale_money',$this->sale_money);
		$criteria->compare('add_money',$this->add_money);
		$criteria->compare('is_end',$this->is_end);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SaleList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
