<?php

/**
 * This is the model class for table "ep_detail".
 *
 * The followings are the available columns in table 'ep_detail':
 * @property integer $id
 * @property integer $eating_project_id
 * @property string $menu_id
 * @property double $per_gold
 * @property integer $num
 * @property double $total_gold
 * @property integer $user_id
 * @property string $account_name
 * @property string $user_name
 */
class EpDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ep_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eating_project_id', 'required'),
			array('eating_project_id, num, user_id', 'numerical', 'integerOnly'=>true),
			array('per_gold, total_gold', 'numerical'),
			array('menu_id, account_name, user_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, eating_project_id, menu_id, per_gold, num, total_gold, user_id, account_name, user_name', 'safe', 'on'=>'search'),
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
			'eating_project_id' => 'Eating Project',
			'menu_id' => '也就是goods 的num',
			'per_gold' => 'Per Gold',
			'num' => 'Num',
			'total_gold' => 'Total Gold',
			'user_id' => 'User',
			'account_name' => 'Account Name',
			'user_name' => 'User Name',
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
		$criteria->compare('eating_project_id',$this->eating_project_id);
		$criteria->compare('menu_id',$this->menu_id,true);
		$criteria->compare('per_gold',$this->per_gold);
		$criteria->compare('num',$this->num);
		$criteria->compare('total_gold',$this->total_gold);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('user_name',$this->user_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EpDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
