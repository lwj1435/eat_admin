<?php

/**
 * This is the model class for table "ff_block_list".
 *
 * The followings are the available columns in table 'ff_block_list':
 * @property integer $id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $type
 * @property integer $admin_id
 * @property string $desc
 * @property integer $status
 */
class FfBlockList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ff_block_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, type, admin_id, status', 'numerical', 'integerOnly'=>true),
			array('user_name', 'length', 'max'=>255),
			array('desc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, user_name, type, admin_id, desc, status', 'safe', 'on'=>'search'),
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
			'user_id' => '被拉黑用户ID',
			'user_name' => '被拉黑用户名称',
			'type' => '黑名单类型',
			'admin_id' => '拉黑人ID',
			'desc' => '备注',
			'status' => '拉黑状态',
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
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('admin_id',$this->admin_id);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FfBlockList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
