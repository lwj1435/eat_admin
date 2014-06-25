<?php 

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $admin_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $this_login_time
 * @property string $this_login_ip
 * @property integer $last_login_time
 * @property string $last_login_ip
 */
class GoodsList extends CActiveRecord
{
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
				'goods_id' => '餐单编号',
				'goods_name' => '菜品名称',
				'goods_pice' => '价格',
				'goods_real_pice' => '销售价格',
				'goods_style' => '色评分',
				'goods_taste' => '口感评分',
				'goods_evaluation' => '总评分',
				'goods_desc' => '描述',
				'goods_image' => '图片',
				'goods_up_time' => '上传时间',
				'goods_modify_time' => '修改时间',
				'goods_comment_num' => '文章数目',
				'goods_marketing_num' => '评论总数',
				'goods_visit_times' => '浏览次数',
				'good_num' => '销售总数',
				'share_times' => '分享次数',
				'sound_times' => '',
				'goods_remain' => '',
				'goods_image_list' => '所有的图片',
				'goods_over_time' => '下架时间',
				'goods_type' => '类型',
				'goods_virtual_gold' => '虚拟价格',
				'goods_real_virtual_gold' => '真是虚拟价格',
				'goods_cat' => '分组',
				'goods_tag' => '标签',
				'goods_sounds' => '声音',
				'recommend' => '',
				'merchant_id' => '',
				'status' => '状态',
				'goods_taste_tag' => '口味',
				'goods_sale_type' => '销售类型',
				'goods_correlate' => '相关菜式',
				'add_user_id' => '添加用户id',
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