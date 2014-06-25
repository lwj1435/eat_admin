<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property integer $id
 * @property integer $parent_id
 * @property string $conment
 * @property integer $type
 * @property integer $article_time
 * @property integer $modify_time
 * @property integer $user_id
 * @property string $user_name
 * @property string $account_name
 * @property integer $follow_num
 * @property integer $status
 * @property double $evaluate
 * @property integer $merchant_id
 * @property double $per
 * @property string $image_list
 * @property integer $view_num
 * @property integer $love_num
 * @property string $merchant_name
 * @property string $merchant_feel
 * @property string $pro
 * @property string $city
 * @property string $area
 * @property integer $activity_id
 */
class Article extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, type, article_time, modify_time, user_id, follow_num, status, merchant_id, view_num, love_num, activity_id', 'numerical', 'integerOnly'=>true),
			array('evaluate, per', 'numerical'),
			array('user_name, merchant_name', 'length', 'max'=>255),
			array('account_name', 'length', 'max'=>45),
			array('pro, city, area', 'length', 'max'=>20),
			array('conment, image_list, merchant_feel', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, conment, type, article_time, modify_time, user_id, user_name, account_name, follow_num, status, evaluate, merchant_id, per, image_list, view_num, love_num, merchant_name, merchant_feel, pro, city, area, activity_id', 'safe', 'on'=>'search'),
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
			'id' => '文章',
			'parent_id' => 'Parent',
			'conment' => '文章内容',
			'type' => '类型',
			'article_time' => 'Article Time',
			'modify_time' => 'Modify Time',
			'user_id' => 'User',
			'user_name' => '用户的名字',
			'account_name' => 'Account Name',
			'follow_num' => 'Follow Num',
			'status' => 'Status',
			'evaluate' => 'Evaluate',
			'merchant_id' => 'Merchant',
			'per' => '人均',
			'image_list' => '图片列表',
			'view_num' => '浏览次数',
			'love_num' => '点赞次数',
			'merchant_name' => '商家名字',
			'merchant_feel' => '商家印象',
			'pro' => 'Pro',
			'city' => 'City',
			'area' => 'Area',
			'activity_id' => 'Activity',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('conment',$this->conment,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('article_time',$this->article_time);
		$criteria->compare('modify_time',$this->modify_time);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('follow_num',$this->follow_num);
		$criteria->compare('status',$this->status);
		$criteria->compare('evaluate',$this->evaluate);
		$criteria->compare('merchant_id',$this->merchant_id);
		$criteria->compare('per',$this->per);
		$criteria->compare('image_list',$this->image_list,true);
		$criteria->compare('view_num',$this->view_num);
		$criteria->compare('love_num',$this->love_num);
		$criteria->compare('merchant_name',$this->merchant_name,true);
		$criteria->compare('merchant_feel',$this->merchant_feel,true);
		$criteria->compare('pro',$this->pro,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('activity_id',$this->activity_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Article the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
